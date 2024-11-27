@extends('layouts.admin')

@section('content')
<style>
.dropdown-item{
    cursor: pointer;
}
</style>
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Dashboard</h3>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Booking Statistics</div>
                            <div class="card-tools">
                                <div class="dropdown">
                                    <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item booking-stat" data-value="today">Today</a>
                                        <a class="dropdown-item booking-stat" data-value="yesterday">Yesterday</a>
                                        <a class="dropdown-item booking-stat" data-value="thismonth">This month</a>
                                        <a class="dropdown-item booking-stat" data-value="thisyear">This year</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills nav-secondary nav-pills-no-bd" id="pills-tab-without-border" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="booking-tab" data-bs-toggle="pill" href="#booking-section" role="tab" aria-controls="pills-home-nobd" aria-selected="true">Booked</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="received-booking-tab" data-bs-toggle="pill" href="#received-booking-section" role="tab" aria-controls="pills-profile-nobd" aria-selected="false">Received Booking</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                            <div class="tab-pane fade show active" id="booking-section" role="tabpanel" aria-labelledby="booking-tab">
                                <div class="chart-container" style="min-height: 375px">
                                    <canvas id="statisticsChart"></canvas>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="received-booking-section" role="tabpanel" aria-labelledby="received-booking-tab">
                                <div class="chart-container" style="min-height: 375px">
                                    <canvas id="statisticsChart2"></canvas>
                                </div>
                            </div>
                        </div>
                        
                    <!-- <div id="myChartLegend"></div> -->
                </div>
            </div>

            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Transaction History</div>
                            <div class="card-tools">
                                <div class="dropdown">
                                    <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Today</a>
                                        <a class="dropdown-item" href="#">Yesterday</a>
                                        <a class="dropdown-item" href="#">This month</a>
                                        <a class="dropdown-item" href="#">This year</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center mb-0">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">Car Name</th>
                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">Rate</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latest_bookings as $key => $value)
                            <tr>
                            <th scope="row">{{$value->car_name}}</th>
                            <td>{{$value->source}}</td>
                            <td>{{$value->destination}}</td>
                            <td>AED {{$value->rate}}</td>
                            <td>
                                <span class="badge badge-success">Booked</span>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            
            <div class="card card-stats card-round">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Sales</div>
                        <div class="card-tools">
                            <div class="dropdown">
                                <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item sales-count" data-value="today">Today</a>
                                    <a class="dropdown-item sales-count" data-value="yesterday">Yesterday</a>
                                    <a class="dropdown-item sales-count" data-value="thismonth">This month</a>
                                    <a class="dropdown-item sales-count" data-value="thisyear">This year</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small" >
                                <i class="fas fa-luggage-cart"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Sales</p>
                                <h4 class="card-title" id="booking-total">AED {{$sales[0]->booking_total}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card card-stats card-round">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Customers</div>
                        <div class="card-tools">
                            <div class="dropdown">
                                <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item customer-count" data-value="today">Today</a>
                                    <a class="dropdown-item customer-count" data-value="yesterday">Yesterday</a>
                                    <a class="dropdown-item customer-count" data-value="thismonth">This month</a>
                                    <a class="dropdown-item customer-count" data-value="thisyear">This year</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small" >
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Customers</p>
                                <h4 class="card-title" id="customer-total">{{$customers[0]->cnt}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Car Wise Bookings</div>
                        <div class="card-tools">
                            <div class="dropdown">
                                <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item carwise-booking" data-value="today">Today</a>
                                    <a class="dropdown-item carwise-booking" data-value="yesterday">Yesterday</a>
                                    <a class="dropdown-item carwise-booking" data-value="thismonth">This month</a>
                                    <a class="dropdown-item carwise-booking" data-value="thisyear">This year</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas
                        id="pieChart"
                        style="width: 50%; height: 50%"
                        ></canvas>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
    
</div>
<script src="{{asset('admin_assets/js/core/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('admin_assets/js/plugin/chart.js/chart.min.js')}}"></script>
<script>

var ctx = document.getElementById('statisticsChart').getContext('2d');
var ctx2 = document.getElementById('statisticsChart2').getContext('2d');
var pieChart = document.getElementById("pieChart").getContext("2d");
var statisticsChart = null;
var statisticsChart2 = null;
var myPieChart = null;
var booking_stat = @php {{ echo json_encode($booking_stat);}} @endphp;
var booking_stat2 = @php {{ echo json_encode($booking_stat2);}} @endphp;
var carwise_bookings = @php {{ echo json_encode($carwise_bookings);}} @endphp;


myPieChart = new Chart(pieChart, {
    type: "pie",
    data: {
        datasets: [
            {
                data: carwise_bookings.data,
                backgroundColor: carwise_bookings.color,
                borderWidth: 0,
            },
        ],
        labels: carwise_bookings.label,
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            position: "bottom",
            labels: {
                fontColor: "rgb(154, 154, 154)",
                fontSize: 11,
                usePointStyle: true,
                padding: 20,
            },
        },
        pieceLabel: {
            render: "percentage",
            fontColor: "white",
            fontSize: 14,
        },
        tooltips: true,
        layout: {
            padding: {
                left: 20,
                right: 20,
                top: 20,
                bottom: 20,
            },
        },
    },
});

statisticsChart = new Chart(ctx, {
	type: 'line',
	data: {
		labels: booking_stat.label,
		datasets: [ {
			label: "Booking Count",
			borderColor: '#177dff',
			pointBackgroundColor: 'rgba(23, 125, 255, 0.6)',
			pointRadius: 0,
			backgroundColor: 'rgba(23, 125, 255, 0.4)',
			legendColor: '#177dff',
			fill: true,
			borderWidth: 2,
			data: booking_stat.data
		}]
	},
	options : {
		responsive: true, 
		maintainAspectRatio: false,
		legend: {
			display: false
		},
		tooltips: {
			bodySpacing: 4,
			mode:"nearest",
			intersect: 0,
			position:"nearest",
			xPadding:10,
			yPadding:10,
			caretPadding:10
		},
		layout:{
			padding:{left:5,right:5,top:15,bottom:15}
		},
		scales: {
			yAxes: [{
				ticks: {
					fontStyle: "500",
					beginAtZero: false,
					maxTicksLimit: 5,
					padding: 10
				},
				gridLines: {
					drawTicks: false,
					display: false
				}
			}],
			xAxes: [{
				gridLines: {
					zeroLineColor: "transparent"
				},
				ticks: {
					padding: 10,
					fontStyle: "500"
				}
			}]
		}, 
		legendCallback: function(chart) { 
			var text = []; 
			text.push('<ul class="' + chart.id + '-legend html-legend">'); 
			for (var i = 0; i < chart.data.datasets.length; i++) { 
				text.push('<li><span style="background-color:' + chart.data.datasets[i].legendColor + '"></span>'); 
				if (chart.data.datasets[i].label) { 
					text.push(chart.data.datasets[i].label); 
				} 
				text.push('</li>'); 
			} 
			text.push('</ul>'); 
			return text.join(''); 
		}  
	}
});

statisticsChart2 = new Chart(ctx2, {
	type: 'line',
	data: {
		labels: booking_stat2.label,
		datasets: [ {
			label: "Booking Count",
			borderColor: '#177dff',
			pointBackgroundColor: 'rgba(23, 125, 255, 0.6)',
			pointRadius: 0,
			backgroundColor: 'rgba(23, 125, 255, 0.4)',
			legendColor: '#177dff',
			fill: true,
			borderWidth: 2,
			data: booking_stat2.data
		}]
	},
	options : {
		responsive: true, 
		maintainAspectRatio: false,
		legend: {
			display: false
		},
		tooltips: {
			bodySpacing: 4,
			mode:"nearest",
			intersect: 0,
			position:"nearest",
			xPadding:10,
			yPadding:10,
			caretPadding:10
		},
		layout:{
			padding:{left:5,right:5,top:15,bottom:15}
		},
		scales: {
			yAxes: [{
				ticks: {
					fontStyle: "500",
					beginAtZero: false,
					maxTicksLimit: 5,
					padding: 10
				},
				gridLines: {
					drawTicks: false,
					display: false
				}
			}],
			xAxes: [{
				gridLines: {
					zeroLineColor: "transparent"
				},
				ticks: {
					padding: 10,
					fontStyle: "500"
				}
			}]
		}, 
		legendCallback: function(chart) { 
			var text = []; 
			text.push('<ul class="' + chart.id + '-legend html-legend">'); 
			for (var i = 0; i < chart.data.datasets.length; i++) { 
				text.push('<li><span style="background-color:' + chart.data.datasets[i].legendColor + '"></span>'); 
				if (chart.data.datasets[i].label) { 
					text.push(chart.data.datasets[i].label); 
				} 
				text.push('</li>'); 
			} 
			text.push('</ul>'); 
			return text.join(''); 
		}  
	}
});


$(document).ready(function () { 
    $(document).on("click", ".booking-stat" , function(e) { 
        $(".overlay").show();
        var dayValue = $(this).attr('data-value');
        $.ajax({
            url: baseUrl + '/admin/get-dashboard-booking-data',
            type: 'post',
            data: {'period':$(this).attr('data-value'),'card':'booking-stat'},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function( html ) {
                if(html){
                    if (statisticsChart) {
                        statisticsChart.destroy();
                    }

                    if (statisticsChart2) {
                        statisticsChart2.destroy();
                    }
                    statisticsChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: html.data.label,
                            datasets: [ {
                                label: "Booking Count",
                                borderColor: '#177dff',
                                pointBackgroundColor: 'rgba(23, 125, 255, 0.6)',
                                pointRadius: 0,
                                backgroundColor: 'rgba(23, 125, 255, 0.4)',
                                legendColor: '#177dff',
                                fill: true,
                                borderWidth: 2,
                                data: html.data.data
                            }]
                        },
                        options : {
                            responsive: true, 
                            maintainAspectRatio: false,
                            legend: {
                                display: false
                            },
                            tooltips: {
                                bodySpacing: 4,
                                mode:"nearest",
                                intersect: 0,
                                position:"nearest",
                                xPadding:10,
                                yPadding:10,
                                caretPadding:10
                            },
                            layout:{
                                padding:{left:5,right:5,top:15,bottom:15}
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        fontStyle: "500",
                                        beginAtZero: false,
                                        maxTicksLimit: 5,
                                        padding: 10
                                    },
                                    gridLines: {
                                        drawTicks: false,
                                        display: false
                                    }
                                }],
                                xAxes: [{
                                    gridLines: {
                                        zeroLineColor: "transparent"
                                    },
                                    ticks: {
                                        padding: 10,
                                        fontStyle: "500"
                                    }
                                }]
                            }, 
                            legendCallback: function(chart) { 
                                var text = []; 
                                text.push('<ul class="' + chart.id + '-legend html-legend">'); 
                                for (var i = 0; i < chart.data.datasets.length; i++) { 
                                    text.push('<li><span style="background-color:' + chart.data.datasets[i].legendColor + '"></span>'); 
                                    if (chart.data.datasets[i].label) { 
                                        text.push(chart.data.datasets[i].label); 
                                    } 
                                    text.push('</li>'); 
                                } 
                                text.push('</ul>'); 
                                return text.join(''); 
                            }  
                        }
                    });
                    
                    statisticsChart2 = new Chart(ctx2, {
                        type: 'line',
                        data: {
                            labels: html.data2.label,
                            datasets: [ {
                                label: "Booking Count",
                                borderColor: '#177dff',
                                pointBackgroundColor: 'rgba(23, 125, 255, 0.6)',
                                pointRadius: 0,
                                backgroundColor: 'rgba(23, 125, 255, 0.4)',
                                legendColor: '#177dff',
                                fill: true,
                                borderWidth: 2,
                                data: html.data2.data
                            }]
                        },
                        options : {
                            responsive: true, 
                            maintainAspectRatio: false,
                            legend: {
                                display: false
                            },
                            tooltips: {
                                bodySpacing: 4,
                                mode:"nearest",
                                intersect: 0,
                                position:"nearest",
                                xPadding:10,
                                yPadding:10,
                                caretPadding:10
                            },
                            layout:{
                                padding:{left:5,right:5,top:15,bottom:15}
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        fontStyle: "500",
                                        beginAtZero: false,
                                        maxTicksLimit: 5,
                                        padding: 10
                                    },
                                    gridLines: {
                                        drawTicks: false,
                                        display: false
                                    }
                                }],
                                xAxes: [{
                                    gridLines: {
                                        zeroLineColor: "transparent"
                                    },
                                    ticks: {
                                        padding: 10,
                                        fontStyle: "500"
                                    }
                                }]
                            }, 
                            legendCallback: function(chart) { 
                                var text = []; 
                                text.push('<ul class="' + chart.id + '-legend html-legend">'); 
                                for (var i = 0; i < chart.data.datasets.length; i++) { 
                                    text.push('<li><span style="background-color:' + chart.data.datasets[i].legendColor + '"></span>'); 
                                    if (chart.data.datasets[i].label) { 
                                        text.push(chart.data.datasets[i].label); 
                                    } 
                                    text.push('</li>'); 
                                } 
                                text.push('</ul>'); 
                                return text.join(''); 
                            }  
                        }
                    });

                }
                $(".overlay").hide();
            }
        });
    });

    $(document).on("click", ".carwise-booking" , function(e) { 
        $(".overlay").show();
        var dayValue = $(this).attr('data-value');
        $.ajax({
            url: baseUrl + '/admin/get-dashboard-booking-data',
            type: 'post',
            data: {'period':$(this).attr('data-value'),'card':'carwise-booking'},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function( html ) {
                if(html){
                    if (myPieChart) {
                        myPieChart.destroy();
                    }
                    myPieChart = new Chart(pieChart, {
                        type: "pie",
                        data: {
                            datasets: [
                                {
                                    data: html.data,
                                    backgroundColor: html.color,
                                    borderWidth: 0,
                                },
                            ],
                            labels: html.label,
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            legend: {
                            position: "bottom",
                                labels: {
                                    fontColor: "rgb(154, 154, 154)",
                                    fontSize: 11,
                                    usePointStyle: true,
                                    padding: 20,
                                },
                            },
                            pieceLabel: {
                                render: "percentage",
                                fontColor: "white",
                                fontSize: 14,
                            },
                            tooltips: true,
                            layout: {
                                padding: {
                                    left: 20,
                                    right: 20,
                                    top: 20,
                                    bottom: 20,
                                },
                            },
                        },
                    });              
                }
                $(".overlay").hide();
            }
        });
    });

    $(document).on("click", ".customer-count" , function(e) { 
        $(".overlay").show();
        var dayValue = $(this).attr('data-value');
        $.ajax({
            url: baseUrl + '/admin/get-dashboard-booking-data',
            type: 'post',
            data: {'period':$(this).attr('data-value'),'card':'customer-count'},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function( html ) {
                if(html){
                    $("#customer-total").html(html[0].cnt);          
                }
                $(".overlay").hide();
            }
        });
    });

    $(document).on("click", ".sales-count" , function(e) { 
        $(".overlay").show();
        var dayValue = $(this).attr('data-value');
        $.ajax({
            url: baseUrl + '/admin/get-dashboard-booking-data',
            type: 'post',
            data: {'period':$(this).attr('data-value'),'card':'sales-count'},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function( html ) {
                if(html){
                    $("#booking-total").html('AED '+html[0].booking_total);  
                }
                $(".overlay").hide();
            }
        });
    });

});
</script>
@endsection