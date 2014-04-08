<?php


function think_ucenter_md5($str, $key = 'ThinkUCenter'){
	return '' === $str ? '' : md5(sha1($str) . $key);
}


echo think_ucenter_md5('123456','hebidu');