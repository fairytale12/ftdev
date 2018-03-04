var socket;

var init = function () {		
	socket = new WebSocket('wss://ft-test.ru/chat/push/');

	socket.onopen = connectionOpen; 
	socket.onmessage = messageReceived;
	console.log('wss');
};


function connectionOpen() {
  
}

function messageReceived(e) {

	var arData = JSON.parse(e.data);

	if(arData['message'] != undefined) {
		switch(arData['type']) {
			case 'system-notify':
			
				var htmlMessage = '';
				
				if(arData['notify']['fromAvatar'] != undefined && arData['notify']['fromAvatar'].trim() != '') {
					htmlMessage += '<img src="' + arData['notify']['fromAvatar'].trim() + '" />';
				}
				
				if(arData['notify']['from'] != undefined && arData['notify']['from'].trim() != '') {
					htmlMessage += '<div class="holly-notify-name">' + arData['notify']['from'].trim() + ':</div>';
				}
				
				if(htmlMessage != '') {
					htmlMessage = '<div class="holly-notify-user-block' + (htmlMessage != '' ? ' has-avatar': '') + '">' + htmlMessage + '</div>';
				}
				
				htmlMessage += '<div class="holly-notify-text-block">' + arData['message'] + '</div>';
				addHollyNotify(htmlMessage, arData['notify']['type'], arData['notify']['duration'], arData['notify']['autoHide']);
				//document.getElementById("sock-info").innerHTML += ('<b>' + arData['userFrom'] + '</b>: ' + arData['message']+"<br />");
				break;
			
			default:
				//addHollyNotify(e.data, 'default');
				//document.getElementById("sock-info").innerHTML += ('<b>' + arData['userFrom'] + '</b>: ' + arData['message']+"<br />");
		}
		console.log(arData);
		
		
	}
}


function connectionClose() {
	socket.close();
}

init();
