<?
namespace ft\model;

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

/**
 *    Базовый абстрактный класс для работы с HL инфоблоками
 */
class CBaseModel
{

	static $instance;
	protected $entity;
	protected $hlblock;

	function __construct()
	{
		\CModule::IncludeModule('highloadblock');
		\CModule::IncludeModule('iblock');

		$this->hlblock = HL\HighloadBlockTable::getById(0)->fetch();
		$this->entity = HL\HighloadBlockTable::compileEntity($this->hlblock);
	}

	/**
	 *    статический метод для получения экземпляра класса
	 *
	 *    реализует паттерн Singleton
	 *
	 * @return mixed объект
	 */
	public static function getInstance()
	{
		if (!static::$instance) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 *    Получение списка записей
	 *
	 * @param mixed[] $arSelect перечень выбираемых полей
	 * @param mixed[] $arFilter условия для фильтрации
	 * @param mixed[] $arSort условия сортировки
	 * @return mixed возвращает иттератор CDBResult
	 */
	public function getList($arSelect = array('*'), $arFilter = array(), $arSort = array(), $arGroup = array(), $limit = 0, $offset = 0, $arRuntimeFields = array())
	{

		$main_query = new Entity\Query($this->entity);
		$main_query->setSelect($arSelect);
		$main_query->setOrder($arSort);
		$main_query->setFilter($arFilter);

		$main_query->setGroup($arGroup);
		$main_query->setLimit($limit);
		$main_query->setOffset($offset);
		//echo $main_query->getQuery();

		foreach ($arRuntimeFields as $runtimeField) {

			$arSettings = array();

			if (isset($runtimeField['data_type'])) {
				$arSettings['data_type'] = $runtimeField['data_type'];
			}
			if (isset($runtimeField['reference'])) {
				$arSettings['reference'] = $runtimeField['reference'];
			}
			if (isset($runtimeField['expression'])) {
				$arSettings['expression'] = $runtimeField['expression'];
			}
			if (isset($runtimeField['join_type'])) {
				$arSettings['join_type'] = $runtimeField['join_type'];
			}

			$main_query->registerRuntimeField($runtimeField['name'], $arSettings);
		}

		$result = $main_query->exec();
		$result = new \CDBResult($result);

		return $result;
	}

	/**
	 *    Получение количества записей по фильру
	 *
	 * @param mixed[] $arFilter условия для фильтрации
	 * @return int количества записей по фильру
	 */
	public function getCount($arFilter = array())
	{

		$main_query = new Entity\Query($this->entity);
		$main_query->setFilter($arFilter);
		$res = $main_query->exec();

		return $res->getSelectedRowsCount();
	}

	/**
	 *    Добавляет запись с заданными полями
	 *
	 * @param mixed[] $arFields перечень полей
	 * @return int идентификатор новой записи
	 */
	public function add($arFields)
	{
		unset($arFields['ID']);

		$entity_data_class = $this->entity->getDataClass();
		$result = $entity_data_class::add($arFields);

		return $result->getId();
	}

	/**
	 * Удаляет запись по её ID
	 *
	 * @param $ID
	 * @return Entity\DeleteResult
	 * @throws \Exception
	 */
	public function delete($ID)
	{
		$entity_data_class = $this->entity->getDataClass();

		return $entity_data_class::delete($ID);
	}

	/**
	 *    Обновляет запись с заданными полями
	 *
	 * @param int $ID идентификатор записи
	 * @param mixed[] $arFields перечень полей
	 * @return int идентификатор старой записи
	 */
	public function update($ID, $arFields)
	{
		unset($arFields['ID']);
		$entity_data_class = $this->entity->getDataClass();
		$result = $entity_data_class::update($ID, $arFields);

		return $result->getId();
	}

}


?>