<?php
	define('IN_PHP','ok');
	include_once 'class/mysql.class.php';
	$dbObj = new db_mysql('localhost','root','root','project2');
	header("content-type:text/html;charset=utf-8");
	//echo "<pre>";
	//print_r($_POST);
	//echo "</pre>";
	//EXIT();
	if(!empty($_POST)){
		if($_POST['upwd_a'] != $_POST['upwd_b']){
			echo "<script>";
			echo "alert('密码不符，请重新输入');";
			echo "location.href='unameadd.php';";
			echo "</script>";
		}else{
			$_POST['upwd'] = md5($_POST['upwd_a']);
			unset($_POST['upwd_a']);
			unset($_POST['upwd_b']);
			$add = $dbObj->insert('dy_user',$_POST);
		
			if($add){//添加成功
			echo "<script>";
			echo "alert('注册成功');";
			echo "location.href='login.php';";
			echo "</script>";
			}else{//添加失败
				echo "<script>";
				echo "alert('注册失败');";
				echo "location.href='unameadd.php';";
				echo "</script>";
				exit();
			}
		}
	}
?>
<html>
	<head>
		<meta charset='utf-8'>
		<title>用户注册</title>
	</head>
	<body>
	<form action='unameadd.php' method='post'>
		用户名：<input type='test' name='uname' id='uname'><br>
		用户密码：<input type='password' name='upwd_a' id='upwd_a'><br>
		确定密码：<input type='password' name='upwd_b' id='upwd_b'><br>
		<input type='submit' value='注册'>&nbsp;&nbsp;
		<input type='button' onclick="location.href='login.php';" value='返回'>
	</form>
	</body>
</html>