<?php
    require_once("../config/db_con.php");
    $datas_as = array();
    $datas_bl = array();
    $datas_ma = array();
    $datas_jt = array();
    $datas_kl = array();

    $datas_threshold = array();
    $data_sites = array();
    $data_maps = array();

    $type=$_GET['type'];
    $set=$_GET['set'];
    $range = $_GET['value'];
    $site_id=$_GET['site_id'];
    $string_graph;

    if($type=="maps"){
        $sql ="SELECT * FROM site";
        $res = myQueryDb($sql);
        while($row=myAssocDb($res)){
            $data_maps[] = $row;
        };
        echo json_encode($data_maps,JSON_NUMERIC_CHECK);
    }
    else if($type=="arg_mobile"){
        //threshold
        $threshold = "SELECT * FROM kalikatir.threshold";
        $res_threshold = myQueryDb($threshold);

        while ($res_threshold_row = myAssocDb($res_threshold)) {
            // code...
            $datas_threshold [] = $res_threshold_row;
        }

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

        $data_sites = array_merge($datas,$datas_threshold);

        echo json_encode($data_sites,JSON_NUMERIC_CHECK);
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
    else if($type=="data_site"){

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
    else
    {
        //get site name
        $data_site = array();

        $site = "SELECT * FROM kalikatir.site";
        $res_site = myQueryDb($site);
        while ($row_site=myAssocDb($res_site)) {
            $data_site []= $row_site;
        }

        //threshold
        $threshold = "SELECT * FROM kalikatir.threshold";
        $res_threshold = myQueryDb($threshold);

        while ($res_threshold_row = myAssocDb($res_threshold)) {
            // code...
            $datas_threshold [] = $res_threshold_row;
        }

        $merah=0;$biru=0;$kuning=0;$hijau=0;

        //===================================================== akar seribu ==============================================================================================
        $sql_as = "SELECT s.*,ul.* FROM kalikatir.updated_log as ul
    	JOIN site as s ON s.site_id = ul.site_id
        WHERE ul.site_id
        IN (select site_id from kalikatir.site where site_id=53)
        AND ul.client_date >= DATE(NOW()) - INTERVAL 0 DAY
        order by ul.client_date asc";

        $res_as = myQueryDb($sql_as);

        while($row_as=myAssocDb($res_as)){
            // if($row['site_name'] == 'SITE AKAR SERIBU') $row['awlr'] = 12000;
            //normal
            if(($row_as['awlr']>=$datas_threshold[3]['min_value']) && ($row_as['awlr']<=$datas_threshold[3]['max_value']) )
            {
                $row_as['color_awlr']="#4db6ac";
                $hijau++;
            }
            //waspada
            else if(($row_as['awlr']>$datas_threshold[2]['min_value']) && ($row_as['awlr']<=$datas_threshold[2]['max_value']))
            {
                $row_as['color_awlr']="#00b0ff";
                $biru++;
            //siaga
            }
            else if(($row_as['awlr']>=$datas_threshold[1]['min_value']) && ($row_as['awlr']<=$datas_threshold[1]['max_value']))
            {
                $row_as['color_awlr']="#ffff00";
                $kuning++;
            }
            //awas
            else if(($row_as['awlr']>$datas_threshold[0]['min_value']) && ($row_as['awlr']>$datas_threshold[0]['max_value'])){
                $row_as['color_awlr']="#d50000";
                $merah++;
            }

            $datas_as[] = $row_as;
        };
        //===================================================== end akar seribu ==============================================================================================

        //===================================================== bedagan limo ==============================================================================================
        $sql_bl = "SELECT s.*,ul.* FROM kalikatir.updated_log as ul
    	JOIN site as s ON s.site_id = ul.site_id
        WHERE ul.site_id
        IN (select site_id from kalikatir.site where site_id=55)
        AND ul.client_date >= DATE(NOW()) - INTERVAL 0 DAY
        order by ul.client_date asc";

        $res_bl = myQueryDb($sql_bl);

        while($row_bl=myAssocDb($res_bl)){
            // if($row['site_name'] == 'SITE AKAR SERIBU') $row['awlr'] = 12000;
            //normal
            if(($row_bl['awlr']>=$datas_threshold[3]['min_value']) && ($row_bl['awlr']<=$datas_threshold[3]['max_value']) )
            {
                $row_bl['color_awlr']="#4db6ac";
                $hijau++;
            }
            //waspada
            else if(($row_bl['awlr']>$datas_threshold[2]['min_value']) && ($row_bl['awlr']<=$datas_threshold[2]['max_value']))
            {
                $row_bl['color_awlr']="#00b0ff";
                $biru++;
            //siaga
            }
            else if(($row_bl['awlr']>=$datas_threshold[1]['min_value']) && ($row_bl['awlr']<=$datas_threshold[1]['max_value']))
            {
                $row_bl['color_awlr']="#ffff00";
                $kuning++;
            }
            //awas
            else if(($row_bl['awlr']>$datas_threshold[0]['min_value']) && ($row_bl['awlr']>$datas_threshold[0]['max_value'])){
                $row_bl['color_awlr']="#d50000";
                $merah++;
            }

            $datas_bl[] = $row_bl;
        };
        //===================================================== end bedagan limo ==============================================================================================

        //===================================================== mata air ==============================================================================================
        $sql_ma = "SELECT s.*,ul.* FROM kalikatir.updated_log as ul
    	JOIN site as s ON s.site_id = ul.site_id
        WHERE ul.site_id
        IN (select site_id from kalikatir.site where site_id=58)
        AND ul.client_date >= DATE(NOW()) - INTERVAL 0 DAY
        order by ul.client_date asc";

        $res_ma = myQueryDb($sql_ma);

        while($row_ma=myAssocDb($res_ma)){
            // if($row['site_name'] == 'SITE AKAR SERIBU') $row['awlr'] = 12000;
            //normal
            if(($row_ma['awlr']>=$datas_threshold[3]['min_value']) && ($row_ma['awlr']<=$datas_threshold[3]['max_value']) )
            {
                $row_ma['color_awlr']="#4db6ac";
                $hijau++;
            }
            //waspada
            else if(($row_ma['awlr']>$datas_threshold[2]['min_value']) && ($row_ma['awlr']<=$datas_threshold[2]['max_value']))
            {
                $row_ma['color_awlr']="#00b0ff";
                $biru++;
            //siaga
            }
            else if(($row_ma['awlr']>=$datas_threshold[1]['min_value']) && ($row_ma['awlr']<=$datas_threshold[1]['max_value']))
            {
                $row_ma['color_awlr']="#ffff00";
                $kuning++;
            }
            //awas
            else if(($row_ma['awlr']>$datas_threshold[0]['min_value']) && ($row_ma['awlr']>$datas_threshold[0]['max_value'])){
                $row_ma['color_awlr']="#d50000";
                $merah++;
            }

            $datas_ma[] = $row_ma;
        };
        //===================================================== end mata air ==============================================================================================

        //===================================================== jembatan troliman ==============================================================================================
        $sql_jt = "SELECT s.*,ul.* FROM kalikatir.updated_log as ul
    	JOIN site as s ON s.site_id = ul.site_id
        WHERE ul.site_id
        IN (select site_id from kalikatir.site where site_id=57)
        AND ul.client_date >= DATE(NOW()) - INTERVAL 0 DAY
        order by ul.client_date asc";

        $res_jt = myQueryDb($sql_jt);

        while($row_jt=myAssocDb($res_jt)){
            // if($row['site_name'] == 'SITE AKAR SERIBU') $row['awlr'] = 12000;
            //normal
            if(($row_jt['awlr']>=$datas_threshold[3]['min_value']) && ($row_jt['awlr']<=$datas_threshold[3]['max_value']) )
            {
                $row_jt['color_awlr']="#4db6ac";
                $hijau++;
            }
            //waspada
            else if(($row_jt['awlr']>$datas_threshold[2]['min_value']) && ($row_jt['awlr']<=$datas_threshold[2]['max_value']))
            {
                $row_jt['color_awlr']="#00b0ff";
                $biru++;
            //siaga
            }
            else if(($row_jt['awlr']>=$datas_threshold[1]['min_value']) && ($row_jt['awlr']<=$datas_threshold[1]['max_value']))
            {
                $row_jt['color_awlr']="#ffff00";
                $kuning++;
            }
            //awas
            else if(($row_jt['awlr']>$datas_threshold[0]['min_value']) && ($row_jt['awlr']>$datas_threshold[0]['max_value'])){
                $row_jt['color_awlr']="#d50000";
                $merah++;
            }

            $datas_jt[] = $row_jt;
        };
        //===================================================== end jembatan troliman ==============================================================================================

        //===================================================== jembatan kalikatir ==============================================================================================
        $sql_kl = "SELECT s.*,ul.* FROM kalikatir.updated_log as ul
    	JOIN site as s ON s.site_id = ul.site_id
        WHERE ul.site_id
        IN (select site_id from kalikatir.site where site_id=52)
        AND ul.client_date >= DATE(NOW()) - INTERVAL 0 DAY
        order by ul.client_date asc";

        $res_kl = myQueryDb($sql_kl);

        while($row_kl=myAssocDb($res_kl)){
            // if($row['site_name'] == 'SITE AKAR SERIBU') $row['awlr'] = 12000;
            //normal
            if(($row_kl['awlr']>=$datas_threshold[3]['min_value']) && ($row_kl['awlr']<=$datas_threshold[3]['max_value']) )
            {
                $row_kl['color_awlr']="#4db6ac";
                $hijau++;
            }
            //waspada
            else if(($row_kl['awlr']>$datas_threshold[2]['min_value']) && ($row_kl['awlr']<=$datas_threshold[2]['max_value']))
            {
                $row_kl['color_awlr']="#00b0ff";
                $biru++;
            //siaga
            }
            else if(($row_kl['awlr']>=$datas_threshold[1]['min_value']) && ($row_kl['awlr']<=$datas_threshold[1]['max_value']))
            {
                $row_kl['color_awlr']="#ffff00";
                $kuning++;
            }
            //awas
            else if(($row_kl['awlr']>$datas_threshold[0]['min_value']) && ($row_kl['awlr']>$datas_threshold[0]['max_value'])){
                $row_kl['color_awlr']="#d50000";
                $merah++;
            }

            $datas_kl[] = $row_kl;
        };
        //===================================================== end jembatan troliman ==============================================================================================
        if($merah > 0){
            $status="#d50000";
            $message = "<b>AWAS</b><br>Segera evakuasi masyarakat yang ada disekitar sungai!!! Ikuti rambu evakuasi";
        }elseif($kuning > 0){
            $status="#ffff00";
            $message = "<b>SIAGA</b><br>Evakuasi masyarakat dan barang-barang ke tempat yang aman";
        }elseif($biru > 0){
            $status="#00b0ff";
            $message = "<b>WASPADA</b><br>Terdapat hujan di Hulu kurangi kegiatan di sekitar sungai";
        }elseif($hijau > 0){
            $status="#4db6ac";
            $message = "<b>NORMAL</b><br>Masyarakat dapat melakukan aktifitas seperti biasa";
        }

        if(!empty($datas_as) || !empty($datas_bl) || !empty($datas_ma) ||!empty($datas_jt) ||!empty($datas_kl)){

            echo "graph TD \n
            A".$data_site[0]['site_id']."(<b>".$data_site[0]['site_name']."</b><br>".$datas_as[0]['arg']." mm/10<br>".$datas_as[0]['awlr']." cm);

            B".$data_site[4]['site_id']."(<b>".$data_site[4]['site_name']."</b><br>".$datas_ma[0]['arg']." mm/10<br>".$datas_ma[0]['awlr']." cm);

            A".$data_site[0]['site_id']."-->C".$data_site[1]['site_id']."(<b>".$data_site[1]['site_name']."</b><br>".$datas_bl[0]['arg']." mm/10<br>".$datas_bl[0]['awlr']." cm);

            C".$data_site[1]['site_id']."-->D".$data_site[2]['site_id']."(<b>".$data_site[2]['site_name']."</b><br>".$datas_jt[0]['arg']." mm/10<br>".$datas_jt[0]['awlr']." cm);

            D".$data_site[2]['site_id']."-->E".$data_site[3]['site_id']."(<b>".$data_site[3]['site_name']."</b><br>".$datas_kl[0]['arg']." mm/10<br>".$datas_kl[0]['awlr']." cm);

            B".$data_site[4]['site_id']."-->D".$data_site[2]['site_id']."(<b>".$data_site[2]['site_name']."</b><br>".$datas_jt[0]['arg']." mm/10<br>".$datas_jt[0]['awlr']." cm);

            style A".$data_site[0]['site_id']." fill:".$datas_as[0]['color_awlr'].",stroke:".$datas_as[0]['color_awlr']."
            style B".$data_site[4]['site_id']." fill:".$datas_ma[0]['color_awlr'].",stroke:".$datas_ma[0]['color_awlr']."
            style C".$data_site[1]['site_id']." fill:".$datas_bl[0]['color_awlr'].",stroke:".$datas_bl[0]['color_awlr']."
            style D".$data_site[2]['site_id']." fill:".$datas_jt[0]['color_awlr'].",stroke:".$datas_jt[0]['color_awlr']."
            style E".$data_site[3]['site_id']." fill:".$datas_kl[0]['color_awlr'].",stroke:".$datas_kl[0]['color_awlr']."

            click A".$data_site[0]['site_id']." link
            click B".$data_site[4]['site_id']." link
            click C".$data_site[1]['site_id']." link
            click D".$data_site[2]['site_id']." link
            click E".$data_site[3]['site_id']." link
            |||".$status."|||".$message;

        }
        else {
            // code...
            $status = "NO DATA";
            $message = "NO DATA";

            echo "graph TD \n
            A(<b>SITE MATA AIR</b><br> NO DATA mm/10<br>NO DATA cm);
            B(<b>SITE BEDAGAN LIMO</b><br>NO DATA mm/10<br>NO DATA cm);

            A-->C(<b>SITE AKAR SERIBU</b><br>NO DATA mm/10<br>NO DATA cm);
            C-->D(<b>SITE JEMBATAN TROLIMAN</b><br>NO DATA mm/10<br>NO DATA cm);
            D-->E(<b>SITE KALIKATIR</b><br>NO DATA mm/10<br>NO DATA cm);
            B-->D;

            style A fill:#eceff1,stroke:#d50000
            style B fill:#eceff1,stroke:#d50000
            style C fill:#eceff1,stroke:#d50000
            style D fill:#eceff1,stroke:#d50000
            style E fill:#eceff1,stroke:#d50000
            |||".$status."|||".$message;
        }
    }

?>
