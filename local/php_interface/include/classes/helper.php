<?
namespace ft;

class CHelper {

	const SESSION_CODE = 'FTDEV';

	/**
	 * Сохраняет данные в сессию
	 *
	 * @param array $arFields
	 * @param bool $clear
	 * @return bool
	 */
	public function setSession($arFields, $clear = false) {

		if(!is_array($arFields)) {
			return false;
		}

		if(empty($_SESSION[self::SESSION_CODE])) {
			$_SESSION[self::SESSION_CODE] = array();
		}

		if($clear) {
			$_SESSION[self::SESSION_CODE] = array();
		}

		$_SESSION[self::SESSION_CODE] = array_merge($_SESSION[self::SESSION_CODE], $arFields);
		return true;
	}

	/**
	 * Берет данные из сессии
	 *
	 * @return bool
	 */
	public function getSession() {
		return $_SESSION[self::SESSION_CODE];
		return true;
	}

	/**
	 *  Очистка параметра сессии
	 *
	 * @return bool
	 */
	public function removeSessionParam($paramName) {
		if(!isset($_SESSION[self::SESSION_CODE][$paramName])) {
			return false;
		}
		unset($_SESSION[self::SESSION_CODE][$paramName]);
		return true;
	}

	/**
	 * Очистка сессии
	 *
	 * @return bool
	 */
	public function clearSession() {
		unset($_SESSION[self::SESSION_CODE]);
		return true;
	}

	/**
	 * Declination words
	 *
	 * @param int $number
	 * @param string $nominative
	 * @param string $accusative
	 * @param string $genitive
	 * @return string
	 */
	public function wordDeclension($number, $nominative, $accusative, $genitive, $net = '', $withoutNumber = false) {

		$number = intval($number);

		if ($number == 0 && !empty($net)) {
			return $net . "&nbsp;" . $genitive;
		}

		if ((int)(($number%100)/10)==1)
			return ($withoutNumber ? "" : $number . "&nbsp;") . $genitive;

		switch($number%10) {
			case 1:

				return (!$withoutNumber ? $number . "&nbsp;" : '') . $nominative;
				break;

			case 2:
			case 3:
			case 4:

				return (!$withoutNumber ? $number . "&nbsp;" : '') . $accusative;
				break;

			default:
				return (!$withoutNumber ? $number . "&nbsp;" : '') . $genitive;
		}

	}


	public static function prepareFields($arFields = array()) {
		array_walk_recursive($arFields, function(&$value) {$value = htmlspecialchars($value);});
		array_walk_recursive($arFields, function(&$value) {$value = trim($value);});

		return $arFields;
	}

	public static function returnJsonAnswer($arReturn) {
		print json_encode($arReturn);
		die();
	}

	public static function returnAnswer($code = 0, $text = 'Неизвестная ошибка', $arAdditionalFields = array()) {

		if($code !== 0) {
			$result = $code > 0 ? 'SUCCESS' : 'ERROR';
		} else {
			$result = 'WARNING';
		}

		$arReturn = array(
			'RESULT' => $result,
			'CODE' => $code,
			'TEXT' => $text,
		);

		return array_merge($arReturn, $arAdditionalFields);
	}

	public static function getShortSize($size) {

		$stepArray = array(
			'b',
			'Kb',
			'Mb',
			'Gb',
			'Tb'
		);
		$step = 0;
		while($size >= 1024) {
			$size = $size/1024;
			$step++;
		}

		return round($size) . ' ' . $stepArray[$step];
	}

	public static function showError($text) {
		?>
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-danger">
					<?=$text?>
				</div>
			</div>
		</div>
		<?
	}

	public static function getHostname($siteID = false) {
		$serverName = '';
		if ($siteID && 0 < strlen($siteID) && $arSite = \CSite::GetArrayByID($siteID)) {
			$serverName = $arSite['SERVER_NAME'];
		}
		if (0 >= strlen(trim($serverName))) {
			if (array_key_exists('HTTP_HOST', $_SERVER) && 0 < strlen(trim($_SERVER['HTTP_HOST']))) {
				$serverName = $_SERVER['HTTP_HOST'];
				//} elseif ('development' == getenv('APPLICATION_ENV')) {
				//    $serverName = 'dev.rentride.ru';
			} elseif (defined("SITE_SERVER_NAME") && 0 < strlen(trim(SITE_SERVER_NAME))) {
				$serverName = SITE_SERVER_NAME;
			} else {
				$serverName = \COption::GetOptionString('main', 'server_name');
			}
		}
		return trim($serverName);
	}

	public static function getDomain($siteID = false) {
		return 'http://' . self::getHostname($siteID);
	}

	public static function getLinkId($link) {

		$link = trim($link);
		if(empty($link)) {
			return false;
		}

		return md5($link);
	}

}

?>