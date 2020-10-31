<?php
include_once('../function.php');
include_once('../dbconfig.php');
include_once('../class_response.php');
$re=new response;
if(!checklogin()) $re->setf(2,"用户未登录");
$username=$_SESSION['user'];
session_unset(); 
session_destroy();
setcookie("auth", "", time()-3600);
$conn=db_init();
$sql = "UPDATE udb SET cookie = '' WHERE usn='$username' " ;
$conn->query($sql);
$re->sets(1,"注销成功");
$re->out();
?>
