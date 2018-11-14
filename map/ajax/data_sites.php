<?php
    require_once("../config/db_con.php");
    $datas = array();
    $data_maps = array();

    $type=$_GET['type'];
    $set=$_GET['set'];
    $range = $_GET['value'];
    $site_id=$_GET['site_id'];

    if($type=="maps"){
        $sql ="SELECT * FROM site";
        $res = myQueryDb($sql);
        while($row=myAssocDb($res)){
            $data_maps[] = $row;
        };
        echo json_encode($data_maps,JSON_NUMERIC_CHECK);
    }
    else if($type=="arg_mobile"){
        // code...
        $sql = "SELECT s.*,ul.* FROM kalikatir.updated_log as ul
    	JOIN site as s ON s.site_id = ul.site_id
        WHERE ul.site_id = $site_id
        AND ul.client_date >= DATE(NOW()) - INTERVAL 0 DAY
        order by ul.client_date asc
        ";
        $res = myQueryDb($sql);
        while($row=myAssocDb($res)){
            $datas[] = $row;
        };

        echo json_encode($datas,JSON_NUMERIC_CHECK);
    }
    else if($type=="last_updated"){
        $sql = "SELECT client_date FROM updated_log
        order by client_date
        desc limit 0,1";

        $res = myQueryDb($sql);
        while($row=myAssocDb($res)){
            $datas[] = $row;
        };

        echo json_encode($datas,JSON_NUMERIC_CHECK);
        // $("#last_updated").text(date("d M Y, H:i", strtotime('+7 hours', strtotime($datas)))+" WIB");
    }
    else
    {
        $sql = "SELECT s.*,ul.* FROM kalikatir.updated_log as ul
    	JOIN site as s ON s.site_id = ul.site_id
        WHERE ul.site_id
        IN (select site_id from kalikatir.site)
        AND ul.client_date >= DATE(NOW()) - INTERVAL 0 DAY
        order by ul.client_date asc";

        $res = myQueryDb($sql);
        while($row=myAssocDb($res)){
            $datas[] = $row;
        };

        echo json_encode($datas,JSON_NUMERIC_CHECK);
    }

?>
