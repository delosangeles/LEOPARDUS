<?php
use Brotzka\DotenvEditor\DotenvEditor;
use Brotzka\DotenvEditor\Exceptions\DotEnvException;
/*
|--------------------------------------------------------------------------
| Helper isConfigured
|--------------------------------------------------------------------------
| Comprueba si está configurado el nombré.
|
| @return bolean
|
*/
if (!function_exists('isConfigured')) {
	//
	function isConfigured()
	{
		$env = new DotenvEditor();

		try{
            //
            $is_configured = $env->getValue("DB_DATABASE") == 'homestead' ? false : true;

            return $is_configured;

        }catch(DotEnvException $e){
            echo $e->getMessage();
        }
	}
}