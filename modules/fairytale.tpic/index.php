<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("Модуль «Ресайзер картинок»");
?>
<div class="main-head">
	<div class="container">
		<div class="row">
			<div class="span12">
				<h1>Модуль «Ресайзер картинок»</h1>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<h2>Описание:</h2>
		<b>Модуль в первую очередь предназачен для разработчиков. <a target="_blank" href="http://marketplace.1c-bitrix.ru/solutions/fairytale.tpic/">Ссылка на модуль в маркетплейсе</a></b> 
		<p>Он позволяет ресайзить уже загруженные в БД картинки, имеет гибкие настройки для ресайза, позволяет оценивать занятое место и в случае надобности очищать его.</p>
		<p>Модуль включает в себя следующие режимы для ресайза:
			<ul>
				<li>portrait - в этом режиме высота изображений подгоняется под заданную, а ширина уменьшается пропорционально.</li> 
				<li>landscape - в этом режиме щирина изображений подгоняется под заданную, а высота уменьшается пропорционально.</li> 
				<li>auto - в этом режиме изображение автоматически подгоняется по большей стороне под заданную ширину/высоту, другая сторона уменьшается пропорционально. <br>Например, для горизонтальных картинок в этом режиме ширина будет равна указанной, а высота будет автоматически рассчитываться.</li> 
				<li>crop - в этом режиме картинка отцентрируется и обрежется под заданную ширину и высоту. <br>Например, если картинка 400х400, а в функции передать ширину = 200 и высоту = 100, то вырежтся центр картинки, размером 200х100.</li>
				<li>
					cropll, cropml, croprl, croprm, croprr, cropmr, croplr, croplm - аналогично кроп, только вырезается не центр картинки, см. изображение ниже:
					<img src="/modules/fairytale.tpic/example-crop-photo.png">
				</li>
			</ul>
		
		
		
		</p>
		Для модуля создается страница в админке, на которой можно ознакомиться с количеством созданных изображений, узнать занятый ими объем или же удалить их:
		<img src="/modules/fairytale.tpic/fairytale-tpic-options.png">
		<h2>Оригинал:</h2>
		<div>
			<img src="<?=CFile::GetPath(25)?>">
		</div>
		<h2>Примеры вызова:</h2>
		<table cellpadding="10">
			<tr>
				<td colspan="2">
					Функция <pre><code>ft\CTPic::resizeImage($picId, $option = 'auto', $newWidth, $newHeight, $returnArray = false);</code></pre>
					Функцию нужно вызывать в атрибуте "src" тега "img" или передавать полученный от нее путь в этот атрибут.
					<ul>
						<li>$picId - id картинки для ресайза</li>
						<li>$option - режим ресайза. (Смотри ниже.)</li>
						<li>$newWidth - новая ширина</li>
						<li>$newHeight - новая высота</li>
						<li>$returnArray - если false, то возвращает путь к картинке, иначе возвращает массив с шириной, высотой и путем картинки.</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td width="40%" valign="top">
					<pre><code>ft\CTPic::resizeImage(25, 'portrait', 200);</code></pre>
				</td>
				<td width="50%">
					<img src="<?=ft\CTPic::resizeImage(25, 'portrait', 200);?>">
				</td>
			</tr>
			<tr>
				<td width="40%" valign="top">
					<pre><code>ft\CTPic::resizeImage(25, 'landscape', 200);</code></pre>
				</td>
				<td width="50%">
					<img src="<?=ft\CTPic::resizeImage(25, 'landscape', 200);?>">
				</td>
			</tr>
			<tr>
				<td width="40%" valign="top">
					<pre><code>ft\CTPic::resizeImage(25, 'auto', 200, 200);</code></pre>
				</td>
				<td width="50%">
					<img src="<?=ft\CTPic::resizeImage(25, 'auto', 200, 200);?>">
				</td>
			</tr>
			<tr>
				<td width="40%" valign="top">
					<pre><code>ft\CTPic::resizeImage(25, 'auto', 400, 200);</code></pre>
				</td>
				<td width="50%">
					<img src="<?=ft\CTPic::resizeImage(25, 'auto', 400, 200);?>">
				</td>
			</tr>
			<tr>
				<td width="40%" valign="top">
					<pre><code>ft\CTPic::resizeImage(25, 'crop', 300, 200);</code></pre>
				</td>
				<td width="50%">
					<img src="<?=ft\CTPic::resizeImage(25, 'crop', 300, 200);?>">
				</td>
			</tr>
			<tr>
				<td width="40%" valign="top">
					<pre><code>ft\CTPic::resizeImage(25, 'cropll', 300, 200);</code></pre>
				</td>
				<td width="50%">
					<img src="<?=ft\CTPic::resizeImage(25, 'cropll', 300, 200);?>">
				</td>
			</tr>
			<tr>
				<td width="40%" valign="top">
					<pre><code>ft\CTPic::resizeImage(25, 'cropml', 300, 200);</code></pre>
				</td>
				<td width="50%">
					<img src="<?=ft\CTPic::resizeImage(25, 'cropml', 300, 200);?>">
				</td>
			</tr>
			<tr>
				<td width="40%" valign="top">
					<pre><code>ft\CTPic::resizeImage(25, 'croprl', 300, 200);</code></pre>
				</td>
				<td width="50%">
					<img src="<?=ft\CTPic::resizeImage(25, 'croprl', 300, 200);?>">
				</td>
			</tr>
			<tr>
				<td width="40%" valign="top">
					<pre><code>ft\CTPic::resizeImage(25, 'croprm', 300, 200);</code></pre>
				</td>
				<td width="50%">
					<img src="<?=ft\CTPic::resizeImage(25, 'croprm', 300, 200);?>">
				</td>
			</tr>
			<tr>
				<td width="40%" valign="top">
					<pre><code>ft\CTPic::resizeImage(25, 'croprr', 300, 200);</code></pre>
				</td>
				<td width="50%">
					<img src="<?=ft\CTPic::resizeImage(25, 'croprr', 300, 200);?>">
				</td>
			</tr>
			<tr>
				<td width="40%" valign="top">
					<pre><code>ft\CTPic::resizeImage(25, 'cropmr', 300, 200);</code></pre>
				</td>
				<td width="50%">
					<img src="<?=ft\CTPic::resizeImage(25, 'cropmr', 300, 200);?>">
				</td>
			</tr>
			<tr>
				<td width="40%" valign="top">
					<pre><code>ft\CTPic::resizeImage(25, 'croplr', 300, 200);</code></pre>
				</td>
				<td width="50%">
					<img src="<?=ft\CTPic::resizeImage(25, 'croplr', 300, 200);?>">
				</td>
			</tr>
			<tr>
				<td width="40%" valign="top">
					<pre><code>ft\CTPic::resizeImage(25, 'croplm', 300, 200);</code></pre>
				</td>
				<td width="50%">
					<img src="<?=ft\CTPic::resizeImage(25, 'croplm', 300, 200);?>">
				</td>
			</tr>
			<tr>
				<td colspan="2">
					Функция <pre><code>ft\CTPic::resizeImageBlock($picId, $option = 'auto', $newWidth, $newHeight, $settings = array());</code></pre>
					Функция выводит блок картинки с прелоадером. Использовать нужно только если на сайте подключена библиотека jQuery.
					<ul>
						<li>$picId - id картинки для ресайза</li>
						<li>$option - режим ресайза.</li>
						<li>$newWidth - новая ширина</li>
						<li>$newHeight - новая высота</li>
						<li>$settings - массив дополнительных настроек.
							<pre><code>
$settings = array(
	'ALT' => 'Альтернативный текст картинки', 
	'TITLE' => 'Тайтл картинки', 
	'CLASSES' => array(
		'DIV' => 'Дополнительный класс (или классы через пробел) для блока, оборачивающего картинку', 
		'IMG' => 'Дополнительный класс (или классы через пробел) для картинки')
	),
);
							</code></pre>
						</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="portfolio-text">	
						<div class="employ-text without-left-margin">
							Скрипт для прелоада изображений подключается автоматически в конце страницы. <br>
							В некоторых случаях он там не нужен (например на ajax страницах). Его подключение можно отключить с помощью константы <b>FAIRYTALE_TPIC_NO_INIT</b>.<br>
							Ее нужно объявить перед подключением пролога (перед подключением header.php или prolog_before.php) или перед подключением самого модуля.<br> Пример для ajax страницы:
							
							<pre><code>
define('FAIRYTALE_TPIC_NO_INIT', true);
require($_SERVER["DOCUMENT_ROOT"] . '/bitrix/modules/main/include/prolog_before.php');
// code here
							</code></pre>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td valign="top" colspan="2">
					<pre><code>
for($i = 0; $i < 30; $i++) {
	echo ft\CTPic::resizeImageBlock(25, 'crop', 200 + $i, 200);
}
					</code></pre>
				</td>
			</tr>
		</table>
	</div>
</div>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>