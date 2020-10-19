<?php

$massCount=3;
$mass = [$massCount][$massCount][$massCount][$massCount][$massCount]; //Создаем 5 мерный массив

for($i=0; $i<$massCount;$i++)
{
    for($j=0;$j<$massCount;$j++)
    {
        for($k=0;$k<$massCount;$k++)
       {
           for($l=0;$l<$massCount;$l++)
           {
               for($s=0;$s<3;$s++)
               {
                   $mass[$i][$j][$k][$l][$s]=rand(0, 10);//Заполняем массив случайными числами
                   $val=$mass[$i][$j][$k][$l][$s];
                  // Отображаем уровни вложенности
                   printf("<span style='color: #FF0000'>  Уровень вложенности 1= $i  </span>");
                   printf("<span style='color: #0000FF'>  Уровень вложенности 2= $j  </span>");
                   printf("<span style='color: #00FF00'>  Уровень вложенности 3= $k  </span>");
                   printf("<span style='color: #8B008B'>  Уровень вложенности 4= $l  </span>");
                   printf("<span style='color: #FFFF00'>  Уровень вложенности 5= $s  </span>");
                    //Отоброжаем значения нужным цветом
                   if($val%2==0 && $val!=0)
                    {printf("<span style='color: #ff0000'>  Значение= $val  </span>");}
                    else{
                       if($val!=0)
                      { printf("<span style='color: 8B008B'>  Значение= $val  </span>");}}
                   printf("<br>");
               }
           }
       }
    }
}
