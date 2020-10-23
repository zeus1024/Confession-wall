<?php
session_start();
function db_init()
{
	$conn = mysqli_connect(dbhost, dbuser, dbpass,dbname);
	if( $conn )
	{
 	mysqli_query($conn , "set names utf8mb4");
	}
 return $conn;
}
function innum($name,$default)
{
	if(!is_numeric($tar=$_GET[$name])) $tar=$default;
	return $tar;
}
function quitjs($str)
{
	$search = array ("'<script[^>]*?>.*?</script>'si", // 去掉 javascript
"'<[\/\!]*?[^<>]*?>'si", // 去掉 HTML 标记
"'([\r\n])[\s]+'", // 去掉空白字符
"'&(quot|#34);'i", // 替换 HTML 实体
"'&(amp|#38);'i",
"'&(lt|#60);'i",
"'&(gt|#62);'i",
"'&(nbsp|#160);'i",
); 
$replace = array ("","","\\1","\"","&","<",">"," ","");
$str = preg_replace($search, $replace, $str);
return $str;
}
function loginproc(&$username,&$password)
{
	if($_GET['username']=="" or $_GET['password']=="")  {return 0;}
	else
	{
	 $username=quitjs($_GET['username']);
	 $password=$_GET['password'];
	 return 1;
	}
	
}
function checklogin()
{	include_once('dbconfig.php');
	if(isset($_SESSION['user'])) return true;
	else if(isset($_COOKIE['auth']))
	{	$auth=base64_decode($_COOKIE['auth']);
	    
		if(!$conn=db_init()) return false;
		$proc=$conn->prepare("SELECT usn FROM udb WHERE cookie=? ;");
		if(!$proc) return false;
		$proc->bind_param("i",$auth);
		$proc->execute();
 		$retval=$proc->get_result();
		$proc->close();
	 	if(!$res=mysqli_num_rows($retval)) return false;
	    $row=mysqli_fetch_assoc($retval);
	    $_SESSION['user']=$row['usn'];
	 	return true;
	}
	
}
?>