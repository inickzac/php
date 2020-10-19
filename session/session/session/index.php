<?php
$successSessionStart=session_start();  //Создать или возвратить сессию
if(!isset($_SESSION['timeEnter']))
{
    $d=1;
$_SESSION['countVisit']=0;         //счетчик посещений
echo 'Вы посещали эту страницу 1 раз';
}
$nowDate = new DateTime();
$_SESSION['timeEnter'][]=$nowDate->format('Y-m-d H:i:s');  //Запоминаем дату и время посещения

echo "<form method ='post'>
<input type ='submit' name ='delCook' value ='Удалить сессию' />
</form>";  //кнопка для удаления сессии

if(isset($_POST['delCook']))
{
    $_SESSION = [];
    unset ($_COOKIE[session_name()]);
    session_destroy();
}
$_SESSION['countVisit']++; //Увеличиваем счетчик посещений

if($_SESSION['countVisit']>1)     //Если не первый визит то выводим предыдущие посещения
{echo 'Вы посещали эту страницу '.$_SESSION['countVisit'].' раза </br>';
echo 'Дата и время посещения страницы: </br>';
foreach($_SESSION['timeEnter'] as $value)
{
    echo $value.'</br>';
}
}