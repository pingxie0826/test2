<?php
	define("BASE_PATH",$_SERVER['DOCUMENT_ROOT']);
	define("SMARTY_PATH",'\muban\libs');
	$dir=BASE_PATH.SMARTY_PATH.'\Smarty.class.php';
	require_once($dir);
	$smarty=new Smarty();
	require_once('db_class.php');
	$db=new db();
	$title_a='软件学院优秀学生';
	$title_b='设计学院优秀学生';
	$title_c='动漫学院优秀学生';
	$body_a=$db->select('软件开发');
	$body_b=$db->select('环境艺术');;
	$body_c=$db->select('动漫设计');
	$smarty->assign('title_a',$title_a);
	$smarty->assign('title_b',$title_b);
	$smarty->assign('title_c',$title_c);
	$smarty->assign('body_a',$body_a);
	$smarty->assign('body_b',$body_b);
	$smarty->assign('body_c',$body_c);
	$smarty->display('0716_1.tpl');
?>