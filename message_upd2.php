<?php
error_reporting(0);
	
	define('IN_PHP','1');
	include_once 'class/mysql.class.php';
	require_once "class/Upload.class.php";
	$dbObj = new db_mysql('localhost','root','root','wu');
	$page = isset($_GET['page'])?$_GET['page']:$_POST['pages'];
	//echo '$page='.$page.'<br>';
	//exit();
	if(!empty($_FILES))
	{
		$img=$_FILES['hfile'];
		echo "<pre>";
		print_r($img);
		echo "</pre>";
		//exit();

		$type=$img['type'];
		
		$type2=array('image/png','image/jpg','image/gif','image/jpeg');
		if(!in_array($type,$type2))
		{
		   echo "<script>";
		   echo "alert('类型不被允许');";
		   echo "location.href='message_upd.php';";
		   echo "</script>";
		   exit;
		}
	}

	if(!empty($_POST))
	{		
		$fileArr=array(
						'filepath'=>date('Y-m-d'),
						 'allowsize'=>1024*1024*2,
						'allowmime'=>array('image/jpg','image/jpeg','image/png','image/gif')
						);
		$upObj=new fileup($fileArr);
		$picture = $upObj->up('hfile');
		
	
		$s_path=date("Y-m-d")."/".$picture;
		$_POST['s_path']=$s_path;

		$str=$_POST['province']."省".$_POST['city']."市".$_POST['county']."县";
		$_POST['s_add']=$str;
		unset($_POST['province']);
		unset($_POST['city']);
		unset($_POST['county']);

		$str2=$_POST['selYear']."年".$_POST['selMonth']."月".$_POST['selDay']."日";
		$_POST['s_time']=$str2;
		
		unset($_POST['selMonth']);
		unset($_POST['selDay']);


		$now=date('Y');
		$s_age=$now-($_POST['selYear']);
		unset($_POST['selYear']);
		$_POST['s_age']=$s_age;

	$s_id = isset($_POST['s_id'])?$_POST['s_id']:'';
		unset($_POST['s_id']);
		unset($_POST['pages']);
		$flg = $dbObj->update('message',$_POST,"s_id='$s_id'");
		if($flg){
			echo "<script>";
			echo "alert('修改成功');";
			echo "location.href='message_all.php?pno={$page}';";
			echo "</script>";
		}
		else
		{
			echo "<script>";
			echo "alert('修改失败');";
			echo "location.href='message_upd.php?s_id={$s_id}&page={$page}';";
			echo "</script>";
		}
		
	}
?>