<?php
require_once("config/md.php");
$detect = new Mobile_Detect();
if($detect->isMobile()){
	//mobile
	header("location:mobile/");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/RangeSlider-all.min.css">
    <style>
        .set-border{
            border: 1px solid #cfd8dc;
        }
        .set-bg{
            background: #eceff1;
        }
        #map {
            height: 100%;
            width: 100%;
        }
        body{
            background: #ebeff1;
        }

        .map-responsive{
            overflow:hidden;
            padding-bottom:56.25%;
            position:relative;
            height:0;
        }
    </style>
    <title>Dashboard</title>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">&nbsp;</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="#"><img src="images/bappenas.png" class="img-fluid align-middle" style="max-width:120px"></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><img src="images/tree.png" class="img-fluid align-middle" style="max-width:120px;max-height: 50px;"></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><img src="images/usaid.png" class="img-fluid align-middle" style="max-width:120px;"></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><img src="images/wm.png" class="img-fluid align-middle" style="max-width:120px;max-height: 50px;"></a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="#">
                  <h2 class="align-middle" style="color:#1a237e;font-style: italic;">Sistem Peringatan Dini Banjir Sungai Klorak</h2>
              </a>
          </li>


        </ul>
      </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center" style="font-size:12px;font-weight:bold;">
                Last Updated : <span id="last_updated"></span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12 set-border set-bg" style="padding-top:5px;">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 text-center" style="font-size:12px;font-weight:bold;">
                                        ARG <span id="site_name_52"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12" style="font-size:13px;">
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        Curah Hujan
                                    </div>
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        <span id="curah_hujan_52"></span>
                                    </div>
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        Temp <span id="temp_52"></span>
                                    </div>
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        Hum <span id="hum_52"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xs-12">
                                <canvas id="argChart_52" width="400" height="300"></canvas>
                                <!-- <label class="align-middle" style="font-size:12px">Jarak Hari</label>
                                <label class="align-middle" style="font-size:12px">1&nbsp;</label><input id="argChart_52_slider" type="range" min="1" max="10" class="range-slider"><label class="align-middle" style="font-size:12px">&nbsp;10</label>
                                <label id="argChart_52_slider_value" class="align-middle right-text" style="font-size:12px"> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-xs-12 set-border set-bg" style="padding-top:5px;">
                        <div class="row">
                            <div class="col-lg-6 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-12 text-center" style="font-size:12px;font-weight:bold;">
                                        ARG <span id="site_name_57"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12" style="font-size:13px;">
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        Curah Hujan
                                    </div>
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        <span id="curah_hujan_57"></span>
                                    </div>
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        Temp <span id="temp_57"></span>
                                    </div>
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        Hum <span id="hum_57"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xs-12">
                                <canvas id="argChart_57" width="400" height="300"></canvas>
                                <!-- <label class="align-middle" style="font-size:12px">Jarak Hari</label>
                                <label class="align-middle" style="font-size:12px">1&nbsp;</label><input id="argChart_57_slider" type="range" min="1" max="10" class="range-slider"><label class="align-middle" style="font-size:12px">&nbsp;10</label>
                                <label id="argChart_57_slider_value" class="align-middle right-text" style="font-size:12px"> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-xs-12 set-border set-bg" style="padding-top:5px;">
                        <div class="row">
                            <div class="col-lg-6 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 text-center" style="font-size:12px;font-weight:bold;">
                                        ARG <span id="site_name_58"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12" style="font-size:13px;">
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        Curah Hujan
                                    </div>
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        <span id="curah_hujan_58"></span>
                                    </div>
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        Temp <span id="temp_58"></span>
                                    </div>
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        Hum <span id="hum_58"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xs-12">
                                <canvas id="argChart_58" width="400" height="300"></canvas>
                                <!-- <label class="align-middle" style="font-size:12px">Jarak Hari</label>
                                <label class="align-middle" style="font-size:12px">1&nbsp;</label><input id="argChart_58_slider" type="range" min="1" max="10" class="range-slider"><label class="align-middle" style="font-size:12px">&nbsp;10</label>
                                <label id="argChart_58_slider_value" class="align-middle right-text" style="font-size:12px"> -->
                            </div>
                        </div>
                    </div>
                </div>

                 <div class="row">
                    <div class="col-lg-12 col-xs-12 set-border set-bg" style="padding-top:5px;">
                        <div class="row">
                            <div class="col-lg-6 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 text-center" style="font-size:12px;font-weight:bold;">
                                        ARG <span id="site_name_55"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12" style="font-size:13px;">
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        Curah Hujan
                                    </div>
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        <span id="curah_hujan_55"></span>
                                    </div>
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        Temp <span id="temp_55"></span>
                                    </div>
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        Hum <span id="hum_55"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xs-12">
                                <canvas id="argChart_55" width="400" height="300"></canvas>
                                <!-- <label class="align-middle" style="font-size:12px">Jarak Hari</label>
                                <label class="align-middle" style="font-size:12px">1&nbsp;</label><input id="argChart_55_slider" type="range" min="1" max="10" class="range-slider"><label class="align-middle" style="font-size:12px">&nbsp;10</label>
                                <label id="argChart_55_slider_value" class="align-middle right-text" style="font-size:12px"> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-xs-12 set-border set-bg" style="padding-top:5px;">
                        <div class="row">
                            <div class="col-lg-6 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 text-center" style="font-size:12px;font-weight:bold;">
                                        ARG <span id="site_name_53"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12" style="font-size:13px;">
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        Curah Hujan
                                    </div>
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        <span id="curah_hujan_53"></span>
                                    </div>
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        Temp <span id="temp_53"></span>
                                    </div>
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        Hum <span id="hum_53"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-xs-12">
                                <canvas id="argChart_53" width="400" height="300"></canvas>
                                <!-- <label class="align-middle" style="font-size:12px">Jarak Hari</label>
                                <label class="align-middle" style="font-size:12px">1&nbsp;</label><input id="argChart_53_slider" type="range" min="1" max="10" class="range-slider"><label class="align-middle" style="font-size:12px">&nbsp;10</label>
                                <label id="argChart_53_slider_value" class="align-middle right-text" style="font-size:12px"> -->
                            </div>
                        </div>
                    </div>
                </div>



            </div>
            <div class="col-lg-6 col-xs-12 set-border" style="padding:0px">
            <!---- MAP --->
            <div id="map"></div>
            </div>
            <div class="col-lg-3 col-xs-12">
            <!----- KOLOM KANAN ---->
            	<div class="row">
                    <div class="col-lg-12 col-xs-12 set-border set-bg" style="padding-top:5px;">
                        <div class="row">
                            <div class="col-lg-6 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 text-center" style="font-size:12px;font-weight:bold;">
                                        AWLR <span id="awlr_site_name_52"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12" style="font-size:13px;">
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        Tinggi Mata Air
                                    </div>
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        <h5><span class="badge" id="awlr_52"></span></h5>
                                    </div>
                                    <div class="col-lg-12 col-xs-12 text-center" style="padding-bottom:10px;">
                                        &nbsp;
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xs-12">
                                <canvas id="awlrChart_52" width="400" height="300"></canvas>
                                <!-- <label class="align-middle" style="font-size:12px">Jarak Hari</label>
                                <label class="align-middle" style="font-size:12px">1&nbsp;</label><input id="awlrChart_52_slider" type="range" min="1" max="10" class="range-slider"><label class="align-middle" style="font-size:12px">&nbsp;10</label>
                                <label id="awlrChart_52_slider_value" class="align-middle right-text" style="font-size:12px"> -->
                            </div>
                        </div>
                    </div>
                </div>

             	<div class="row">
                    <div class="col-lg-12 col-xs-12 set-border set-bg" style="padding-top:5px;">
                        <div class="row">
                            <div class="col-lg-6 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 text-center" style="font-size:12px;font-weight:bold;">
                                        AWLR <span id="awlr_site_name_57"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12" style="font-size:13px;">
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        Tinggi Mata Air
                                    </div>
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        <h5><span class="badge" id="awlr_57"></span></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xs-12">
                                <canvas id="awlrChart_57" width="400" height="300"></canvas>
                                <!-- <label class="align-middle" style="font-size:12px">Jarak Hari</label>
                                <label class="align-middle" style="font-size:12px">1&nbsp;</label><input id="awlrChart_57_slider" type="range" min="1" max="10" class="range-slider"><label class="align-middle" style="font-size:12px">&nbsp;10</label>
                                <label id="awlrChart_57_slider_value" class="align-middle right-text" style="font-size:12px"> -->
                            </div>
                        </div>
                    </div>
                </div>

             	<div class="row">
                    <div class="col-lg-12 col-xs-12 set-border set-bg" style="padding-top:5px;">
                        <div class="row">
                            <div class="col-lg-6 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 text-center" style="font-size:12px;font-weight:bold;">
                                        AWLR <span id="awlr_site_name_58"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12" style="font-size:13px;">
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        Tinggi Mata Air
                                    </div>
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        <h5><span class="badge" id="awlr_58"></span></h5>
                                    </div>
                                    <div class="col-lg-12 col-xs-12 text-center" style="padding-bottom:8px;">
                                        &nbsp;
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xs-12">
                                <canvas id="awlrChart_58" width="400" height="300"></canvas>
                                <!-- <label class="align-middle" style="font-size:12px">Jarak Hari</label>
                                <label class="align-middle" style="font-size:12px">1&nbsp;</label><input id="awlrChart_58_slider" type="range" min="1" max="10" class="range-slider"><label class="align-middle" style="font-size:12px">&nbsp;10</label>
                                <label id="awlrChart_58_slider_value" class="align-middle right-text" style="font-size:12px"> -->
                            </div>
                        </div>
                    </div>
                </div>



               <div class="row">
                    <div class="col-lg-12 col-xs-12 set-border set-bg" style="padding-top:5px;">
                        <div class="row">
                            <div class="col-lg-6 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 text-center" style="font-size:12px;font-weight:bold;">
                                        AWLR <span id="awlr_site_name_55"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12" style="font-size:13px;">
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        Tinggi Mata Air
                                    </div>
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        <h5><span class="badge" id="awlr_55"></span></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xs-12">
                                <canvas id="awlrChart_55" width="400" height="300"></canvas>
                                <!-- <label class="align-middle" style="font-size:12px">Jarak Hari</label>
                                <label class="align-middle" style="font-size:12px">1&nbsp;</label><input id="awlrChart_55_slider" type="range" min="1" max="10" class="range-slider"><label class="align-middle" style="font-size:12px">&nbsp;10</label>
                                <label id="awlrChart_55_slider_value" class="align-middle right-text" style="font-size:12px"> -->
                            </div>
                        </div>
                    </div>
                </div>

               <div class="row">
                    <div class="col-lg-12 col-xs-12 set-border set-bg" style="padding-top:5px;">
                        <div class="row">
                            <div class="col-lg-6 col-xs-12" style="font-size:13px;">
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 text-center" style="font-size:12px;font-weight:bold;">
                                        AWLR <span id="awlr_site_name_53"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12 " style="font-size:13px;">
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        Tinggi Mata Air
                                    </div>
                                    <div class="col-lg-12 col-xs-12 text-center">
                                        <h5><span class="badge" id="awlr_53"></span></h5>
                                    </div>
                                    <div class="col-lg-12 col-xs-12" style="padding-bottom:17px;">
                                        &nbsp;
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xs-12">
                                <canvas id="awlrChart_53" width="400" height="300"></canvas>
                                <!-- <label class="align-middle" style="font-size:12px">Jarak Hari</label>
                                <label class="align-middle" style="font-size:12px">1&nbsp;</label><input id="awlrChart_53_slider" type="range" min="1" max="10" class="range-slider"><label class="align-middle" style="font-size:12px">&nbsp;10</label>
                                <label id="awlrChart_53_slider_value" class="align-middle right-text" style="font-size:12px"> -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="js/chartjs.min.js"></script>
<script src="js/push.min.js"></script>
<script src="js/serviceWorker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDl52LEeNPETLGigXLHZbLQNfI_8VgVVNk"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.11/moment-timezone-with-data-2010-2020.min.js"></script>
<script type="text/javascript">

function convertTo24Hour(time) {
// Check correct time format and split into components
    time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

      if (time.length > 1) { // If time format correct
        time = time.slice (1);  // Remove full string match value
        time[5] = +time[0] < 12 ? 'AM' : 'PM'; // Set AM/PM
        time[0] = +time[0] % 12 || 12; // Adjust hours
      }
      return convertDateTo24Hour(time.join ('')); // return adjusted time or original string
    }

function convertDateTo24Hour(date){
    var elem = date.split(' ');
    var stSplit = elem[1].split(":");// alert(stSplit);
    var stHour = stSplit[0];
    var stMin = stSplit[1];
    var stAmPm = elem[2];
    var newhr = 0;
    var ampm = '';
    var newtime = '';
    //alert("hour:"+stHour+"\nmin:"+stMin+"\nampm:"+stAmPm); //see current values

    if (stAmPm=='PM')
    {
        if (stHour!=12)
        {
            stHour=stHour*1+12;
        }
    }else if(stAmPm=='AM' && stHour=='12'){
       stHour = stHour -12;
    }else{
        stHour=stHour;
    }

    return elem[0]+" "+stHour+':'+stMin;
}

var map;
var color_awlr;
var marker;
var myLatLng;

function random_rgba() {
	var o = Math.round, r = Math.random, s = 255;
	return o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s);
}

function updateAjax(){

    //get data site arg
    $.get( "ajax/data_sites.php", function( data ) {
      $.each(JSON.parse(data), function(key, value) {
          $("#site_name_"+value.site_id).text(value.site_name);
          $("#curah_hujan_"+value.site_id).text(value.arg+" mm");
          $("#temp_"+value.site_id).text(value.temperature+" ˚C");
          $("#hum_"+value.site_id).text(value.humidity+" %");

          $("#awlr_site_name_"+value.site_id).text(value.site_name);
          $("#awlr_"+value.site_id).text(value.awlr+" cm");
          if(value.awlr>70){
              color_awlr="badge-danger";
          }else if((value.awlr>=50) && (value.awlr<70)){
              color_awlr="badge-warning";
          }else if(value.awlr<50){
            color_awlr="badge-success";
          }
          $("#awlr_"+value.site_id).removeClass("badge-warning badge-danger badge-success").addClass(color_awlr);
          console.log("load ajax");
      });

      jQuery.ajaxSetup({async:false});

      var data_site = [52,53,55,57,58];
      $.each(data_site, function(key, value) {

          str_site = value.toString();
          var site_color = random_rgba();

          var data_label_arg = [];
          var data_chart_arg = [];

          var data_label_awlr = [];
          var data_chart_awlr = [];

          //call arg chart
          $.getJSON( "ajax/data_charts.php",{type:"arg",site_id:str_site}, function( data ) {
              $.each(data,function(keyjson, valuejson) {
                  data_chart_arg.push(valuejson.arg);
                  data_label_arg.push(valuejson.client_date);
              });

              var ctx = $("#argChart_"+str_site);
              var myChart = new Chart( ctx, {
                  type: 'line',
                  data: {
                      labels: data_label_arg,
                      datasets: [{
                          radius: 0,
                          label: "Curah Hujan",
                          borderColor: "rgba("+site_color+",0.9)",
                          borderWidth: "1",
                          backgroundColor: "rgba("+site_color+",0.5)",
                          data: data_chart_arg
                      }]
                  },
                  options: {
                      legend:{
                          display:true,
                          position:'bottom',
                          labels:{
                              boxWidth: 10,
                              fontSize: 10
                          },
                      },
                      responsive: true,
                      tooltips: {
                          mode: 'index',
                          intersect: false
                      },
                      hover: {
                          mode: 'nearest',
                          intersect: true
                      },
                      scales: {
                          xAxes: [{
                              ticks: {
                                  display: true //this will remove only the label
                              }
                          }]
                      }
                  }
              });
          });
          //end arg chart

          //call arg chart
          $.getJSON( "ajax/data_charts.php",{type:"awlr",site_id:str_site}, function( data ) {
              $.each(data,function(keyjson, valuejson) {
                  data_chart_awlr.push(valuejson.awlr);
                  data_label_awlr.push(valuejson.client_date);
              });

              //console.log("Site : "+str_site+" , Data : "+data_chart_arg);
              var ctx = $("#awlrChart_"+str_site);
              var myChart = new Chart( ctx, {
                  type: 'line',
                  data: {
                      labels: data_label_awlr,
                      datasets: [{
                          radius: 0,
                          label: "Tinggi Mata Air",
                          borderColor: "rgba("+site_color+",0.9)",
                          borderWidth: "1",
                          backgroundColor: "rgba("+site_color+",0.5)",
                          data: data_chart_awlr
                      }]
                  },
                  options: {
                      legend:{
                          display:true,
                          position:'bottom',
                          labels:{
                              boxWidth: 10,
                              fontSize: 10
                          }
                      },
                      responsive: true,
                      tooltips: {
                          mode: 'index',
                          intersect: false
                      },
                      hover: {
                          mode: 'nearest',
                          intersect: true
                      },
                      scales: {
                          xAxes: [{
                              ticks: {
                                  display: true //this will remove only the label
                              }
                          }]
                      }
                  }
              });
          });
          //end arg chart

          //get last updated
          $.get( "ajax/data_sites.php",{type:"last_updated"}, function( data ) {
            $.each(JSON.parse(data), function(key, value) {

                let utcTime = value.client_date;
                var offset = moment().utcOffset();
                var localText = moment.utc(utcTime).utcOffset(offset).format("L LT");
                $("#last_updated").text(convertTo24Hour(localText)+" WIB");
            });
          });
      });
    });
}

    //JQUERY ON LOAD
    $(function(){
    	/*
        var height_screen = $(window).height();
        var width_screen = $(window).width();
        console.log(height_screen+", "+width_screen);

        if(width_screen<=768){
            window.location = "https://monitoringku.com/kalikatir/mobile";
        }
        */

        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -7.6552317, lng: 112.4736113},
            animation: google.maps.Animation.DROP,
            zoom: 14
        });

       map.setOptions({draggable: false, zoomControl: false, scrollwheel: false, disableDoubleClickZoom: true});

       //marker
       $.get( "ajax/data_sites.php",{type:"maps"}, function( data ) {
           $.each(JSON.parse(data), function(key, value) {

               // $("#argChart_"+value.site_id+"_slider").on("change",function(){
               //         var val = $(this).val();
               //         $("#argChart_"+value.site_id+"_slider_value").html("("+val+" hari)");
               //         updateAjaxRange(val);
               // });

               //create marker gmaps
               var contentString =
               '<div id="content">'+value.site_name+'</div>';

                 var infowindow = new google.maps.InfoWindow({
                   content: contentString
                 });


               myLatLng = {lat: value.lat, lng: value.lng};
               marker = new google.maps.Marker({
                 position: myLatLng,
                 map: map,
                 title: value.site_name
               });

               marker['infowindow'] = new google.maps.InfoWindow({
                   pixelOffset: new google.maps.Size(0,0),
                   content: contentString
               });

               var markerevent = google.maps.event.addListener(marker, 'click', function() {
                   this['infowindow'].open(map, this);
                 });

               google.maps.event.trigger(marker, 'click');

               //create KML
               var src_sungai = 'https://monitoringku.com/kalikatir/kml/sungai.kml';
              // var src_sensor = 'https://monitoringku.com/kalikatir/kml/sensor.kml';

               var kmlLayerSungai = new google.maps.KmlLayer(src_sungai, {
                  suppressInfoWindows: true,
                  preserveViewport: false,
                  map: map
                });
				/*
                var kmlLayerSensor = new google.maps.KmlLayer(src_sensor, {
                   suppressInfoWindows: true,
                   preserveViewport: false,
                   map: map
                 });
                 */


               /*
               google.maps.event.addListener(map, "click", function (e) {
 					var latLng = e.latLng;
 					console.log(latLng.lat()+","+latLng.lng());
 				});
 				*/
           });
       });

        //get data site arg
        $.get( "ajax/data_sites.php", function( data ) {
          $.each(JSON.parse(data), function(key, value) {
              $("#site_name_"+value.site_id).text(value.site_name);
              $("#curah_hujan_"+value.site_id).text(value.arg+" mm");
              $("#temp_"+value.site_id).text(value.temperature+" ˚C");
              $("#hum_"+value.site_id).text(value.humidity+" %");

              $("#awlr_site_name_"+value.site_id).text(value.site_name);
              $("#awlr_"+value.site_id).text(value.awlr+" cm");
              if(value.awlr>70){
                  color="badge-danger";
              }else if((value.awlr>=50) && (value.awlr<70)){
                  color="badge-warning";
              }else if(value.awlr<50){
              	color="badge-success";
              }
              $("#awlr_"+value.site_id).removeClass("badge-warning badge-danger badge-success").addClass(color);

          });
        });

        //get last updated
        $.get( "ajax/data_sites.php",{type:"last_updated"}, function( data ) {
          $.each(JSON.parse(data), function(key, value) {
              let utcTime = value.client_date;
              var offset = moment().utcOffset();
              var localText = moment.utc(utcTime).utcOffset(offset).format("L LT");
              $("#last_updated").text(convertTo24Hour(localText)+" WIB");
          });
        });

        jQuery.ajaxSetup({async:false});

		var data_site = [52,53,55,57,58];
		$.each(data_site, function(key, value) {

			str_site = value.toString();
			var site_color = random_rgba();

			var data_label_arg = [];
			var data_chart_arg = [];


            var data_label_awlr = [];
			var data_chart_awlr = [];


            //call arg chart
			$.getJSON( "ajax/data_charts.php",{type:"arg",site_id:str_site}, function( data ) {
				$.each(data,function(keyjson, valuejson) {
					data_chart_arg.push(valuejson.arg);
					data_label_arg.push(valuejson.client_date);
				});

				var ctx = $("#argChart_"+str_site);
				var myChart = new Chart( ctx, {
					type: 'line',
					data: {
						labels: data_label_arg,
						datasets: [{
							radius: 0,
							label: "Curah Hujan (mm)",
							borderColor: "rgba("+site_color+",0.9)",
							borderWidth: "1",
							backgroundColor: "rgba("+site_color+",0.5)",
							data: data_chart_arg
						}]
					},
					options: {
						legend:{
							display:true,
							position:'bottom',
							labels:{
								boxWidth: 10,
								fontSize: 10
							},
						},
						responsive: true,
						tooltips: {
							mode: 'index',
							intersect: false
						},
						hover: {
							mode: 'nearest',
							intersect: true
						},
						scales: {
							xAxes: [{
								ticks: {
									display: true //this will remove only the label,
								}
							}]
						}
					}
				});
			});
            //end arg chart

            //call arg chart
			$.getJSON( "ajax/data_charts.php",{type:"awlr",site_id:str_site}, function( data ) {
				$.each(data,function(keyjson, valuejson) {
					data_chart_awlr.push(valuejson.awlr);
					data_label_awlr.push(valuejson.client_date);
				});

				//console.log("Site : "+str_site+" , Data : "+data_chart_arg);
				var ctx = $("#awlrChart_"+str_site);
				var myChart = new Chart( ctx, {
					type: 'line',
					data: {
						labels: data_label_awlr,
						datasets: [{
							radius: 0,
							label: "Tinggi Mata Air (cm)",
							borderColor: "rgba("+site_color+",0.9)",
							borderWidth: "1",
							backgroundColor: "rgba("+site_color+",0.5)",
							data: data_chart_awlr
						}]
					},
					options: {
						legend:{
							display:true,
							position:'bottom',
							labels:{
								boxWidth: 10,
								fontSize: 10
							}
						},
						responsive: true,
						tooltips: {
							mode: 'index',
							intersect: false
						},
						hover: {
							mode: 'nearest',
							intersect: true
						},
						scales: {
							xAxes: [{
								ticks: {
									display: true //this will remove only the label
								}
							}]
						}
					}
				});
			});
            //end arg chart
		});

        //load every 5 minutes
        setInterval(updateAjax, 300*1000);
    });
</script>
</body>
</html>
