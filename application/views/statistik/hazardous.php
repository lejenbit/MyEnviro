<link href="<?=base_url('assets/app-bs4')?>/css/add-on.css" rel="stylesheet">

	<div id="ui-view"><div><div class="animated fadeIn">
  
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <h2>Fasiliti Berlesen bagi Bahan Buangan Terjadual</h2>
  </div>

  </div>

<div class="hr-divider">
					<h3 class="hr-divider-content hr-divider-heading">

					</h3>
				</div>
  
  <div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="info-box">
							<span class="info-box-icon bg-purple"><i class="fa fa-recycle"></i></span>

							<div class="info-box-content">
								<span class="info-box-text">Jumlah Premis</span>
								<span class="info-box-number"><?php echo $jumlahHazardous;?></span>
							</div>
							<!-- /.info-box-content -->
						</div>
						<!-- /.info-box -->
					</div>
					<!-- /.col -->
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="info-box">
							<span class="info-box-icon bg-fuchsia"><i class="fa fa-flag-o"></i></span>

							<div class="info-box-content">
								<span class="info-box-text">Jenis Fasiliti</span>
								<span class="info-box-number">4</span>
							</div>
							<!-- /.info-box-content -->
						</div>
						<!-- /.info-box -->
					</div>
					
				</div>


				<div class="hr-divider">
					<h3 class="hr-divider-content hr-divider-heading">

					</h3>
				</div>





				<div class="row">
					<div class="col-sm-12 col-xl-6">
						<div class="card bg-info">
							<div class="card-header text-primary">
								<i class="fa fa-pie-chart"></i> Pecahan Fasiliti Berlesen Mengikut Daerah
								<div class="card-header-actions">
									<small class="text-muted">Sumber : doe.gov.my</small>
								</div>
							</div>
							<div class="card-body">
								<div class="jumbotron bg-white ">
									<canvas id="myChart" style="max-width: 500px;"></canvas>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-xl-6">
						<div class="card bg-warning">
							<div class="card-header text-primary">
								<i class="fa fa-bar-chart"></i> Pecahan Fasiliti Berlesen Mengikut Jenis Lesen
								<div class="card-header-actions">
									<small class="text-muted">Sumber : doe.gov.my</small>
								</div></div>
							<div class="card-body">
								<div class="jumbotron bg-white ">
									<div class="container">
										<canvas id="barChart" style="max-width: 500px; height:400px; "></canvas>

										<p>

										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div></div></div>

	<script>

		var ctx = document.getElementById("myChart").getContext('2d');

		var myChart = new Chart(ctx, {
		type: 'pie',
		data: {
		labels: [
		<?php
          foreach($chart as $ct){
            echo '"'.$ct[0].'",';
          }

          ?>
		],
		datasets: [{
		label: 'Bilangan Ladang',
		data: [<?php
          foreach($chart as $ct){
            echo $ct[1].",";
          }

          ?>],
		backgroundColor: [
		"#F7464A", "#46BFBD", "#FDB45C","#62088A", "#949FB1", "#4D5360"
		],
		hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#62088A", "#A8B3C5", "#616774"],
		borderWidth: 1
		}]
		},
		options: {
		responsive: true,

		legend: {
		position: 'bottom',
		fullwidth : true,
		labels:{
		fontColor:"#000",
		}
		},
		}
		}
		);


		var ctx2 = document.getElementById("barChart").getContext('2d');
		var barChart = new Chart(ctx2, {
		type: 'bar',
		data: {
		labels: [
		<?php
          foreach($chart as $ct){
            echo '"'.$ct[0].'",';
          }

          ?>
		],
		datasets: [
		////////////////Edit dataset untuk barchat//////////////////
		<?php foreach($barChart as $bar){ 
           $r = rand(0,255); 
           $g = rand(0,255); 
           $b = rand(0,255); 
           $color = dechex($r) . dechex($g) . dechex($b);
        ?>
		{
		label: '<?php echo $bar[0] ?>',
		data: [<?php
          foreach($bar[1] as $dataBar){
            echo $dataBar[0].",";
            }

          ?>],
		backgroundColor: [
		<?php foreach($bar[1] as $dataBar){
            echo "'rgba($r,$g,$b,1)',";
            }

          ?>

		],
		borderColor: [
		<?php foreach($bar[1] as $dataBar){
            echo "'rgba($r,$g,$b,0)',";
            }

          ?>

		],
		borderWidth: 1
		},
		<?php }?>
		//////////////end dataset/////////

		]
		},
		options: {
		scales: {
		yAxes: [{
		ticks: {
		beginAtZero: true
		},
		labels:{
		fontColor:"#fff",
		}
		}],
		xAxes: [{
		stacked: false
		}]
		},
		legend: {
		position: 'bottom',
		fullwidth : true,
		labels:{
		fontColor:"#000",
		boxWidth:20,
		}

		},
		}
		}
		);

	</script>


	