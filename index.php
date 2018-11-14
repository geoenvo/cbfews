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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
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
		foreignObject{
			color:#ffffff;
		}
		.status{
			color:#263238;
		}
		.danger{
			background:#d50000;
			color:#ffffff;
		}
		.standby{
			background:#ffff00;
		}
		.alert{
			background:#00b0ff;
		}
		.normal{
			background:#4db6ac;
		}

		#dvLoading
		{
		   background:#eceff1 url(images/Preload.gif) no-repeat center center;
		   width: 100%;
           height: 100%;
		   position: fixed;
		   z-index: 1000;
		   left: 0px;
           top: 0px;
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
        <li class="nav-item dropdown" style="margin-top:8px;">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Pengaturan
            </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="main.php?page=threshold_index"><i class="fas fa-cogs"></i> Threshold</a>
                </div>
        </li>
        </ul>
      </div>
    </nav>
    <div class="container-fluid">
		<!-- <div id="dvLoading"></div> -->

        <div class="row">
			<div class="col-lg-8">
				<center>
					<div class="mermaid">
								<!-- content graph -->
				  	</div>
			  </center>
			</div>
			<div class="col-lg-4" id="bg-status" style="background:#4db6ac;">
				<div class="row">
					<div class="col-lg-12">
						<table class="table status" style="border:1px solid #ffffff;margin-top:10px;">
							<tr class="danger" style="border:1px solid #ffffff;">
								<td>AWAS</td>
							</tr>
							<tr class="standby" style="border:1px solid #ffffff;">
								<td>SIAGA</td>
							</tr>
							<tr class="alert" style="border:1px solid #ffffff;">
								<td>WASPADA</td>
							</tr>
							<tr class="normal" style="border:1px solid #ffffff;">
								<td>NORMAL</td>
							</tr>
						</table>
					</div>

					<div class="col-lg-12 text-center">
						<h1>
							<span id="last_updated" style="font-size:30px;"></span>
						</h1>
						<h1>
							STATUS : <strong><span id="status"></span></strong>
						</h1>
						<h2>
							<p id="message"></p>
						</h2>

					</div>
				</div>
			</div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mermaid/7.1.2/mermaid.min.js"></script>
<script src="js/chartjs.min.js"></script>
<script src="js/push.min.js"></script>
<script src="js/serviceWorker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

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
	var dates = elem[0].split("/");
	var date = dates[1];
	var month = dates[0];
	var year = dates[2];

    return date+"/"+month+"/"+year+" "+stHour+':'+stMin;
}

var map;
var color_awlr;
var marker;
var myLatLng;

function random_rgba() {
	var o = Math.round, r = Math.random, s = 255;
	return o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s);
}

function initData(){

	var height_screen = $(window).height();
	$("#bg-status").css("height",height_screen);
	// $('#dvLoading').fadeIn();
	//create graph
	$(".mermaid").html('');
	$.get( "ajax/data_sites.php", function( data ) {
		var message = data.split("|||")[2];
		var status = data.split("|||")[1];
		var mermaiddata = data.split("|||")[0];
	  	$(".mermaid").html(mermaiddata).removeAttr('data-processed');
	  	mermaid.init(undefined, $(".mermaid"));
		if(message=="NO DATA"){
			$("foreignObject").css("color","#d50000");
			$("#bg-status").css("background","#eceff1");
		}else{
			$("#bg-status").css("background",status);
		}

		$("#status").html(message);
	});

	// jQuery.ajaxSetup({async:true});

	//get last updated
	$.get( "ajax/data_sites.php",{type:"last_updated"}, function( data ) {
	  $.each(JSON.parse(data), function(key, value) {

		  let utcTime = value.client_date;
		  var offset = moment().utcOffset();
		  var localText = moment.utc(utcTime).utcOffset(offset).format("L LT");

		  $("#last_updated").html("Last Updated : <br> [ "+convertTo24Hour(localText)+" WIB ]");
	  });
	});
	console.log("called function");
	// $('#dvLoading').fadeOut(1000);
}


//Jquery on load
$(function(){
	mermaid.initialize({startOnLoad:false});
	initData();

	setInterval(initData,2*1000);


});//end jquery onload

function link(id){
	var node_id= id;
	var site_id = node_id.substring(1, node_id.length);

	window.location.href= "main.php?page=sites&site_id="+site_id+"&type=awlr_arg";
}
</script>
</body>
</html>
