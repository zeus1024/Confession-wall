<?php
include_once('../function.php');
include_once('../dbconfig.php');
include_once('../class_response.php');
$re=new response;
if(!checklogin()) $re->setf(2,"用户未登录");
$poster=$_SESSION['user'];
$title=$_GET['title'];
$content=$_GET['content'];
$type=innum("type",1);
$hide_poster=innum("hp",0);
if($title=="") $re->setf(0,"未输入标题！");
if(!$conn=db_init()) $re->setf(0,mysqli_connect_error($conn));
$proc=$conn->prepare('INSERT INTO t (type,hide_poster,title,poster,content) VALUES (?,?,?,?,?);');
if(!$proc)  $re->setf(0,"预处理失败！");
		$proc->bind_param("iisss",$type,$hide_poster,$title,$poster,$content);
		if(!$proc->execute())$re->setf(0,"发帖失败");
		$proc->close();
		$re->sets(1,"发帖成功");
		$re->out();
?>
