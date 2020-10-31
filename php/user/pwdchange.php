<?php
include_once('../function.php');
include_once('../dbconfig.php');
include_once('../class_response.php');
$re=new response;
if(!checklogin()) $re->setf(2,"用户未登录");
if($_GET['password1']=="" or $_GET['password2']=="") $re->setf(0,"原密码或新密码未输入");
$username=$_SESSION['user'];
$conn=db_init();
$sql = "SELECT pswhash FROM udb WHERE usn = $username;";
$retval=$conn->query($sql);
$row = mysqli_fetch_assoc($retval);
if (password_verify($_GET['password1'],$row[pswhash]))
{   
	$hash=password_hash($_GET['password2'], PASSWORD_DEFAULT);
	$sql = "UPDATE udb SET pswhash = '$hash' WHERE usn='$username'; " ;
	$conn->query($sql);
	$re->sets(1,"修改成功");
	$re->out();
	
}
else
{
	$re->setf(0,"原密码错误");
}
