<?php

$type= $_GET['type'];
?>
<title>Sensor</title>
<div class="row" style="overflow-y:auto">
    <div class="col-lg-12 text-center align-middle" style="background:#1a237e;color:#ffffff;">
        <h4 style="padding-top:15px">SENSOR <label id="site_name"></label> </h4>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <canvas id="chart" width="400" height="400"></canvas>
    </div>
</div>
<div class="row">
    <div class="col" style="background:<?=($_GET['type']=='awlr_mobile'? '#b71c1c':'#1a237e')?>;padding:10px;">
        <center>
            <a href="main.php?page=sites&type=awlr_mobile&site_id=<?=$_GET['site_id']?>">
                <img src="../images/sea.png" alt="" class="-img-thumbnail text-center" style="max-width:50px;">
            </a>
        </center>
    </div>
    <div class="col" style="background:<?=($_GET['type']=='arg_mobile'? '#b71c1c':'#1a237e')?>;padding:10px;">
        <center>
            <a href="main.php?page=sites&type=arg_mobile&site_id=<?=$_GET['site_id']?>">
                <img src="../images/rain.png" alt="" class="-img-thumbnail text-center" style="max-width:50px;">
            </a>
        </center>
    </div>
    <div class="col" style="background:<?=($_GET['type']=='temp_hum_mobile'? '#b71c1c':'#1a237e')?>;padding:10px;">
        <center>
            <a href="main.php?page=sites&type=temp_hum_mobile&site_id=<?=$_GET['site_id']?>">
                <img src="../images/temp_hum.png" alt="" class="-img-thumbnail text-center" style="max-width:50px;">
            </a>
        </center>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="../js/chartjs.min.js"></script>
<script type="text/javascript">
var data_label_arg = [];
var data_chart_arg = [];

var data_label_awlr = [];
var data_chart_awlr = [];

var data_label_temp = [];
var data_chart_temp = [];

var data_label_hum = [];
var data_chart_hum = [];

function random_rgba() {
	var o = Math.round, r = Math.random, s = 255;
	return o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s);
}

function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
};

var site_color = random_rgba();
var site_color2 = random_rgba();

    $(function(){
        $.get( "../ajax/data_sites.php",{type:"arg_mobile",site_id:<?=$_GET['site_id']?>}, function( data ) {
            $.each(JSON.parse(data), function(key, value) {
                $("#site_name").text(value.site_name);
            });
        });

        if(getUrlParameter("type")=="arg_mobile"){
            //call arg chart
            $.getJSON( "../ajax/data_charts.php",{type:"arg_mobile",site_id:<?=$_GET['site_id']?>}, function( data ) {
                $.each(data,function(keyjson, valuejson) {
                    data_chart_arg.push(valuejson.arg);
                    data_label_arg.push(valuejson.client_date);
                });

                var ctx = $("#chart");
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
                                    display: true //this will remove only the label
                                }
                            }]
                        }
                    }
                });
            });
            //end arg chart
        }else if(getUrlParameter("type")=="awlr_mobile"){
            //call arg chart
            $.getJSON( "../ajax/data_charts.php",{type:"awlr_mobile",site_id:<?=$_GET['site_id']?>}, function( data ) {
                $.each(data,function(keyjson, valuejson) {
                    data_chart_awlr.push(valuejson.awlr);
                    data_label_awlr.push(valuejson.client_date);
                });

                //console.log("Site : "+str_site+" , Data : "+data_chart_arg);
                var ctx = $("#chart");
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
        }else if (getUrlParameter("type")=="temp_hum_mobile") {
            //call arg chart
            $.getJSON( "../ajax/data_charts.php",{type:"temp_hum_mobile",site_id:<?=$_GET['site_id']?>}, function( data ) {
                $.each(data,function(keyjson, valuejson) {
                    data_chart_temp.push(valuejson.temperature);
                    data_label_temp.push(valuejson.client_date);

                    data_chart_hum.push(valuejson.humidity);
                    data_label_hum.push(valuejson.client_date);
                });

                //console.log("Site : "+str_site+" , Data : "+data_chart_arg);
                var ctx = $("#chart");
                var myChart = new Chart( ctx, {
                    type: 'line',
                    data: {
                        labels: data_label_temp,
                        datasets: [{
                            radius: 0,
                            label: "Temperature (˚C)",
                            borderColor: "rgba("+site_color2+",0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba("+site_color2+",0.5)",
                            data: data_chart_temp
                        },{
                            radius: 0,
                            label: "Humidity (%)",
                            borderColor: "rgba("+site_color2+",0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba("+site_color2+",0.5)",
                            data: data_chart_hum
                        }
                    ]
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
        }

        //load every 5 minutes
        setInterval(updateAjax, 300*1000);
    });

    function updateAjax(){
        console.log("load mobile");
        $.get( "../ajax/data_sites.php",{type:"arg_mobile",site_id:<?=$_GET['site_id']?>}, function( data ) {
            $.each(JSON.parse(data), function(key, value) {
                $("#site_name").text(value.site_name);
            });
        });

        if(getUrlParameter("type")=="arg_mobile"){
            //call arg chart
            $.getJSON( "../ajax/data_charts.php",{type:"arg_mobile",site_id:<?=$_GET['site_id']?>}, function( data ) {
                $.each(data,function(keyjson, valuejson) {
                    data_chart_arg.push(valuejson.arg);
                    data_label_arg.push(valuejson.client_date);
                });

                var ctx = $("#chart");
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
                                    display: true //this will remove only the label
                                }
                            }]
                        }
                    }
                });
            });
            //end arg chart
        }else if(getUrlParameter("type")=="awlr_mobile"){
            //call arg chart
            $.getJSON( "../ajax/data_charts.php",{type:"awlr_mobile",site_id:<?=$_GET['site_id']?>}, function( data ) {
                $.each(data,function(keyjson, valuejson) {
                    data_chart_awlr.push(valuejson.awlr);
                    data_label_awlr.push(valuejson.client_date);
                });

                //console.log("Site : "+str_site+" , Data : "+data_chart_arg);
                var ctx = $("#chart");
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
        }else if (getUrlParameter("type")=="temp_hum_mobile") {
            //call arg chart
            $.getJSON( "../ajax/data_charts.php",{type:"temp_hum_mobile",site_id:<?=$_GET['site_id']?>}, function( data ) {
                $.each(data,function(keyjson, valuejson) {
                    data_chart_temp.push(valuejson.temperature);
                    data_label_temp.push(valuejson.client_date);

                    data_chart_hum.push(valuejson.humidity);
                    data_label_hum.push(valuejson.client_date);
                });

                //console.log("Site : "+str_site+" , Data : "+data_chart_arg);
                var ctx = $("#chart");
                var myChart = new Chart( ctx, {
                    type: 'line',
                    data: {
                        labels: data_label_temp,
                        datasets: [{
                            radius: 0,
                            label: "Temperature (˚C)",
                            borderColor: "rgba("+site_color2+",0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba("+site_color2+",0.5)",
                            data: data_chart_temp
                        },{
                            radius: 0,
                            label: "Humidity (%)",
                            borderColor: "rgba("+site_color2+",0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba("+site_color2+",0.5)",
                            data: data_chart_hum
                        }
                    ]
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
        }
    }
</script>
