<?php
require_once("../../config/db_con.php");
if($_GET['func'] == 'sub'){
	$id=explode('send/',trim($_GET['id']))[1];
	$chk=mySingleData('user_alarm','reg_id','reg_id',$id);
	if($chk == ""){
		$ins="insert into user_alarm (reg_id) values ('".$id."')";
		$res=myQueryDb($ins);
	}
}elseif($_GET['func'] == 'unsub'){
	$id=explode('send/',trim($_GET['id']))[1];
	$chk=mySingleData('user_alarm','id','reg_id',$id);
	if($chk != ""){
		$del="delete from user_alarm where reg_id = '".$id."'";
		$res=myQueryDb($del);
	}
}
//file_put_contents("data.txt",$_GET['id']);
?>
