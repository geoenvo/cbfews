<?php
require_once("../config/db_con.php");
$datas_threshold = array();

$threshold = "SELECT * FROM kalikatir.threshold";
$res_threshold = myQueryDb($threshold);

while ($res_threshold_row = myAssocDb($res_threshold)) {
    // code...
    $datas_threshold [] = $res_threshold_row;
}

echo json_encode(["data"=>$datas_threshold],JSON_NUMERIC_CHECK);
?>
