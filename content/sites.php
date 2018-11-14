<style media="screen">
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
.center {
    margin: auto;
    width: 80%;
    padding: 10px;
}

hr {
  margin-top: 1rem;
  margin-bottom: 1rem;
  border: 0;
  border-top: 1px solid rgba(0, 0, 0, 0.1);
}
</style>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/kalikatir">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data Site</li>
  </ol>
</nav>
<div class="row">
    <div class="col-lg-4" id="bg-status-site-name">
        <br>
        <div id="site_name" class="text-center center"></div>
        <div id="site_name_last_updated" class="text-center center"></div>
    </div>
    <div class="col-lg-4">
        <div class="row">
            <div class="col-lg-12">
                <canvas id="chart_awlr" width="400" height="400"></canvas>
            </div>

            <div class="col-lg-12">
                <canvas id="chart_arg" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4" id="bg-status">
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

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="js/chartjs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.11/moment-timezone-with-data-2010-2020.min.js"></script>

<script type="text/javascript">
var map;
var color_awlr;
var marker;
var myLatLng;
var width_screen;
var height_screen;

var data_label_awlr = [];
var data_chart_awlr = [];

var data_label_arg = [];
var data_chart_arg = [];

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

function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
};

function random_rgba() {
	var o = Math.round, r = Math.random, s = 255;
	return o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s);
}

var site_color = random_rgba();
var site_color_arg = random_rgba();

$(function(){
    height_screen = $(window).height();
    width_screen = $(window).width();

    initData();

    setInterval(initData,3*1000);
});

function initData(){
    //get data site
    $.get( "ajax/data_sites.php",{type:"arg_mobile",site_id:<?=$_GET['site_id']?>}, function( data ) {

        var datas = JSON.parse(data);
        $("#site_name").html("<h1>"+datas[0].site_name+"</h1>");
        // console.log(datas);

        //normal
        if((datas[0].awlr>=datas[4].min_value) && (datas[0].awlr<=datas[4].max_value) )
        {
            color_awlr="#4db6ac";
            $("#bg-status-site-name").css('background',color_awlr);
            $("#bg-status-site-name").css('height',height_screen);

            $("#bg-status").css('background',color_awlr);
            $("#bg-status").css('height',height_screen);
            var message = "<b>NORMAL</b><br>Masyarakat dapat melakukan aktifitas seperti biasa";
            $("#message").html(message);
            console.log(color_awlr);
        }
        //waspada
        else if((datas[0].awlr>datas[3].min_value) && (datas[0].awlr<=datas[3].max_value))
        {
            color_awlr="#00b0ff";
            $("#bg-status-site-name").css('background',color_awlr);
            $("#bg-status-site-name").css('height',height_screen);

            $("#bg-status").css('background',color_awlr);
            $("#bg-status").css('height',height_screen);

            var message = "<b>WASPADA</b><br>Terdapat hujan di Hulu kurangi kegiatan di sekitar sungai";
            $("#message").html(message);
        //siaga
        }
        else if((datas[0].awlr>=datas[2].min_value) && (datas[0].awlr<=datas[2].min_value))
        {
            color_awlr="#ffff00";
            $("#bg-status-site-name").css('background',color_awlr);
            $("#bg-status-site-name").css('height',height_screen);

            $("#bg-status").css('background',color_awlr);
            $("#bg-status").css('height',height_screen);

            var message = "<b>SIAGA</b><br>Evakuasi masyarakat dan barang-barang ke tempat yang aman";
            $("#message").html(message);
        }
        //awas
        else if(datas[0].awlr>datas[1].min_value && datas[0].awlr>datas[1].max_value){
            color_awlr="#d50000";
            $("#bg-status-site-name").css('background',color_awlr);
            $("#bg-status-site-name").css('height',height_screen);

            $("#bg-status").css('background',color_awlr);
            $("#bg-status").css('height',height_screen);

            var message = "<b>AWAS</b><br>Segera evakuasi masyarakat yang ada disekitar sungai!!! Ikuti rambu evakuasi";
            $("#message").html(message);
        }

      });

    //get last updated
    $.get( "ajax/data_sites.php",{type:"last_updated"}, function( data ) {
      $.each(JSON.parse(data), function(key, value) {

          let utcTime = value.client_date;
          var offset = moment().utcOffset();
          var localText = moment.utc(utcTime).utcOffset(offset).format("L LT");

          $("#last_updated").html("Last Updated : <br> [ "+convertTo24Hour(localText)+" WIB ]");
          $("#site_name_last_updated").html(convertTo24Hour(localText)+" WIB");
      });
    });

    //get chart awlr
    var types_data = getUrlParameter("type");
    var types_awlr = types_data.split("_");
    var type_awlr = types_awlr[0];
    var type_arg = types_awlr[1];

    //awlr type

    if(type_awlr=="awlr"){
        data_chart_awlr = [];
        data_label_awlr = [];
        $.getJSON( "ajax/data_charts.php",{type:"awlr",site_id:<?=$_GET['site_id']?>}, function( data ) {
            $.each(data,function(keyjson, valuejson) {
                data_chart_awlr.push(valuejson.awlr);
                data_label_awlr.push(valuejson.client_date);
            });

            //console.log("Site : "+str_site+" , Data : "+data_chart_arg);
            var ctx = $("#chart_awlr");
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
        });//end awlr chart
    }

    //arg chart
    if(type_arg=="arg"){
        data_chart_arg = [];
        data_label_arg = [];
        $.getJSON( "ajax/data_charts.php",{type:"arg",site_id:<?=$_GET['site_id']?>}, function( data ) {
            $.each(data,function(keyjson, valuejson) {
                data_chart_arg.push(valuejson.arg);
                data_label_arg.push(valuejson.client_date);
            });

            var ctx = $("#chart_arg");
            var myChart = new Chart( ctx, {
                type: 'line',
                data: {
                    labels: data_label_awlr,
                    datasets: [{
                        radius: 0,
                        label: "Curah Hujan (mm)",
                        borderColor: "rgba("+site_color_arg+",0.9)",
                        borderWidth: "1",
                        backgroundColor: "rgba("+site_color_arg+",0.5)",
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
        });//end arg chart
    }
}
</script>
