<?php
    require_once("../config/db_con.php");
    $type = $_GET['type'];
    $site_id = $_GET['site_id'];
    $range = $_GET['value'];
    $set = $_GET['set'];

    if($type=="arg"){
        $datas = array();
        $sql = "SELECT l.client_date,l.site_id,l.arg FROM log as l
        -- WHERE l.site_id IN (select site_id from site)
        WHERE l.site_id = $site_id
        AND l.client_date >= DATE(NOW()) - INTERVAL 0 DAY
        order by l.client_date asc
        ";
        $res = myQueryDb($sql);
        while($row=myAssocDb($res)){
            $datas[] = $row;
        };
        echo json_encode($datas,JSON_NUMERIC_CHECK);
    }
    else if($type=="arg_mobile"){
        $datas = array();
        $sql = "SELECT l.client_date,l.site_id,l.arg FROM log as l
        -- WHERE l.site_id IN (select site_id from site)
        WHERE l.site_id = $site_id
        AND l.client_date >= DATE(NOW()) - INTERVAL 0 DAY
        order by l.client_date asc
        ";
        $res = myQueryDb($sql);
        while($row=myAssocDb($res)){
            $datas[] = $row;
        };
        echo json_encode($datas,JSON_NUMERIC_CHECK);
    }
    else if($type=="awlr"){
        $datas = array();
        $sql = "SELECT l.client_date,l.site_id,l.awlr FROM log as l
        -- WHERE l.site_id IN (select site_id from site)
        WHERE l.site_id = $site_id
        AND l.client_date >= DATE(NOW()) - INTERVAL 0 DAY
        order by l.client_date asc
        ";
        $res = myQueryDb($sql);
        while($row=myAssocDb($res)){
            $datas[] = $row;
        };

        echo json_encode($datas,JSON_NUMERIC_CHECK);
    }
    else if($type=="awlr_mobile"){
        $datas = array();
        $sql = "SELECT l.client_date,l.site_id,l.awlr FROM log as l
        -- WHERE l.site_id IN (select site_id from site)
        WHERE l.site_id = $site_id
        AND l.client_date >= DATE(NOW()) - INTERVAL 0 DAY
        order by l.client_date asc
        ";
        $res = myQueryDb($sql);
        while($row=myAssocDb($res)){
            $datas[] = $row;
        };

        echo json_encode($datas,JSON_NUMERIC_CHECK);
    }
    else if($type=="temp_hum_mobile"){
        $datas = array();
        $sql = "SELECT l.client_date,l.site_id,l.temperature,l.humidity FROM log as l
        -- WHERE l.site_id IN (select site_id from site)
        WHERE l.site_id = $site_id
        AND l.client_date >= DATE(NOW()) - INTERVAL 0 DAY
        order by l.client_date asc
        ";
        $res = myQueryDb($sql);
        while($row=myAssocDb($res)){
            $datas[] = $row;
        };

        echo json_encode($datas,JSON_NUMERIC_CHECK);
    }
?>
