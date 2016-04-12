<?php
// this class provides some services (TS pattern) for encounters
// as an example, getting all encounter types
class EncounterService {
	
	// returns all encounter types
	public static function getEncounterTypes() {
		$encounterTypes = 
		"SELECT tipo_encuentro 
		FROM tipo_encuentro 
		GROUP BY tipo_encuentro";
		
		$result	 = 	mysql_query($encounterTypes) 
					or die('Consulta fallida: ' . mysql_error());
		
		$encounterTypes = array();
		
		while ($line = mysql_fetch_array($result, MYSQL_NUM)) {
			array_push($encounterTypes, $line[0]);
		}
		
		return $encounterTypes;
	}
	
	// returns *all* encounter types count (type, count)
	public static function getEncounterTypesCount() {
		$encounterTypesCount = 
		"SELECT tipo_encuentro.tipo_encuentro, COUNT(*) 
		FROM encuentro, tipo_encuentro 
		WHERE encuentro.tipo_encuentro = tipo_encuentro.id
		GROUP BY tipo_encuentro.tipo_encuentro 
		ORDER BY tipo_encuentro.tipo_encuentro";
		
		$result	 = 	mysql_query($encounterTypesCount) 
					or die('Consulta fallida: ' . mysql_error());
		
		$encounterTypesCount = array();
		
		while ($line = mysql_fetch_array($result, MYSQL_NUM)) {
			$encounterTypesCount = array_merge($encounterTypesCount, array($line[0] => $line[1]));
		}
		
		
		return $encounterTypesCount;
	}
	
	// returns *all* encounter hours count (hour, count)
	public static function getEncounterHoursCount() {
		$encounterHoursCount = 
		"SELECT hora.hora, COUNT(*) 
		FROM encuentro, hora 
		WHERE encuentro.hora = hora.id 
		GROUP BY hora.hora 
		ORDER BY hora.hora";
		
		$result	 = 	mysql_query($encounterHoursCount) 
					or die('Consulta fallida: ' . mysql_error());
		
		$encounterHoursCount = array();
		
		while ($line = mysql_fetch_array($result, MYSQL_NUM)) {
			$encounterHoursCount = array_merge($encounterHoursCount, array($line[0] => $line[1]));
		}
		
		return $encounterHoursCount;
	}

	// returns *all* encounter dates count (date, count)	
	public static function getEncounterDatesCount() {
		$encounterDatesCount = 
		"SELECT encuentro.fecha, COUNT(*) 
		FROM encuentro 
		GROUP BY encuentro.fecha";
		
		$result	 = 	mysql_query($encounterDatesCount) 
					or die('Consulta fallida: ' . mysql_error());
		
		$encounterDatesCount = array();
		
		while ($line = mysql_fetch_array($result, MYSQL_NUM)) {
			$encounterDatesCount = array_merge($encounterDatesCount, array($line[0] => $line[1]));
		}
		
		return $encounterDatesCount;
	}
	
	// returns *all* encounter localization count (localization, count)
	public static function getEncounterLocalizationCount() {
		$encounterLocalizationCount = 
		"SELECT localizacion_administrativa.localizacion_administrativa, COUNT(*) 
		FROM encuentro, localizacion_administrativa
		WHERE localizacion_administrativa.id = encuentro.localizacion_administrativa 
		AND localizacion_administrativa.localizacion_administrativa IS NOT NULL
		GROUP BY encuentro.localizacion_administrativa";
		
		$result	 = 	mysql_query($encounterLocalizationCount) 
					or die('Consulta fallida: ' . mysql_error());
		
		$encounterLocalizationCount = array();
		
		while ($line = mysql_fetch_array($result, MYSQL_NUM)) {
			$encounterLocalizationCount = array_merge($encounterLocalizationCount, array($line[0] => $line[1]));
		}
		
		return $encounterLocalizationCount;
	}

	// returns *all* encounter microlocalization count (microlocalization, count)
	public static function getEncounterMicroLocalizationCount() {
		$encounterLocalizationCount = 
		"SELECT microlocalizacion.microlocalizacion, COUNT(*) 
		FROM encuentro, microlocalizacion
		WHERE microlocalizacion.id = encuentro.microlocalizacion 
		AND microlocalizacion.microlocalizacion IS NOT NULL
		GROUP BY encuentro.microlocalizacion";
		
		$result	 = 	mysql_query($encounterLocalizationCount) 
					or die('Consulta fallida: ' . mysql_error());
		
		$encounterLocalizationCount = array();
		
		while ($line = mysql_fetch_array($result, MYSQL_NUM)) {
			$encounterLocalizationCount = array_merge($encounterLocalizationCount, array($line[0] => $line[1]));
		}
		
		return $encounterLocalizationCount;
	}
	
	// returns a *descriptor* with temporary encounters by source
	// please note that temporary encounter means 'scraped encounter' that hasn't been
	// incorporated in moai model
	public static function getTemporaryEncounters($source) {
		$temporaryEncounters = 
		"SELECT descripcion, fecha_obtencion , fuente
		FROM encuentro_temporal 
		WHERE fuente = '$source' 
		ORDER BY fecha_obtencion DESC";
		
		$result	 = 	mysql_query($temporaryEncounters) 
					or die('Consulta fallida: ' . mysql_error());
		
		// return mysql result descriptor!!!
		return $result;
	}
	
	// returns a *descriptor* with *all* temporary encounters
	public static function getAllTemporaryEncounters() {
		$temporaryEncounters = 
		"SELECT descripcion, fecha_obtencion , fuente
		FROM encuentro_temporal 
		ORDER BY fuente ASC";
		
		$result	 = 	mysql_query($temporaryEncounters) 
					or die('Consulta fallida: ' . mysql_error());
		
		// return mysql result descriptor!!!
		return $result;
	}
	
	// use with caution; this delete all temporary encounters
	// if they haven't been incorporated in the moai model, the temporary encounters
	// wouldn't be recovered from original sources
	public static function deleteAllTemporaryEncounters() {
		$temporaryEncounters = 
		"DELETE FROM encuentro_temporal";
		
		$result	 = 	mysql_query($temporaryEncounters) 
					or die('Consulta fallida: ' . mysql_error());
		
		// nothing to return... for now
	}
	
}

?>