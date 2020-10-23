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
?>