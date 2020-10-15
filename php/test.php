<?php
class response{
	public $code;
	public $msg;
	public $data;
}
class t{
	public $tid;
	public $title;
	public $content;
	public $poster;
	public $date;
	public $reply;
}
class reply{
	public $content;
	public $poster;
	public $date;
	
}
$response=new response;
$replylist=array();
const dbhost = 'localhost:3306';  // mysql服务器主机地址
const dbuser = 'gra';            // mysql用户名
const dbpass = '35068';          // mysql用户名密码
const dbname = 'itc';
$conn = mysqli_connect(dbhost, dbuser, dbpass,dbname);
if(! $conn )
{
    die('连接失败: ' . mysqli_error($conn));
}
// 设置编码，防止中文乱码
	
mysqli_query($conn , "set names utf8");
 $proc=$conn->prepare("SELECT * FROM t where tid = ?;");
if(!$proc) die("预处理失败");
		$proc->bind_param("s",$tid);
		$tid=1;
		$proc->execute();
 		$retval=$proc->get_result();
		$proc->close();
while($row = mysqli_fetch_assoc($retval))
{
	$t=new t;
	$t->tid=$row['tid'];
	$t->title=$row['title'];
	$t->content=$row['content'];
	if($row['hide_poster']) $t->poster="匿名用户";else $t->poster=$row['poster'];
	$t->date=$row["date"];	
}
 $proc=$conn->prepare("SELECT * FROM reply where tid = ?;");
if(!$proc) die("预处理失败");
		$proc->bind_param("s",$tid);
		$tid=1;
		$proc->execute();
 		$retval=$proc->get_result();
		$proc->close();
while($row = mysqli_fetch_assoc($retval))
{
	$reply=new reply;
	$reply->content=$row['content'];
	$reply->date=$row['date'];
	if($row['hide_poster']) $reply->poster="匿名用户";
	else $reply->poster=$row['poster'];
	$replylist[]=$reply;
}
$t->reply=$replylist;
$response->code=1;$response->msg="success";$response->data=$t;
echo json_encode($response,JSON_UNESCAPED_UNICODE);
?>