<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<p>
Сейчас:
Стрим включается после согласия на использование камеры в браузере, при этом сама трансляция расылается по кнопке старт.
Т.е. новые пользователи не увидят стрим, если стример уже нажал старт.

Как должно быть:
Стрим включается только по кнопке старт, если согласие на использование камеры дано.
Подключиться к трасляции может любой человек, при этом его не должно быть видно, а стримера должно быть видно не зависимо от того, нажал он старт до захода пользователя или после.

Так же нужно:
1) Проверить сервер Node.js на нагрузку
2) Посмотреть как писать видео стрима в файл на сервере

</p>

<script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
<script src="https://cdn.socket.io/socket.io-1.2.1.js"></script>
<script src="/webrtc.js"></script>

<video id="localVideo" autoplay muted style="width:40%;"></video>
<video id="remoteVideo" autoplay style="width:40%;"></video>

<br />

<input type="button" id="start" onclick="start(true)" value="Start Video"></input>

<script type="text/javascript">
	pageReady();
</script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>