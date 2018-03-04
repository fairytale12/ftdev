<?
use Bitrix\Main\Application;
use Bitrix\Main\Loader;
/*
$arServerName = explode('.', $_SERVER['SERVER_NAME']);

if($arServerName[0] == 'test' && $arServerName[1] == 'ftdev') {
	LocalRedirect('test');
}
*/

function p($data) {
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}

function v($data) {
	echo '<pre>';
	var_dump($data);
	echo '</pre>';
}

define('FAIRYTALE_TPIC_NO_INIT', 'Y');
Loader::includeModule('fairytale.tpic');

// константы
require_once(Application::getDocumentRoot() . '/local/php_interface/include/define.php');

//phpQuery
require_once(Application::getDocumentRoot() . '/local/php_interface/include/classes/phpQuery-onefile.php');

// классы сайта
require_once(Application::getDocumentRoot() . '/local/php_interface/include/classes/pjax.php');

require_once(Application::getDocumentRoot() . '/local/php_interface/include/classes/helper.php');

// models
$modelsDir = Application::getDocumentRoot() . '/local/php_interface/include/classes/models/';
require_once($modelsDir . 'base.php');
$dir = opendir($modelsDir);
while($fileName = readdir($dir)) {

	if($fileName == '.' || $fileName == '..' || $fileName == 'base.php')  {
		continue;
	}

	$fileName = $modelsDir . '/' . $fileName;
	require_once($fileName);
}
closedir($dir);

// события
require_once(Application::getDocumentRoot() . '/local/php_interface/include/module_events/main.php');

?>