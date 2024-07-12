<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<div class="d-flex flex-fill flex-column shadow-sm bg-white rounded-main-window overflow-auto ms-2 mt-2">
	<div class="row w-100 m-0 p-0">
		<div class="col-sm-4 m-0 p-3">
			<div class="p-3 rounded-3 bg-light shadow-sm overflow-hidden bg-gradient border">
				<div class="text-nowrap">
					<h4 class="lh-sm m-0 p-0 text-secondary">Welcome <span style="font-family: 'Caveat', cursive; font-size: 22pt; font-weight: bold">{{ \Auth::user()->name }}</span></h4>
					<div class="mt-2 d-flex flex-column">
						<span class="lh-sm text-success">Last login : {{ \Auth::user()->current_login }}</span>
						<span class="lh-sm text-success">IP Address : {{ \Auth::user()->current_ip }}</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-8 m-0 p-3">
			<div class="rounded-3 p-3 bg-light border shadow-sm">
				<h4 class="lh-sm m-0 p-0 text-secondary fw-bold">Statistik Job Posting RUN8</h4>
				<div class="row">
					<div class="col mt-2 d-flex">
						<div class="bg-warning bg-gradient rounded-1 d-flex align-items-center justify-content-center" style="min-width: 45px; height: 45px">
							<i class="material-icons-outlined text-light">list</i>
						</div>
						<div class="flex-grow-1 d-flex flex-column ms-2 overflow-hidden">
							<span class="lh-sm small text-secondary text-nowrap">Mitra</span>
							<span class="lh-sm fs-4 fw-bold">0</span>
						</div>
					</div>
					<div class="col mt-2 d-flex">
						<div class="bg-success bg-gradient rounded-1 d-flex align-items-center justify-content-center" style="min-width: 45px; height: 45px">
							<i class="material-icons-outlined text-light">fact_check</i>
						</div>
						<div class="flex-grow-1 d-flex flex-column ms-2 overflow-hidden">
							<span class="lh-sm small text-secondary text-nowrap">Klien</span>
							<span class="lh-sm fs-4 fw-bold">0</span>
						</div>
					</div>
					<div class="col mt-2 d-flex">
						<div class="bg-primary bg-gradient rounded-1 d-flex align-items-center justify-content-center" style="min-width: 45px; height: 45px">
							<i class="material-icons-outlined text-light">event_available</i>
						</div>
						<div class="flex-grow-1 d-flex flex-column ms-2 overflow-hidden">
							<span class="lh-sm small text-secondary text-nowrap">Pelamar</span>
							<span class="lh-sm fs-4 fw-bold">0</span>
						</div>
					</div>
					<div class="col mt-2 d-flex">
						<div class="bg-info bg-danger rounded-1 d-flex align-items-center justify-content-center" style="min-width: 45px; height: 45px">
							<i class="material-icons-outlined text-light">event_busy</i>
						</div>
						<div class="flex-grow-1 d-flex flex-column ms-2 overflow-hidden">
							<span class="lh-sm small text-secondary text-nowrap">Lowongan</span>
							<span class="lh-sm fs-4 fw-bold">0</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row w-100 m-0 p-0">
		<div class="col-sm-4 m-0 p-3">
			<div class="rounded-3 bg-white border p-3 d-flex flex-column" style="height: 400px">
				<div class="d-flex flex-row w-100">
					<h5 class="lh-sm m-0 p-0 text-secondary fw-bold flex-grow-1">Aktivitas Terkini</h5>
					<a href="#" class="text-dark text-decoration-none p-0 px-2 bg-teal-hover" role="button">
						<span class="me-2">Selengkapnya</span>
						<svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="jds-icon__svg" style="width: 16px; height: 16px; transform: rotate(0deg); fill: currentcolor;"><path d="M15.3333 16.2222H4.66667C4.17778 16.2222 3.77778 15.8222 3.77778 15.3333V4.66667C3.77778 4.17778 4.17778 3.77778 4.66667 3.77778H9.11111C9.6 3.77778 10 3.37778 10 2.88889C10 2.4 9.6 2 9.11111 2H3.77778C3.30628 2 2.8541 2.1873 2.5207 2.5207C2.1873 2.8541 2 3.30628 2 3.77778V16.2222C2 17.2 2.8 18 3.77778 18H16.2222C17.2 18 18 17.2 18 16.2222V10.8889C18 10.4 17.6 10 17.1111 10C16.6222 10 16.2222 10.4 16.2222 10.8889V15.3333C16.2222 15.8222 15.8222 16.2222 15.3333 16.2222ZM11.7778 2.88889C11.7778 3.37778 12.1778 3.77778 12.6667 3.77778H14.9689L6.85333 11.8933C6.68713 12.0595 6.59376 12.285 6.59376 12.52C6.59376 12.755 6.68713 12.9805 6.85333 13.1467C7.01954 13.3129 7.24495 13.4062 7.48 13.4062C7.71505 13.4062 7.94046 13.3129 8.10667 13.1467L16.2222 5.03111V7.33333C16.2222 7.82222 16.6222 8.22222 17.1111 8.22222C17.6 8.22222 18 7.82222 18 7.33333V2.88889C18 2.4 17.6 2 17.1111 2H12.6667C12.1778 2 11.7778 2.4 11.7778 2.88889Z"></path></svg>
					</a>
				</div>
				<div class="mt-2 d-flex flex-column flex-grow-1">
					<div class="flex-grow-1 border-top">
						<h3 class="text-center mt-3">Data tidak ditemukan!</h3>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-8 m-0 p-3">
			<div class="rounded-3 bg-white border p-3 d-flex flex-column" style="height: 400px">
				<h5 class="lh-sm m-0 p-0 text-secondary fw-bold">Statistik Lowongan VS Pelamar {{ date_format(now(), 'Y') }}</h5>
				<div id="chart" class="mt-2 flex-grow-1 border-top"></div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var options = {
          series: [{
          name: 'Diusulkan',
          type: 'area',
          data: [23, 11, 22, 27, 13, 22, 37, 21, 44, 22, 30, 40]
        }, {
          name: 'Diterima',
          type: 'area',
          data: [44, 55, 41, 67, 22, 43, 21, 41, 56, 27, 43, 35]
        }, {
          name: 'Ditolak',
          type: 'area',
          data: [30, 25, 36, 30, 45, 35, 64, 52, 59, 36, 39, 5]
        }],
          chart: {
          height: 350,
          type: 'line',
          stacked: false,
        },
        stroke: {
          width: [2, 2, 2],
          curve: 'smooth'
        },
        plotOptions: {
          bar: {
            columnWidth: '50%'
          }
        },
        
        fill: {
          opacity: [0.25, 0.25, 0.25],
          gradient: {
            inverseColors: false,
            shade: 'light',
            type: "vertical",
            opacityFrom: 0.85,
            opacityTo: 0.55,
            stops: [0, 100, 100, 100]
          }
        },
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        markers: {
          size: 0
        },
        xaxis: {
          type: 'string'
        },
        yaxis: {
          title: {
            text: 'Points',
          },
          min: 0
        },
        tooltip: {
          shared: true,
          intersect: false,
          y: {
            formatter: function (y) {
              if (typeof y !== "undefined") {
                return y.toFixed(0) + " points";
              }
              return y;
        
            }
          }
        }
        };

	var chart = new ApexCharts(document.querySelector("#chart"), options);
	chart.render();
        /*

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
	var options = {
		series: [{
			name: 'Deposit Masuk',
			data: [0, 0, 0, 44, 55, 57, 56, 61, 58, 63, 60, 66]
		}],
		chart: {
			type: 'bar',
			height: '90%',
			toolbar: {
				show: false
			}
		},
		plotOptions: {
			bar: {
				horizontal: false,
				columnWidth: '55%',
				endingShape: 'rounded'
			},
		},
		dataLabels: {
			enabled: false
		},
		stroke: {
			show: true,
			width: 2,
			colors: ['transparent']
		},
		xaxis: {
			labels: {
				rotate: -45
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
		},
		yaxis: {
			title: {
				text: 'Rp (ribu)'
			}
		},
		fill: {
			opacity: 1
		},
		tooltip: {
			y: {
				formatter: function (val) {
					return "Rp. " + val + " ribu"
				}
			}
		}
	};
	var chart = new ApexCharts(document.querySelector("#chart"), options);
	chart.render();
	*/
</script>