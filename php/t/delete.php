<?php
include_once('../function.php');
include_once('../dbconfig.php');
include_once('../class_response.php');
$re=new response;
if(!checklogin()) $re->setf(0,"用户未登录");
$username=$_SESSION['user'];
$tid=innum("tid",0);
if(!$tid) $re->setf(0,"删除错误");
if(!$conn=db_init()) $re->setf(0,mysqli_connect_error($conn));
$proc=$conn->prepare('DELETE from t WHERE poster= ? and tid= ?');
if(!$proc)  $re->setf(0,"预处理失败！");
		$proc->bind_param("si",$username,$tid);
		$proc->execute();
		$affected=$proc->affected_rows;
		if(!$affected)$re->setf(0,"删除失败");
		$proc->close();
		$re->sets(1,"删帖成功");
		$re->out();
?>
