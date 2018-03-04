<html>
	<head>
		<script src="https://ftdev.ru:8900/socket.io/socket.io.js"></script>
		<script
		  src="https://code.jquery.com/jquery-3.1.1.min.js"
		  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
		  crossorigin="anonymous"></script>
		<style>
			body {
				width: 850px;
				margin: 0 auto;
			}
		  
			#ready-btn {
				padding: 10px 15px; 
				border-radius: 15px; 
				border: none; 
				cursor: pointer; 
				width: 100px;
				color: #fff;
				font-weight: bold;
			}
		  
			.not-ready {
				background-color: #ff6666;
			}
			.ready {
				background-color: #b3ffb3;
			}
			
			.gamer-status {
				display: inline-block;
				width: 15px;
				height: 15px;
				background: #ccc;
			}
			
			.gamer-status-not-ready {
				background: #ff6666;
			}
			
			.gamer-status-ready {
				background: #b3ffb3;
			}
			
			#canvas {
				cursor: none;
				border: 1px solid #000;
			}
			
		</style>
	</head>
	<body>
		<div id="game-info">
			<canvas id="canvas" style="float: left;"></canvas>
			<div style="float: left; margin: 0 0 0 40px;">
				<div>Вы: <span id="you"></span></div>
				<div id="ready-block">
					<div>
						<i>Готовность игроков</i>:<br/>
						<ul>
							<li>Игрок 1: <div id="gamer1-status" class="gamer-status"></li>
							<li>Игрок 2: <div id="gamer2-status" class="gamer-status"></li>
						</ul>
					</div>
					<button id="ready-btn" class="not-ready" style="display: none;">Не готов</button>
				</div>
			</div>
		</div>
		
		<script type="text/javascript">
			var port = 8900;
			var socket = io.connect('https://ftdev.ru:' + port);
		
		
			//BEGIN LIBRARY CODE
			var x = false;
			var y = false;
			//var dx = 1.5;
			//var dy = -4;
			var WIDTH;
			var HEIGHT;
			var ctx;
			
			var paddlex;
			var paddleh;
			var paddlew;
			var paddle2x;
			var paddle2h;
			var paddle2w;
			var intervalId;
			
			var canvasMinX;
			var canvasMaxX;
			
			var bricks;
			var NROWS;
			var NCOLS;
			var BRICKWIDTH;
			var BRICKHEIGHT;
			var PADDING;
			
			var ballr;
			var rowcolors = ["#FF1C0A", "#FFFD0A", "#00A308", "#0008DB", "#EB0093"];
			var paddlecolor = "#FFFFFF";
			var paddle2color = "#FF0000";
			var ballcolor = "#FFFFFF";
			var backcolor = "#000000";
			var allReady = false;
			var userId = false;
			
			var isGamer = false;
			var ready = false;
			var isEnd = true;

			//set rightDown or leftDown if the right or left keys are down
			
			function init() {
			  ctx = $('#canvas')[0].getContext("2d");
			  WIDTH = $("#canvas").width();
			  HEIGHT = $("#canvas").height();
			}
			 
			function circle(x,y,r) {
			  ctx.beginPath();
			  ctx.arc(x, y, r, 0, Math.PI*2, true);
			  ctx.closePath();
			  ctx.fill();
			}
			 
			function rect(x,y,w,h) {
			  ctx.beginPath();
			  ctx.rect(x,y,w,h);
			  ctx.closePath();
			  ctx.fill();
			}
			 
			function clear() {
				ctx.clearRect(0, 0, WIDTH, HEIGHT);
				rect(0,0,WIDTH,HEIGHT);
			}
			 
			function draw() {
				ctx.fillStyle = backcolor;
				clear();
				if(x && y) {
					ctx.fillStyle = ballcolor;
					circle(x, y, ballr);
					//ctx.fillStyle = '#00FF00';
					//circle(x, y, 1);
				}

				  
				ctx.fillStyle = paddlecolor;
				rect(paddlex, HEIGHT-paddleh, paddlew, paddleh);
				ctx.fillStyle = paddle2color;
				rect(paddle2x, 0, paddle2w, paddle2h);

			}
			
			function drawText(i, text, fillStyle) {
				setTimeout(function() {
					//console.log('drawText start ' + i);
					ctx.fillStyle = backcolor;
					clear();
					ctx.textBaseline = 'middle';
					ctx.textAlign = 'center';
					if(!!fillStyle) {
						//ctx.strokeStyle = fillStyle;
						ctx.fillStyle = fillStyle;
					}
					ctx.font = 'bold ' + 6 * i + 'px sans-serif';
					ctx.fillText(text, WIDTH/2, HEIGHT/2);
				}, i * 100);
					
			}
			
			function showWin() {
				for(var i = 0; i < 10; i++) {
					drawText(i, 'Win :)', '#0F0');
				}
			}
			
			function showLose() {
				for(var i = 0; i < 10; i++) {
					drawText(i, 'Lose :(', '#F00');
				}
			}
			
			socket.on('params', function(params) {
				//console.log('params', params);
				
				var canvasArea = $('#canvas')[0];
				canvasArea.width = params['width'];
				canvasArea.height = params['height'];
				
				ballr = params['ballr'];
				
				paddleh = paddle2h = params['paddleh'];
				paddlew = paddle2w = params['paddlew'];
				paddlex = params['paddlex'];
				paddle2x = params['paddle2x'];
				
				init();
				draw();
			});
			
			socket.on('userId', function(userId) {
				//console.log('userId', userId);
				window.userId = userId
			});
			
			socket.on('youAreGamer', function(number) {
				$('#ready-btn').show();
				$('#you').html('<b>Игрок ' + number + '</b>');
				isGamer = number;
				socket.emit('ready', {'ready': ready, 'userId': userId});
				//console.log('youAreGamer', number);
				
				init_mouse();
				$('#game-info #ready-block #ready-btn').on('click', function(e) {
					//console.log('click');
					if($(this).hasClass('not-ready')) {
						
						socket.emit('ready', {'ready': true, 'userId': userId});
						$(this).removeClass('not-ready').addClass('ready').text('Готов');
					} else {
						
						socket.emit('ready', {'ready': false, 'userId': userId});
						$(this).addClass('not-ready').removeClass('ready').text('Не готов');
					}
				});
				
				
				
				function onKeyDown(evt) {
					//if (evt.keyCode == 39) rightDown = true;
					//else if (evt.keyCode == 37) leftDown = true;
					if(isEnd) {
						return false;
					}

					if (evt.keyCode == 39) {
						socket.emit('update', {'userId': userId, 'paddlex': paddlex + 25});
					}
					else if (evt.keyCode == 37) {
						socket.emit('update', {'userId': userId, 'paddlex': paddlex - 25});
					}
				}

				//and unset them when the right or left key is released
				/*function onKeyUp(evt) {
				  if (evt.keyCode == 39) rightDown = false;
				  else if (evt.keyCode == 37) leftDown = false;
				}*/

				$(document).keydown(onKeyDown);
				//$(document).keyup(onKeyUp);
				


				function init_mouse() {
				  canvasMinX = $("#canvas").offset().left;
				  canvasMaxX = canvasMinX + WIDTH;
				}

				function onMouseMove(evt) {
					if(isEnd) {
						return false;
					}
					
					if (evt.pageX > canvasMinX && evt.pageX < canvasMaxX) {
					//paddlex = evt.pageX - canvasMinX;
						socket.emit('update', {'userId': userId, 'paddlex': evt.pageX - canvasMinX});
					}
				}

				$(document).mousemove(onMouseMove);
				
			});
			
			socket.on('youAreViewer', function(userId) {
				$('#ready-btn').remove();
				$('#you').html('<i>Зритель</i>');
				//console.log('youAreViewer', userId);
				
			});
			
			socket.on('endGameStatus', function(gameStatus) {
				if(gameStatus == 'win') {
					isEnd = true;
					showWin();
				} else if(gameStatus == 'lose') {
					isEnd = true;
					showLose();
				}
				//console.log(gameStatus);
			});
			
			
			
			/*socket.on('areYouReady', function(userId) {
				console.log('areYouReady', userId);
				
			});*/
			
			socket.on('ready', function(data) {
				if(data.gamer1 != undefined) {
					if(data.gamer1.ready) {
						$('#gamer1-status').removeClass('gamer-status-not-ready').addClass('gamer-status-ready');
						if(isGamer == 1) {
							ready = true;
						}
					} else {
						$('#gamer1-status').addClass('gamer-status-not-ready').removeClass('gamer-status-ready');
						if(isGamer == 1) {
							ready = false;
							$('#game-info #ready-block #ready-btn').removeClass('ready').addClass('not-ready').text('Не готов');;
						}
					}
				} else {
					$('#gamer1-status').removeClass('gamer-status-not-ready').removeClass('gamer-status-ready');
				}
				
				if(data.gamer2 != undefined) {
					if(data.gamer2.ready) {
						$('#gamer2-status').removeClass('gamer-status-not-ready').addClass('gamer-status-ready');
						if(isGamer == 2) {
							ready = true;
						}
					} else {
						$('#gamer2-status').addClass('gamer-status-not-ready').removeClass('gamer-status-ready');
						if(isGamer == 2) {
							ready = false;
							$('#game-info #ready-block #ready-btn').removeClass('ready').addClass('not-ready').text('Не готов');;
						}
					}
				} else {
					$('#gamer2-status').removeClass('gamer-status-not-ready').removeClass('gamer-status-ready');
				}
			});
			
			socket.on('update', function(data) {
				//console.log('update', data);
				
				if(data.gamer1 != undefined) {		
					if(data.gamer1.paddlex != undefined) {
						//console.log(data.gamer2.paddlex, isGamer)
						if(isGamer == 1) {
							paddlex = data.gamer1.paddlex;
						} else if(isGamer == 2) {
							paddle2x = WIDTH - paddle2w - data.gamer1.paddlex;
						}
					}
					
				}
				
				if(data.gamer2 != undefined) {
					if(data.gamer2.paddlex != undefined) {
						if(isGamer == 2) {
							paddlex = data.gamer2.paddlex;
						} else if(isGamer == 1) {
							paddle2x = WIDTH - paddle2w - data.gamer2.paddlex;
						}
					}
					
				}
				
				if(data.ball != undefined) {
					isEnd = false;
					if(isGamer == 2) {
						x = WIDTH - data.ball.x;
						y = HEIGHT - data.ball.y;
					} else {
						x = data.ball.x;
						y = data.ball.y;
					}
				}
				
				if(!isEnd) {
					draw();
				}
				
				//console.log(paddlex, paddle2x);
				
			});
		</script>
	</body>
</html>