<?php
class response{
	public $code;
	public $msg;
	public $data;
	function sets($code,$msg="")
	{
		$this->code=$code;
		$this->msg=$msg;
	}
	function out()
	{
		echo json_encode($this,JSON_UNESCAPED_UNICODE);
		die;
	}
	function setf($code,$msg)
	{
		$this->code=$code;
		$this->msg=$msg;
		echo json_encode($this,JSON_UNESCAPED_UNICODE);
		die;
	}
	function binddata_s($obj){
		$this->data=$obj;
	}
	function binddata_m($obj){
		$this->data[]=$obj;
	}
	
}
class t_base{
	public $tid;
	public $type;
	public $title;
	public $poster;
	public $date;
	function bind_info($row)
	{
	$this->tid=$row['tid'];
	$this->type=$row['type'];
	$this->title=$row['title'];
	if($row['hide_poster']) $this->poster="匿名用户";else $this->poster=$row['poster'];
	$this->date=$row["date"];	
	}
}
class t extends t_base{
	public $content;
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
?>