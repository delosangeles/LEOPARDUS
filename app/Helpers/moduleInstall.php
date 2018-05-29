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
if (!function_exists('moduleInstall')) {
	//
	function moduleInstall($_path)
	{
		// Leemos el archivo module.json
		$_data = File::get($_path . "/module.json");
		$_module = json_decode($_data, true);
		$_slug = str_slug($_module['name'], '.');
		
		// Obtenemos el modulo desde la db.
		$query = \App\Module::where('slug', $_slug)
					->where('status', 1);

		// Update?
		if( $query->count() > 0 ) {
			return moduleUpdate($_module, $_path);
		}

		// Instalamos el modulo en la base de datos.
		$module = new \App\Module;
		$module->name = $_module['name'];
		$module->slug = $_slug;
		$module->path = $_path;
		$module->status = 1;
		$module->save();

		// Install Module
		require($_path . '/install.php');

		// return
		return $_module;
	}
}