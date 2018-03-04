<html>
  <head>
    <meta charset="utf-8">
    <title>chat</title>
    <script src="https://ft-test.ru:8900/socket.io/socket.io.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.0.min.js" charset="utf-8"></script>
	<script>
		var port = 8900;
		var socket = io.connect('https://ft-test.ru:' + port);
		
		socket.on('userName', function(userName){ // Создаем прослушку 'userName' и принимаем переменную name в виде аргумента 'userName'
			console.log('You\'r username is => ' + userName); // Логгирование в консоль браузера
			$('textarea').val($('textarea').val() + 'You\'r username => ' + userName + '\n'); // Выводим в поле для текста оповещение для подключенного с его ником
		});

		socket.on('newUser', function(userName){ // Думаю тут понятно уже =)
			console.log('New user has been connected to chat | ' + userName); // Логгирование
			$('textarea').val($('textarea').val() + userName + ' connected!\n'); // Это событие было отправлено всем кроме только подключенного, по этому мы пишем другим юзерам в поле что 'подключен новый юзер' с его ником
		});
	</script>
  </head>
  <body>
    <textarea name="name" rows="8" cols="40"></textarea>
    <p></p>
    <input type="text" name="text" size="20">
    <button type="button" name="button">Отправить</button>
  </body>
</html>