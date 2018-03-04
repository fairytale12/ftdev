<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/blog/post/([a-zA-Z0-9\\.\\-_]+)/?.*#",
		"RULE" => "ELEMENT_CODE=\$1",
		"PATH" => "/blog/post.php",
	),
	array(
		"CONDITION" => "#^/blog/([a-zA-Z\\.\\-_]+)/?.*#",
		"RULE" => "SECTION_CODE=\$1",
		"PATH" => "/blog/index.php",
	),
	array(
		"CONDITION" => "#^/online/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#",
		"RULE" => "alias=\$1",
		"ID" => "bitrix:im.router",
		"PATH" => "/desktop_app/router.php",
	),
	array(
		"CONDITION" => "#^/bitrix/services/ymarket/#",
		"RULE" => "",
		"ID" => "",
		"PATH" => "/bitrix/services/ymarket/index.php",
	),
	array(
		"CONDITION" => "#^/online/(/?)([^/]*)#",
		"RULE" => "",
		"ID" => "bitrix:im.router",
		"PATH" => "/desktop_app/router.php",
	),
	array(
		"CONDITION" => "#^/personal/lists/#",
		"RULE" => "",
		"ID" => "bitrix:lists",
		"PATH" => "/personal/lists/index.php",
	),
);

?>