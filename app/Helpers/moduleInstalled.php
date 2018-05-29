<?php

/*
|--------------------------------------------------------------------------
| MODULE INSTALLER
|--------------------------------------------------------------------------
| Comprueba si está instalado un modulo por el nombré.
|
| @params name:string
| @return bolean
|
*/
if (!function_exists('moduleInstalled')) {
	//
	function moduleInstalled($path)
	{
		// Leemos el archivo module.json
		$data = File::get($path . "/module.json");
		$module = json_decode($data, true);

		// Verificamos si está instalado el modulo.
		$installed = \App\Module::where('slug', str_slug($module['name'], '.'))->count() > 0 ? true : false;
		
		return $installed;
	}
}