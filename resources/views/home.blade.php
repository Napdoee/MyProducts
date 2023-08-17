@extends('templates.default')
@section('title','Dashboard')

@section('content')
<div class="row row-cards">
	<div class="col-6">
	    <div class="card card-sm">
	      	<div class="card-body">
	        	<div class="row align-items-center">
		          	<div class="col-auto">
			            <span class="bg-primary text-white avatar">
							<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
							   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
							   <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
							   <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
							</svg>
			            </span>
		          	</div>
		         	<div class="col">
			            <div class="font-weight-medium">
			              Jumlah Siswa
			            </div>
			            <div class="text-muted">
			              {{ $studentCount['Laki-laki'] }} Laki-laki / {{ $studentCount['Perempuan'] }} Perempuan
			            </div>
		          	</div>
	        	</div>
	      	</div>
	    </div>
	 </div>
	 <div class="col-6">
	    <div class="card card-sm">
	      	<div class="card-body">
	        	<div class="row align-items-center">
	          		<div class="col-auto">
	            		<span class="bg-primary text-white avatar">
	              			<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
							   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
							   <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
							   <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
							</svg>
	            		</span>
	          		</div>
	          		<div class="col">
	            		<div class="font-weight-medium">
	              			Jumlah Guru
	            		</div>
			            <div class="text-muted">
			              {{ $teacherCount }} Guru
			            </div>
	          		</div>
	        	</div>
	      	</div>
	    </div>
	</div>
	<div class="col-6">
		<div class="card">
			<div class="card-header">
				<div class="card-title">
					Charts
				</div>
			</div>
			<div class="card-body pb-0">
				<div id="chart-demo-pie" class="chart-lg"></div>
			</div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/libs/apexcharts/dist/apexcharts.min.js" defer></script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    window.ApexCharts && (new ApexCharts(document.getElementById('chart-demo-pie'), {
      chart: {
        type: "donut",
        fontFamily: 'inherit',
        height: 240,
        sparkline: {
          enabled: true
        },
        animations: {
          enabled: true
        },
      },
      fill: {
        opacity: 1,
      },
      series: [10, 7],
      labels: ["Siswa", "Guru"],
      tooltip: {
        theme: 'dark'
      },
      grid: {
        strokeDashArray: 4,
      },
      colors: [tabler.getColor("primary", 0.6), tabler.getColor("success", 0.6)],
      legend: {
        show: true,
        position: 'bottom',
        offsetY: 12,
        markers: {
          width: 10,
          height: 10,
          radius: 100,
        },
        itemMargin: {
          horizontal: 8,
          vertical: 8
        },
      },
      tooltip: {
        fillSeriesColor: false
      },
    })).render();
  });
</script>
@endsection
