<?php
include_once('../dbconfig.php');
include_once('../function.php');
include_once('../class_response.php');
$re=new response;
if($_GET['username']=="") $re->setf(0,请输入用户名);
$username=quitjs($_GET['username']);
if($username!=$_GET['username']) $re->setf(0,"用户名不合法");
if(!$conn=db_init()) $re->setf(0,mysqli_connect_error($conn));
$proc=$conn->prepare("SELECT usn FROM udb WHERE usn = ?");
if(!$proc)  $re->setf(0,"预处理失败！");
		$proc->bind_param("s",$username);
		$proc->execute();
 		$retval=$proc->get_result();
		$proc->close();
$res=mysqli_num_rows($retval);
if(!$res) {$re->sets(1);$re->out();}
else $re->setf(0,"该用户名已被注册！");
?>