<?php
include_once('../function.php');
include_once('../dbconfig.php');
include_once('../class_response.php');
include_once('class_t.php');
$re=new response;
if(!checklogin()) $re->setf(0,"用户未登录");
$username=$_SESSION['user'];
if(!$conn=db_init()) $re->setf(0,mysqli_connect_error($conn));
$proc=$conn->prepare('SELECT tid,type,title,poster,date FROM t WHERE poster = ? ORDER BY tid;');
if(!$proc)  $re->setf(0,"预处理失败！");
		$proc->bind_param("s",$username);
		$proc->execute();
 		$retval=$proc->get_result();
		$proc->close();
while($row=mysqli_fetch_assoc($retval))
{$t=new t_base;
 $t->bind_info($row);
 $re->binddata_m($t);
}
$re->sets(1);
$re->out();
?>