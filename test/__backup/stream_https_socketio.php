<html>
	<head>
		<meta charset="utf-8">
		<title>chat</title>
		<script src="https://ft-test.ru:8900/socket.io/socket.io.js"></script>
		<script src="https://code.jquery.com/jquery-3.1.0.min.js" charset="utf-8"></script>
		<script src="/adapter.js" charset="utf-8"></script>
	</head>
	<body>
		<?$isStreamer = $_SERVER['REMOTE_ADDR'] == '94.180.2.119' && key_exists('streamer', $_GET) ? true : false;?>
		<video id="video" autoplay></video><br/>
		<?if($isStreamer):?>
			<div>
				<button id="viewButton">Start</button>
				<button id="streamButton">Start stream</button>
			</div>
		<?endif;?>
		<br/>
		<textarea name="name" rows="8" cols="40"></textarea>
		<p></p>
		<!--<input type="text" name="text" size="20">
		<button type="button" name="button">Отправить</button>-->
	</body>
	<?var_dump()?>
	<script type="text/javascript">
		var isStreamer = <?if($isStreamer):?>true<?else:?>false<?endif?>;
		
		var servers = {
			'iceServers': [
				{'urls': 'stun:stun.services.mozilla.com'},
				{'urls': 'stun:stun.l.google.com:19302'},
			]
		};
		
		var userId;
		var stream = null;
		var video = document.getElementById('video');
		
		var port = 8900;
		
		var socket = io.connect('https://ft-test.ru:' + port);
		/*
		socket.on('userName', function(userName){ // Создаем прослушку 'userName' и принимаем переменную name в виде аргумента 'userName'
			console.log('You\'r username is => ' + userName); // Логгирование в консоль браузера
			$('textarea').val($('textarea').val() + 'You\'r username => ' + userName + '\n'); // Выводим в поле для текста оповещение для подключенного с его ником
		});

		socket.on('newUser', function(userName){ // Думаю тут понятно уже =)
			console.log('New user has been connected to chat | ' + userName); // Логгирование
			$('textarea').val($('textarea').val() + userName + ' connected!\n'); // Это событие было отправлено всем кроме только подключенного, по этому мы пишем другим юзерам в поле что 'подключен новый юзер' с его ником
		});
		*/
		
		peerConnection = new RTCPeerConnection(servers);
		
		peerConnection.onicecandidate = gotIceCandidate;
		peerConnection.onaddstream = gotRemoteStream;
		
		socket.on('userId', function(userId) {
			console.log('userId', userId);
			window.userId = userId
		});
		
		socket.on('iceCandidate', function(data) {
			
			if(data.userId == userId) return;
			
			peerConnection.addIceCandidate(new RTCIceCandidate(data.ice)).catch(errorHandler);
		});
		
		socket.on('setLocalDescription', function(data) {
			
			if(data.userId == userId) return;
			
			peerConnection.setRemoteDescription(new RTCSessionDescription(data.sdp)).then(function() {
				// Only create answers in response to offers
				if(data.sdp.type == 'offer') {
					peerConnection.createAnswer().then(createdDescription).catch(errorHandler);
				}
			}).catch(errorHandler);
		});
		
		var getUserMediaSuccess = function(stream) {
			window.stream = stream;
			video.srcObject = stream;
			console.log(video.srcObject, typeof(video.srcObject));
			if(video.srcObject != undefined && typeof(video.srcObject) == 'object' && video.srcObject !== null) {
				$('#viewButton').text('Stop');
			} else {
				$('#viewButton').text('Start');
			}
		}
		
		var errorHandler = function(error) {
			console.error(error);
		}
		
		
		
		function gotIceCandidate(event) {
			if(event.candidate != null) {
				socket.emit('iceCandidate', {'ice': event.candidate, 'userId': userId});
			}
		}
		
		function createdDescription(description) {
			console.log('got description');

			peerConnection.setLocalDescription(description).then(function() {
				socket.emit('setLocalDescription', {'sdp': peerConnection.localDescription, 'userId': userId});
			}).catch(errorHandler);
		}
		
		function gotRemoteStream(event) {
			console.log(event);
			console.log('got remote stream');
			video.src = window.URL.createObjectURL(event.stream);
			//remoteVideo.src = event.stream;
		}
		
		/*var uuid = function() {
			function s4() {
				return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
			}

			return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
		}*/
		
		$(function() {
			
			//userId = uuid();
			
			$('#viewButton').on('click', function(e) {
				
				e.preventDefault();
				
				if(video.srcObject != undefined && typeof(video.srcObject) == 'object' && video.srcObject !== null) {
					window.stream.getAudioTracks().forEach(function(track) {
						track.stop();
					});

					window.stream.getVideoTracks().forEach(function(track) {
						track.stop();
					});
					window.stream = null;
					video.srcObject = null;
					$(this).text('Start');
					return true;
				} else {
					var constraints = {
						video: true,
						audio: false,
					};
				}

				if(navigator.mediaDevices.getUserMedia) {
					navigator.mediaDevices.getUserMedia(constraints).then(getUserMediaSuccess).catch(errorHandler);
				} else {
					console.error('Your browser does not support getUserMedia API');
				}
			});
			
			$('#streamButton').on('click', function(e) {
				e.preventDefault();
				if(window.stream == null) {
					return false;
				}
				
				//console.log(window.stream);
				
				peerConnection.addStream(window.stream);
				peerConnection.createOffer().then(createdDescription).catch(errorHandler);
				
			});
			
			<?if(!$isStreamer):?>
				//peerConnection.createOffer().then(createdDescription).catch(errorHandler);
			<?endif;?>
		});
		

	</script>
</html>