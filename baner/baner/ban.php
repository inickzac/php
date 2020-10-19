<?php
$bannerArray= array('url(images/1.jpg)','url(images/2.png)','url(images/3.jpg)','url(images/4.png)','url(images/5.jpg)','url(images/6.png)');
rand(0,count($bannerArray));

$bar = <<<EOT
 <style>
		#box {
			position: relative;

			top: 5px;
			left: px;
			width: 100px;
			height: 130px;


			background-clip: border-box;
			background-image:


EOT;

 $bar2 = <<<EOT

background-size: cover;
			transition: transform 2s;
			-webkit-transition: -webkit-transform 2s;
			-moz-transition: -moz-transform 2s;
			-o-transition: -o-transform 2s;
			/* no IE support for transition until possibly IE 10 */
		}
		#box:hover {
			transform: scale(1.2);
			-webkit-transform: scale(1.2); /* Safari, Chrome, mobile Safari, and Android */
			-moz-transform: scale(1.2); /* Firefox */
			-o-transform: scale(1.2); /* Opera */
			-ms-transform: scale(1.2); /* IE 9 */
		}
	</style>
 <div id="box">
	</div>

EOT;


$endhtml=$bar.$bannerArray[rand(0,count($bannerArray)-1)].';'.$bar2;



echo $endhtml;