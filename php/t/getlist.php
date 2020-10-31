<?php
include_once('../dbconfig.php');
include_once('class_t.php');
include_once('../class_response.php');
include_once('../function.php');
$re=new response;
if(!$conn=db_init()) $re->setf(0,mysqli_connect_error($conn));
$num=innum('num',10);
$offset=innum('offset',0);
$proc=$conn->prepare("SELECT tid,type,title,poster,date FROM t ORDER BY tid LIMIT ?,? ;");
if(!$proc)  $re->setf(0,"预处理失败！");
		$proc->bind_param("ii",$offset,$num);
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