@extends('layouts.admin')

@section('content')

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
                        <div class="chart-container" style="min-height: 375px">
                            <canvas id="statisticsChart"></canvas>
                        </div>
                    <div id="myChartLegend"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            
            <div class="card card-stats card-round">
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
                                <h4 class="card-title">AED 1,345</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-stats card-round">
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
                                <h4 class="card-title">1,294</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
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
    </div>
</div>
<script src="{{asset('admin_assets/js/core/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('admin_assets/js/plugin/chart.js/chart.min.js')}}"></script>
<script>

var ctx = document.getElementById('statisticsChart').getContext('2d');
var statisticsChart = null;
var booking_stat = @php {{ echo json_encode($booking_stat);}} @endphp

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
                    statisticsChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: html.label,
                            datasets: [ {
                                label: "Booking Count",
                                borderColor: '#177dff',
                                pointBackgroundColor: 'rgba(23, 125, 255, 0.6)',
                                pointRadius: 0,
                                backgroundColor: 'rgba(23, 125, 255, 0.4)',
                                legendColor: '#177dff',
                                fill: true,
                                borderWidth: 2,
                                data: html.data
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

});
</script>
@endsection