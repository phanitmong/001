@extends('layouts.master')
@section('content')
<div class="container-fluid pt-3">
    {{-- endnav bar --}}
    <div class="row">
        <div class="col-sm-6">
           <div class="row">
               <div class="col-sm-12 card p-3">
                   <h6>របាយការណ៍ចំណូល 30 ថ្ងៃចុងក្រោយ</h6>
                <canvas id="myChart" ></canvas>
               </div>
           </div>
           <div class="row">
              <div class="col-sm-6 card p-3" style="border-radius: 0px">
                  <div class="d-flex justify-content-between">
                    <h6>វិក្កយបត្រ</h6>
                    <a href="" class="btn btn-sm btn-outline-success" style="font-size: 12px">លម្អិត</a>
                  </div>
                  <small style="font-size: 10px">ចំនួនដែលត្រូវបានគិតប្រាក់រួចរាល់</small>
                  <hr>
                  <h6 class="mt-2 text-success">{{$total_invoice}} វិក្កយបត្រ</h6>
              </div>
              <div class="col-sm-6 card p-3" style="border-radius: 0px">
                <div class="d-flex justify-content-between">
                  <h6>ទំនិញបានលក់</h6>
                  <a href="" class="btn btn-sm btn-outline-success" style="font-size: 12px">លម្អិត</a>
                </div>
                <small style="font-size: 10px">ចំនួនដែលត្រូវបានគិតប្រាក់រួចរាល់</small>
                <hr>
                <h6 class="mt-2 text-success"> {{$total_product}} ចំនួន</h6>
            </div>
           </div>
           <div class="row">
            <div class="col-sm-6 card p-3" style="border-radius: 0px">
                <div class="d-flex justify-content-between">
                  <h6>ចំណូលសរុប</h6>
                  <a href="" class="btn btn-sm btn-outline-success" style="font-size: 12px">លម្អិត</a>
                </div>
                <small style="font-size: 10px">ចំនួនដែលត្រូវបានគិតប្រាក់រួចរាល់</small>
                <hr>
                <h6 class="mt-2 text-success">{{number_format($amount,2)}} វៀល</h6>
            </div>
            <div class="col-sm-6 card p-3" style="border-radius: 0px">
              <div class="d-flex justify-content-between">
                <h6>ខូចខាតសរុប</h6>
                <a href="" class="btn btn-sm btn-outline-success" style="font-size: 12px">លម្អិត</a>
              </div>
              <small style="font-size: 10px">ការខូចខាតត្រូវបានកាត់ចេញពីស្តុក</small>
              <hr>
              <h6 class="mt-2 text-success"> {{$scrap}} ចំនួន</h6>
          </div>
         </div>
        </div>

        <div class="col-sm-5 ml-3">
            <div class="row">
                <div class="col-sm-6 card p-3" style="border-radius: 0px">
                    <div class="d-flex justify-content-between">
                      <h6>ប្រភេទទំនិញសរុប</h6>
                      <a href="" class="btn btn-sm btn-outline-success" style="font-size: 12px">លម្អិត</a>
                    </div>
                    <small style="font-size: 10px">ប្រភេទទំនិញ</small>
                    <hr>
                    <h6 class="mt-2 text-success">{{$total_category}} ចំនួន</h6>
                </div>
                <div class="col-sm-6 card p-3" style="border-radius: 0px">
                  <div class="d-flex justify-content-between">
                    <h6>អ្នកប្រើប្រាស់សរុប</h6>
                    <a href="" class="btn btn-sm btn-outline-success" style="font-size: 12px">លម្អិត</a>
                  </div>
                  <small style="font-size: 10px">គណនីប្រើប្រាស់ក្នុងប្រព័ន្ធ</small>
                  <hr>
                  <h6 class="mt-2 text-success"> {{$all_user}} ចំនួន</h6>
              </div>
             </div>
             <div class="row">
                <div class="col-sm-6 card p-3" style="border-radius: 0px">
                    <div class="d-flex justify-content-between">
                      <h6>ទំនិញចូលស្តុកសរុប</h6>
                      <a href="" class="btn btn-sm btn-outline-success" style="font-size: 12px">លម្អិត</a>
                    </div>
                    <small style="font-size: 10px">ទំនិញដែលត្រូវបានបញ្ចូលក្នុងស្តុក</small>
                    <hr>
                    <h6 class="mt-2 text-success">{{$stock_in}} ចំនួន</h6>
                </div>
                <div class="col-sm-6 card p-3" style="border-radius: 0px">
                  <div class="d-flex justify-content-between">
                    <h6>ទំនិញកាត់ស្តុកសរុប</h6>
                    <a href="" class="btn btn-sm btn-outline-success" style="font-size: 12px">លម្អិត</a>
                  </div>
                  <small style="font-size: 10px">ទំនិញដែលត្រូវបានចេញពីស្តុក</small>
                  <hr>
                  <h6 class="mt-2 text-success"> {{$stock_out}} ចំនួន</h6>
              </div>
             </div>
            <div class="row">
                <div class="col-sm-12 card p-4">
                   <div class="d-flex justify-content-between">

                    <div class="w-50">
                        <canvas id="cats" class="w-100"></canvas>
                    </div>
                    <div class="text-left w-50">
                        <h6>ប្រភេទដែលពេញនិយម</h6>
                        @php
                            $color = [
                                    'rgb(255, 99, 132)',
                                    'rgb(54, 162, 235, )',
                                    'rgb(255, 206, 86, )',
                                    'rgb(75, 192, 192)',
                                    'rgb(153, 102, 255)',
                                    'rgb(255, 159, 64)'
                                      ];
                            $pick =0;
                        @endphp
                     <ul class="p-0 pl-4" style="list-style: none">
                        @foreach ($category as $cats)
                        <li style="font-size: 12px;"><i class="fa fa-circle mr-2" style="color:{{$color[$pick]}}"></i>{{$cats->name}} ({{$cats->total}})</li>
                        @php
                            $pick++;
                        @endphp
                        @endforeach
                      </ul>
                    </div>
                   </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
     $('#dashboard_menu').addClass('active');
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['',
            @foreach ($trend as $tr)
                        {{$tr->day}},
             @endforeach
                    ],
            datasets: [{
                label: 'ចំណូល',
                data: [
                    0,
                    @foreach ($trend as $tr)
                        {{$tr->total}},
                    @endforeach
                ],
                backgroundColor: [
                    'rgb(255, 99, 132, )',
                    'rgb(54, 162, 235, )',
                    'rgb(255, 206, 86, )',
                    'rgb(75, 192, 192, )',
                    'rgb(153, 102, 255, )',
                    'rgb(255, 159, 64, )'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
		x: {
			display: true,

			grid: {
				display: false
			},
			title: {
				display: false,
				text: "Month",
				color: "rgba(23, 23, 23, 1)",
				font: {
					family: "Roboto",
					size: 16,
					weight: "bold",
					lineHeight: 1.5
				},
				padding: {
					top: 20
				}
			}
		},
		y: {
			display: true,

			beginAtZero: true,
			grid: {
				display: true
			},
			title: {
				display: false,
				text: "Value",
				color: "rgba(23, 23, 23, 1)",
				font: {
					family: "Roboto",
					size: 16,
					weight: "bold",
					lineHeight: 1.5
				}
			}
		}
	},
        }
    });
    const cats = document.getElementById('cats').getContext('2d');
    const mycats = new Chart(cats, {
        type: 'doughnut',
        data: {
            labels: [
                @foreach ($category as $cats)
                    "{{$cats->name}}",
                @endforeach
            ],
            datasets: [{
                label: 'ចំណូល',
                data: [
                @foreach ($category as $cats)
                    "{{$cats->total}}",
                @endforeach],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 206, 86)',
                    'rgb(75, 192, 192 )',
                    'rgb(153, 102, 255)',
                    'rgb(255, 159, 64)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 0
            }]
        },
        options: {
            scales: {
		x: {
			display: false,

			grid: {
				display: false
			},

			title: {
				display: false,
				text: "Month",
				color: "rgba(23, 23, 23, 1)",
				font: {
					family: "Roboto",
					size: 16,
					weight: "bold",
					lineHeight: 1.5
				},
				padding: {
					top: 20
				}
			}
		},
		y: {
			display: false,

			beginAtZero: true,
			grid: {
				display: true
			},


			title: {
				display: false,
				text: "Value",
				color: "rgba(23, 23, 23, 1)",
				font: {
					family: "Roboto",
					size: 16,
					weight: "bold",
					lineHeight: 1.5
				}
			}
		}
	},
        }
    });
    </script>
@endsection
