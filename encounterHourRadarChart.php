<?php
include('header.php');
include ("moai_db_connection.php");
include ("models/encounterService.php");
?>
	<h3>Radar - Tipo de Encuentros</h3>
	<p>&nbsp;</p>
	<div style="width: 50%" align="center">
		<canvas id="canvas" height="250" width="400">
		</canvas>
	</div>

<?php

$encounterHours = array();
$encounterHoursCount = array();

// after getting the associative array 'encounterType' -> 'encounterTypeCount'
// (returned by getEncounterTypesCount()) we split the array
// in separate key and value arrays.
// this is done to ease the use of json_encode to put data for plots
foreach (EncounterService::getEncounterHoursCount() as $arrayKey => $arrayValue) {
	$encounterHours[] = $arrayKey;
	$encounterHoursCount[] = $arrayValue;
}

?>

	<script>

		var radarChartData = {
			// labels data points are converted using json_encode to meet
			// Chart.js input requirements (see below)
			labels: <?php echo json_encode($encounterHours); ?>,
			datasets: [
				{
					label: "My Second dataset",
					fillColor: "rgba(151,187,205,0.2)",
					strokeColor: "rgba(151,187,205,1)",
					pointColor: "rgba(151,187,205,1)",
					pointStrokeColor: "#fff",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(151,187,205,1)",
					data: <?php echo json_encode($encounterHoursCount); ?>
				}
			]
		};
		window.onload = function(){
			window.myRadar = new Chart(document.getElementById("canvas").getContext("2d")).Radar(radarChartData, {
				responsive: true
			});
		}

	</script>

<?php
include('footer.html');
?>