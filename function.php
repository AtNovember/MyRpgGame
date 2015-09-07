<?php

	function logFile($actionString, $actionResult ) {
		$fp = fopen('log.txt', 'a+'); 
		$actionString .= "\r\n";
		$log = fwrite($fp, $actionString );
		$actionResult .= "\r\n";
		$log2 = fwrite($fp, $actionResult);
	
		fclose($fp);
	}

?>