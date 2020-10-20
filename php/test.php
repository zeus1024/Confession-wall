<?php
class response{
	public $code;
	public $msg;
	public $data;
	
}
class t{
	public $tid;
	public $type;
	public $title;
	public $content;
	public $poster;
	public $date;
	public $reply;
	function bind_reply($retval)
	{while($row = mysqli_fetch_assoc($retval))
		{
		   $reply=new reply;
		   $reply->bind_reply($row);
		   $this->reply[]=$reply;
	
		}
		
		
	}
	function bind_info($row)
	{
	$this->tid=$row['tid'];
	$this->type=$row['type'];
	$this->title=$row['title'];
	$this->content=$row['content'];
	if($row['hide_poster']) $this->poster="匿名用户";else $this->poster=$row['poster'];
	$this->date=$row["date"];	
	}
}
class reply{
	public $content;
	public $poster;
	public $date;
	function bind_reply($row)
	{
		$this->content=$row['content'];
		$this->date=$row['date'];
		if($row['hide_poster']) $this->poster="匿名用户";
		else $this->poster=$row['poster'];
	
	}
}
$response=new response;
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
 		$retval_t=$proc->get_result();
		$proc->close();
 $proc=$conn->prepare("SELECT * FROM reply where tid = ?;");
if(!$proc) die("预处理失败");
		$proc->bind_param("s",$tid);
		$tid=1;
		$proc->execute();
 		$retval_reply=$proc->get_result();
		$proc->close();
$t=new t;
$t->bind_reply($retval_reply);
$t->bind_info($row=mysqli_fetch_assoc($retval_t));
$response->code=1;$response->msg="success";$response->data=$t;
echo json_encode($response,JSON_UNESCAPED_UNICODE);
?>
