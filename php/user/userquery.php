<?php

include_once('../function.php');
include_once('../class_response.php');
$re=new response;
if(!checklogin()) $re->setf(2,"用户未登录");
$re->sets(1,$_SESSION['user']);
$re->out();
?>