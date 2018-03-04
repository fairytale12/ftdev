<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
    return;

$arTypesEx = CIBlockParameters::GetIBlockTypes(Array("-"=>" "));

$arIBlocks=Array();
$db_iblock = CIBlock::GetList(Array("SORT"=>"ASC"), Array("SITE_ID"=>$_REQUEST["site"], "TYPE" => ($arCurrentValues["IBLOCK_TYPE"]!="-"?$arCurrentValues["IBLOCK_TYPE"]:"")));
while($arRes = $db_iblock->Fetch())
    $arIBlocks[$arRes["ID"]] = $arRes["NAME"];

$arComponentParameters = array(
    "GROUPS" => array(
    ),
    'PARAMETERS' => array(
        'CATEGORY_ID' => array(
            'PARENT' => 'BASE',
            'NAME' => 'ID выбранной категории',
            'TYPE' => 'STRING',
            'DEFAULT' => '',
        ),
        /*"IBLOCK_TYPE" => Array(
            "PARENT" => "BASE",
            "NAME" => 'Тип информационного блока (используется только для проверки)',
            "TYPE" => "LIST",
            "VALUES" => $arTypesEx,
            "DEFAULT" => "news",
            "REFRESH" => "Y",
        ),
        "IBLOCK_ID" => Array(
            "PARENT" => "BASE",
            "NAME" => 'Код информационного блока',
            "TYPE" => "LIST",
            "VALUES" => $arIBlocks,
            "DEFAULT" => '',
            "ADDITIONAL_VALUES" => "Y",
            "REFRESH" => "Y",
        ),
        "LIST_PARAM" => array(
            "PARENT" => "BASE",
            "NAME" => 'Список',
            'TYPE' => 'LIST',
            'MULTIPLE' => 'Y',
            'VALUES' => array(5 => 'a', 6 => 'b', 7 => 'c'),
        ),
        "CHECKBOX_PARAM" => array(
            "PARENT" => "BASE",
            "NAME" => 'Галочка',
            "TYPE" => "CHECKBOX",
            "VALUE" => "N",
            "REFRESH" => "N",
        ),*/
        "CACHE_TIME"  =>  Array("DEFAULT"=>3600),
    ),
);
?>
