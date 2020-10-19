<?php


echo 'Введите вашу дату рождения';       //Форма для ввода даты рождения
echo "<form method ='post'>
<input type='date' name ='first'value =";
if(isset($_POST['podtv']))      //Обрабатываем форму если отправлена ноавая дата сохраняем ее в куки
{
    echo htmlspecialchars($_POST['first'],ENT_HTML5);
    setcookie('oldData',$_POST['first']);
}

else{
    if(isset($_COOKIE['oldData']))
    {
        echo $_COOKIE['oldData'];
        $_POST['first']=$_COOKIE['oldData'];
    }
}
echo ">
<input type ='submit' name ='podtv' value ='Отправить' />
</form>";

if(isset($_POST['first']))  //Вычисляем прожитое количество дней
{
    $bday = new DateTime($_POST['first']);
    $today = new DateTime();
    $diff = $today->diff($bday);
    echo 'Вы прожили:'. $diff->days.' дней';
    echo '<br>';
    $easternCalendar= array('Обезьяна','Петух','Собака','Свинья','Крыса','Бык','Тигр','Кролик','Дракон','Змея','Лошадь','Коза');
    echo 'По восточному календарю вы: '.$easternCalendar[$bday->format('Y')%12];  //Вычислем дату по восточному календар
    echo '<br>';
    echo '<br>';
    echo 'Узнать какого числа вам исполнится введеное количество дней:';


    echo "<form method ='post'>
<input type='text'  size= '16' name ='countDay'value =";   //Форма для ввода вычисляемого количества дней
    if(isset($_POST['podtvday']))    //Обрабатываем форму если отправлено ноавое количество дней то  сохраняем их в куки
    {
      echo  htmlspecialchars($_POST['countDay'],ENT_HTML5);
        setcookie('findDayByDay',$_POST['countDay']);
    }
    else{

        if(isset($_COOKIE['findDayByDay']))
        {
            echo $_COOKIE['findDayByDay'];
            $_POST['countDay']=$_COOKIE['findDayByDay'];
        }
    }
    echo">
 <input type ='submit' name ='podtvday' value ='Отправить'  />
</form>";
    $countDayText=$_POST['countDay'].' дней вам исполнится: ';

    if(isset($_POST['countDay']) && $_POST['countDay']>0)   //Опрелеляем дату по заданному количеству дней
    {
        $targetDay=$_POST['countDay'];
        if($diff->days<$targetDay)  //Если дней больше чем на сегоднешнее число
        {
            $moreDay = $targetDay-$diff->days;
            $actdate=$today->add(new DateInterval('P'.$moreDay.'D'));
            echo $countDayText;
            echo $actdate->format('d.m.Y');
        }

        elseif($diff->days>$targetDay)  //Если дней меньше чем на сегоднешнее число
        {
            $deductionDay = $diff->days-$targetDay;
            $actdate=$today->sub(new DateInterval('P'.$deductionDay.'D'));
            echo $countDayText;
            echo $actdate->format('d.m.Y');
        }

        elseif($diff->days==$targetDay)   //если одинаково
        {
            echo $countDayText;
            echo $targetDay. 'сегодня';
        }

    }
    if(isset($_POST['countDay']) && $_POST['countDay']<=0)   //Если задано неправильное количество дней
    {
        echo 'Пожалуйста, введите положительное количество лет';
    }

}
