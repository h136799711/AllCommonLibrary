<?php
	$str = "我是中文woshizhongwen";
	$code = json_encode($str);
	define("BR",     "<br/>");
	echo $code.BR;
	echo $code.BR; 
   echo preg_replace("#\\\u([0-9a-f]{4})#ie", "iconv('UCS-2BE', 'UTF-8', pack('H4', '\\1'))", $code).BR;
   echo preg_replace("#\\\u([0-9a-f]{4})#ie", "iconv('UCS-2', 'UTF-8', pack('H4', '\\1'))", $code).BR;
?>