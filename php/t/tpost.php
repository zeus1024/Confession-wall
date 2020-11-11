<?php
include_once('../function.php');
include_once('../dbconfig.php');
include_once('../class_response.php');
$re=new response;
if(!checklogin()) $re->setf(2,"用户未登录");
$title=$_POST['title'];
if($title=="") $re->setf(0,"未输入标题！");
$poster=$_SESSION['user'];
$content=$_POST['content'];
$type=innump("type",1);
$hide_poster=innump("hp",0);
if(!$conn=db_init()) $re->setf(0,mysqli_connect_error($conn));
$proc=$conn->prepare('INSERT INTO t (type,hide_poster,title,poster,content) VALUES (?,?,?,?,?);');
if(!$proc)  $re->setf(0,"预处理失败！");
		$proc->bind_param("iisss",$type,$hide_poster,$title,$poster,$content);
		if(!$proc->execute())$re->setf(0,"发帖失败");
		$proc->close();
		$re->sets(1,"发帖成功");
		$re->out();
?>
