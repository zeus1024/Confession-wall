<?php
include_once('dbconfig.php');
include_once('class.php');
include_once('function.php');
$re=new response;
$tid=innum("tid",0);
if(!$conn=db_init()) $re->setf(0,mysqli_connect_error($conn));
$proc=$conn->prepare("SELECT * FROM t where tid = ?;");
if(!$proc) die("预处理失败");
		$proc->bind_param("i",$tid);
		$proc->execute();
 		$retval_t=$proc->get_result();
		$proc->close();
 $proc=$conn->prepare("SELECT * FROM reply where tid = ? ORDER BY rid;");
if(!$proc) die("预处理失败");
		$proc->bind_param("i",$tid);
		$proc->execute();
 		$retval_reply=$proc->get_result();
		$proc->close();
$t=new t;
$t->bind_info($row=mysqli_fetch_assoc($retval_t));
$t->bind_reply($retval_reply);
$re->binddata_s($t);$re->sets(1);
$re->out();

?>