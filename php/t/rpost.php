<?php
include_once('../function.php');
include_once('../dbconfig.php');
include_once('../class_response.php');
$re=new response;
if(!checklogin()) $re->setf(2,"用户未登录");
$poster=$_SESSION['user'];
if(!isset($_POST['content'])) $re->setf(0,"请输入回复内容");
$content=$_POST['content'];
$tid=$_POST['tid'];
if(!($tid!="" and is_numeric($tid))) $re->setf(0,"回复错误，未找到回复对象");
$hide_poster=innump("hp",0);
if(!$conn=db_init()) $re->setf(0,mysqli_connect_error($conn));
$proc=$conn->prepare('INSERT INTO reply (tid,hide_poster,poster,content) VALUES (?,?,?,?);');
if(!$proc)  $re->setf(0,"预处理失败！");
		$proc->bind_param("iiss",$tid,$hide_poster,$poster,$content);
		if(!$proc->execute())$re->setf(0,"回帖失败");
		$proc->close();
		$re->sets(1,"回帖成功");
		$re->out();
?>
