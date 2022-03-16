<?php 

function rmDir_rf($carpeta)
{

	if( is_dir($carpeta)) {
		foreach(glob($carpeta . "/*") as $archivos_carpeta){             
			if (is_dir($archivos_carpeta)){
				rmDir_rf($archivos_carpeta);
			} else {
			unlink($archivos_carpeta);
			}
		}
		
		rmdir($carpeta);

	}
 }
