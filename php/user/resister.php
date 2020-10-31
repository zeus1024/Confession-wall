<?php
include_once('../function.php');
include_once('../dbconfig.php');
include_once('../class_response.php');
$re=new response;
if(!$conn=db_init()) $re->setf(0,mysqli_connect_error($conn));
if(!loginproc($username,$password)) $re->setf(0,"请输入用户名和密码！");
$proc=$conn->prepare('INSERT INTO udb (usn,pswhash,cookie) VALUES (?,?,?);');
if(!$proc)  $re->setf(0,"预处理失败！");
		$auth=date("YmdHis").rand(1,999);
		$hash=password_hash($password, PASSWORD_DEFAULT);
		$proc->bind_param("sss",$username,$hash,$auth);
		if(!$proc->execute())$re->setf(0,"注册错误");
		$proc->close();
		setcookie("auth", base64_encode($auth), time()+3600*240,"/");
		$_SESSION['user']=$username;
		$re->sets(1,"注册成功");
		$re->out();
?>