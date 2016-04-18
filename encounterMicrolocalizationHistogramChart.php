<?php
include ('header.php');
include ("moai_db_connection.php");
include ("models/encounterService.php");
?>

	<h3> Histograma - Microlocalización de encuentros</h3>
	<p>&nbsp;</p>
	<div style="width: 90%" align="center">
		<canvas id="canvas" height="350" width="600">
		</canvas>
	</div>

<?php

$encounterHours = array();
$encounterHoursCount = array();

// after getting the associative array 'encounterType' -> 'encounterTypeCount'
// (returned by getEncounterTypesCount()) we split the array
// in separate key and value arrays.
// this is done to ease the use of json_encode to put data for plots
foreach (EncounterService::getEncounterMicroLocalizationCount() as $arrayKey => $arrayValue) {
	$encounterHours[] = $arrayKey;
	$encounterHoursCount[] = $arrayValue;
}

?>

	<script>

		var barChartData = {
			labels : <?php echo json_encode($encounterHours); ?>,
			datasets : [
				{
					fillColor : "rgba(220,220,220,0.9)",
					strokeColor : "rgba(220,220,220,0.8)",
					highlightFill: "rgba(220,220,220,0.75)",
					highlightStroke: "rgba(220,220,220,1)",
					data : <?php echo json_encode($encounterHoursCount); ?>
				}
			]
		}
		window.onload = function(){
			var ctx = document.getElementById("canvas").getContext("2d");
			window.myBar = new Chart(ctx).Bar(barChartData, {
				responsive : true
			});
		}
	</script>
<?php
include('footer.html');
?>