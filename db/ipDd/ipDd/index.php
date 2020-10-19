<?php


$htmltable;
addToBD($_SERVER['REMOTE_ADDR']);  //Заносим текущий ip адресс в бд

echo "<form method ='post'>
<input type ='submit' name ='genVirtIp' value ='Генерировать случайные ip'  />
</form>";  //Кнопка для генерации случайных ip
echo "<form method ='post'>
<input type ='submit' name ='getEmail' value ='Отправить на почту'  />
</form>";  //Кнопка для отправки на почту

if (isset($_POST['getEmail'])) //Если нажата кнопка отправляем на почту
{
    sentMail();
}


if (isset($_POST['genVirtIp'])) //Если нажата кнопка генерируем случайные ip со случайными посещениями
{
    $ips;

    for($i=0; $i<10; $i++)
    {
        $ips[]= rand(1,255).".".rand(1,255).".".rand(1,255).".".rand(1,255);

    }

    for($i=0;$i<100;$i++)
    {
        $nowVirtualIp=$ips[rand(1,9)];
        addToBD($nowVirtualIp);
    }
}


function addToBD($ip) //Добовляем данные в бд
{
    $mySql= new mysqli('localhost','root','root','userbd');
    $result=$mySql->query("SELECT * FROM `tableip` WHERE `ip` LIKE '".$ip."'");
    if($row = $result->fetch_assoc()) //Если запись существует делаем инкремент посещений
    {
        $res=$row['id'];
        $result=$mySql->query("UPDATE `tableip` SET `countEnter` = `countEnter`+1 WHERE `tableip`.`id` ="."$res");
    }

    else  //Если записи в бд нет то добавляем ее
    {
        $result=$mySql->query("INSERT INTO `tableip` (`id`, `ip`) VALUES (NULL, '".$ip."');");
    }
    $mySql->close();

}

$mySql= new mysqli('localhost','root','root','userbd');
$result=$mySql->query("SELECT * FROM `tableip` ORDER BY `tableip`.`countEnter` ASC");
$htmltable= "<table border='1' width='100' cellpadding='5'>
   <tr>
    <th>Количество посещений</th>
    <th>ip адресс</th>
   </tr>";
$endHtml="</table>";  //Генерируем шапку html таблицы


while($row = $result->fetch_assoc()) //Добавляем в html таблицу ip
{
    $htmltable.="<tr>
<th>".$row['countEnter']."</th>
<th>".$row['ip']."</th>
</tr>";
}
$htmltable.="</table>";
echo $htmltable;
$mySql->close();



function sentMail()  //Функция отправки на почту
{
    $to  = "<admin45456@gmail.com>, " ;
    $subject = "IPs";

    $message = $htmltable;

    $headers  = "Content-type: text/html; charset=windows-1251 \r\n";
    $headers .= "From: От кого письмо <admin36985@gmail.com>\r\n";
    $headers .= "Reply-To: admin36985@gmail.com\r\n";

    mail($to, $subject, $message, $headers);
}