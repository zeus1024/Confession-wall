<?php session_start(); 
include_once('dbconfig.php');
include_once('class.php');
include_once('function.php');
$re=new response;

if(!$conn=db_init()) $re->setf(0,mysqli_connect_error($conn));
if(!loginproc($username,$password)) $re->setf(0,"请输入用户名和密码！");
$proc=$conn->prepare("SELECT pswhash FROM udb WHERE usn = ?");

if(!$proc)  $re->setf(0,"预处理失败！");
		$proc->bind_param("s",$username);
		$proc->execute();
 		$retval=$proc->get_result();
		$proc->close();

	
$res=mysqli_num_rows($retval);
if(! $res ) $re->setf(0,"用户未注册！");
$row = mysqli_fetch_assoc($retval);

if (password_verify($password,$row[pswhash]))
{ 
	$re->sets(1,"登录成功");
	$_SESSION['user']=$username;
	$re->binddata_s($username);
	$re->out();
	
}
else
{
	$re->setf(0,"用户名或密码错误");
}



?>
	
	
	

