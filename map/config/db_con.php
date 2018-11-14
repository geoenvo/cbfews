<?php
//session_start();
$myDBuserName="root";
$myDBpassword="root!@#)(*";
$myDBhostname="localhost";
$myDBname="kalikatir";

$err = false;
//MYSQL FUNCTION======================
function myOpenDb() {
 	global $myDBhostname,$myDBuserName,$myDBpassword,$myDBname,$msg_err,$mysql_conn,$err;

	$mysql_conn = mysqli_connect($myDBhostname,$myDBuserName,$myDBpassword,$myDBname);
	if (mysqli_connect_errno()){
		$msg_err .= "Error connecting to server: " . mysqli_error(). "<br>";
		$err = true;
	}else {
		//$mysql_db = @mysql_select_db($myDBname,$mysql_conn);
		//if(!$mysql_db) {
		//	$msg_err .= "Error selecting MySQL database: " . mysql_error(). "<br>";
		//	$err = true;
		//}else {
			mysqli_autocommit($mysql_conn,TRUE);
			return $mysql_conn;
		//}
	}
}

function myCloseDb() {
	global $mysql_conn;
	mysqli_close($mysql_conn);
}

function myQueryDb($query) {
 	global $msg_err,$err,$mysql_conn;
	$result = mysqli_query($mysql_conn,$query);
	if(!$result) {
		$msg_err .= "MySQL Query Error: " . mysqli_error(). "<br>";
		$err = true;
	}else {
		return $result;
	}
}

function myFetchDb($result) {
	$row = mysqli_fetch_array($result,MYSQLI_BOTH);
	return $row;
}

function myAssocDb($result) {
	$row = mysqli_fetch_assoc($result);
	return $row;
}


function myNumDb($result) {
	$num = mysqli_num_rows($result);
	return $num;
}

function mySingleData($table,$field,$where,$key){
	$str="SELECT `". $field . "` FROM ". $table . " WHERE " . $where . "='".$key."'";
	$res=myQueryDb($str);
	$row=myFetchDb($res);
	return $row[$field];
}
myOpenDb();
?>
