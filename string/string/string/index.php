<?php

$abcLow=[ 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ'
    , 'ы', 'ь', 'э', 'ю', 'я'];

$abcHeight;
for ($i=0; $i< count($abcLow); $i++)    //переводим массив в верхний регистр
{
    $abcHeight[$i]=mb_strtoupper($abcLow[$i], "utf-8");
}


echo "<form method ='post'>
 <textarea name='imputString' cols='70' rows='20' value =" .htmlspecialchars($_POST['imputString'],ENT_HTML5)."></textarea>
</br><input type ='submit' name ='podtvday' value ='Отправить'  />
</form>";  //Формируем форму для отправления текста

$imputString=$_POST['imputString'];
$endOfSent = array('.','?','!','..');  //разделители предложения
$StartSent=true; // если начало строки


$processedSrring=(preg_split('//u', $imputString, null, PREG_SPLIT_NO_EMPTY)); //Преобразуем строку в массив букв
$isPoint=false;

for ($i=0; $i<count($processedSrring); $i++)  //Пробегаемся циклом по строке
{

    if(in_array($processedSrring[$i],$endOfSent)) //Если символ это разделитель предложения
    {
        $isPoint=true;
        echo $processedSrring[$i];
        continue;
    }

    if($processedSrring[$i]==' ')  //если пробел
    {
        echo $processedSrring[$i];
        continue;
    }

    if(($isPoint && in_array($processedSrring[$i],$abcHeight)) || $StartSent)  //если слово в начале предложения
    {
        $resstr='<u>';
        while($processedSrring[$i]!=' ' && $i<count($processedSrring) && $processedSrring[$i]!='.' && $processedSrring[$i]!=',')
        {
            $resstr.=$processedSrring[$i];
            $i++;
        }
        $resstr.='</u>';
        echo $resstr;
        $isPoint=false;
        $i--;
        $StartSent=false;
        continue;

    }

    if(!$isPoint && in_array($processedSrring[$i],$abcHeight)) //если не в начале строки
    {
        $resstr="<span style='color:#FF0000'>";
        while($processedSrring[$i]!=' ' && $i<count($processedSrring) && $processedSrring[$i]!='.' && $processedSrring[$i]!=',')
        {
            $resstr.=$processedSrring[$i];
            $i++;
        }
        $resstr.='</span>';
        echo $resstr;
        $isPoint=false;
        $i--;
    continue;
    }


    echo $processedSrring[$i]; //если другой символ


}




