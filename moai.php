<?php
include('header.php');
?>
<h4>Bienvenido al software prototipo de MOAI</h4>
<p>Seleccione un tipo de reporte:</p>

<!--<p><a href="searchByKeyword.php">Búsqueda por palabra clave y filtrado</a></p>-->
<p><!--<p><a href="reportePorHora.php">Actividad por día</a></p>-->Reportes gráficos:</p>
<p><a href="encounterHourHistogramChart.php">Histograma - Hora de Encuentros</a></p>
<p><a href="encounterDateTimeSeriesChart.php">Serie de Tiempo -  Encuentros por Fecha</a></p>
<p><a href="encounterTypeRadarChart.php">Radar - Tipo de Encuentros</a></p>
<p><a href="encounterHourRadarChart.php">Radar - Hora de Encuentros</a></p>
<p><a href="encounterLocalizationRadarChart.php">Radar - Localización de Encuentros</a></p>
<p><a href="encounterMicrolocalizationHistogramChart.php">Histograma - Microlocalización de encuentros</a></p>

<?php
include('footer.html');
?>
