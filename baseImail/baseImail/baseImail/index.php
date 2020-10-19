<?php

echo 'Введите имя пользователя';   //Форма для ввода имени и имейла
echo "<form method ='post'>
<input type='text' name ='user'value =";
    echo htmlspecialchars($_POST['user'],ENT_HTML5);
    echo "> <br> Введите email  <br> <input type='email' name ='email' value ="; //Устанавливаем поле для ввода имейла
echo htmlspecialchars($_POST['email'],ENT_HTML5);
echo "> <br>
<input type ='submit' name ='sentBat' value ='Отправить' />
</form>";

if (isset($_POST['sentBat']) && $_POST['user']!="" && $_POST['email']!="")   //Если заполнены поля и нажата кнопка заносим данные в бд
{
   $mySql= new mysqli('localhost','root','root','imails');
   $sec=$mySql->query ("INSERT INTO `imais` (`id`, `user`, `imail`) VALUES (NULL, '".$_POST['user']."', '".$_POST['imail']."')");
if($mySql->error_list)
{
    if($mySql->errno==1062)  //если поле уже существует в бд
    {
        $errorsMas=  preg_split('/\s/', $mySql->error);
    if(stripos($errorsMas[5],'user'))
    {
        echo 'Пользователь с таким логином уже существует <br>';
    }

    if(stripos($errorsMas[5],'imail'))
    {
        echo 'Пользователь с таким имейлом уже существует <br> ';
    }
    }
    else{
        echo $mySql->error;
    }

}
$mySql->close();

}
if (isset($_POST['sentBat']) && $_POST['user']=="")  //Выводим ошибки если не заполнена форма
{
    echo 'Введите логин';
}
if (isset($_POST['sentBat']) && $_POST['email']=="")
{
    echo 'Введите емейл';
}

echo "<form method ='post'>
<input type ='submit' name ='show' value ='Показать всех пользователей'  />
</form>";   //Кнопка для просмотра всех полей

if(isset($_POST['show']))  //Если нажата кнопка выводим все поля
{
    $mySql= new mysqli('localhost','root','root','imails');
    $result=$mySql->query ("SELECT * FROM `imais`");

    while($row = $result->fetch_assoc())
    {
        printf ("id %d Имя пользователя %s Imail %s %s", $row["id"], $row["user"], $row["imail"], '<br>');

    }


    $mySql->close();

}


