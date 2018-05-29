<?php
/*
|--------------------------------------------------------------------------
| MODULE INSTALLER
|--------------------------------------------------------------------------
| Comprueba si está instalado un modulo según el nombre.
|
| @params name:string
| @return bolean
|
*/
if (!function_exists('moduleUpdate')) {
	//
	function moduleUpdate($_module, $_path)
	{
		// 
		$_slug = str_slug($_module['name'], '.');
		
		// Obtenemos el modulo desde la db.
		$_module = \App\Module::where('slug', $_slug)->first();

		// Existe el modulo?
		if( $_module ) {
			// Actualizamos la version en la base de datos.
			$module = $_module->first();
			$module->version = $_module['version'];
			$module->save();

			// Update Module
			require($_path . '/update.php');

			// return
			return $_module;
		}

	}
}