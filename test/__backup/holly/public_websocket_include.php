<!--<script src="https://js.pusher.com/3.2/pusher.min.js"></script>-->
<style>
	#holly-notifies-block {
		position: fixed;
		bottom: 0;
		right: 30px;
		width: 300px;
		z-index: 9000;
	}
	
	#holly-notifies-block .holly-notify-block {
		border-radius: 0;
		border: none;
		border-left: 6px solid transparent;
		color: #333;
		background-color: #fefefe;
		-webkit-box-shadow: 0px 3px 2px 0px rgba(0, 0, 0, 0.05);
		-moz-box-shadow: 0px 3px 2px 0px rgba(0, 0, 0, 0.05);
		box-shadow: 0px 3px 2px 0px rgba(0, 0, 0, 0.05);
		
		padding: 15px;
		margin-bottom: 20px;
		
		font-family: "Roboto", Arial, sans-serif;
		font-size: 15px;
		min-width: 270px;
		line-height: 1.42857143;
		font-weight: 400;
	}
	
	#holly-notifies-block .holly-notify-block.holly-notify-warning {
		border-left-color: #F6BB42;
	}
	
	#holly-notifies-block .holly-notify-block.holly-notify-danger {
		border-left-color: #E9573F;
	}
	
	#holly-notifies-block .holly-notify-block.holly-notify-success {
		border-left-color: #8CC152;
	}
	
	#holly-notifies-block .holly-notify-block .holly-notify-close {
	    -webkit-appearance: none;
		padding: 0;
		cursor: pointer;
		background: 0 0;
		border: 0;
		float: right;
		font-size: 21px;
		font-weight: 700;
		line-height: 1;
		color: #000;
		text-shadow: 0 1px 0 #fff;
		filter: alpha(opacity=20);
		opacity: .2;
	
	}
	
	#holly-notifies-block .holly-notify-block .holly-notify-user-block {
		margin: 0 0 10px 0;
	}
	
	#holly-notifies-block .holly-notify-block .holly-notify-user-block img {
		width: 32px;
		height: 32px;
		margin: 0 7px 0 0;
	}
	
	#holly-notifies-block .holly-notify-block .holly-notify-user-block.has-avatar .holly-notify-name {
		margin: 5px 0 0 0;
		display: inline-block;
		vertical-align: top
	}
	
	#holly-notifies-block .holly-notify-block .holly-notify-text-block {
		font-style: italic;
	}
	
</style>

<div id="holly-notifies-block"></div>

<button id='subscriptionButton' disabled=true></button>
<div id="debug"></div>

<button onclick="return sendMessage();">Send all!</button>

<!--<link rel="manifest" href="/holly/holly-public.js">-->
<script type="text/javascript">
	"use strict";
	
	var addHollyNotify = function(text, type, duration, autoHide) {
		
		if(type == undefined) {
			type = 'warning';
		}
		
		if(duration == undefined) {
			duration = 120000;
		}
		
		if(autoHide == undefined) {
			autoHide = true;
		}
		
		if($('#holly-notifies-block').length) {
			
			/*
			types:
				warning
				danger
				success 
			*/
			
			var block = 
				'<div class="holly-notify-block holly-notify-' + type + '">' +
				'<button type="button" class="holly-notify-close">×</button>' + text + '</div>';

			$('#holly-notifies-block').prepend(block);
			
			var thisBlock = $('#holly-notifies-block .holly-notify-block:first');
			
			if(autoHide) {
			
				setTimeout(
					function() {
						thisBlock.fadeOut(
							500, 
							function() {
								$(this).remove();
							}
						);
					}, 
					duration
				);
				
			}
		}
	}
	
	$(document).on('click', '#holly-notifies-block .holly-notify-block .holly-notify-close', function(e) {
		e.preventDefault();
		$(this).closest('.holly-notify-block').fadeOut(500, function() {
			$(this).remove();
		});
	});
	
	var socket;
	$(function () {

		var init = function () {		
			socket = new WebSocket('wss://ft-test.ru/chat/push/');

			socket.onopen = connectionOpen; 
			socket.onmessage = messageReceived;
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
				
				
				
			}
		}
		
		
		function connectionClose() {
			socket.close();
		}
		
		//init();
		
	});
	
	/*Pusher.logToConsole = true;

	var pusher = new Pusher('50c291e4ed934f698149', {
		cluster: 'eu',
		encrypted: true
	});

	var channel = pusher.subscribe('holly-channel');
	channel.bind('my-event', function(data) {
		console.log(data.message);
	});*/
	
	
	/*
	if ('serviceWorker' in navigator) {
		navigator.serviceWorker.register('/holly/sw.js');
		Notification.requestPermission('Братишка, хочешь подписаться?');
	}

	function showNotification() {
		Notification.requestPermission(function(result) {
			if (result === 'granted') {
				navigator.serviceWorker.ready.then(function(registration) {
					console.log('Buzz! Buzz!');
					registration.showNotification('Vibration Sample', {
						body: 'Buzz! Buzz!',
						icon: '/holly/holly.jpg',
						vibrate: [200, 100, 200, 100, 200, 100, 200],
						tag: 'vibration-sample'
					});
				}).catch(function(error) {
					console.log('ERROR: ' + error);
				});
			}
		});
	}
	*/

	
	
	
	
	
	
	
/*if ('serviceWorker' in navigator) {
	navigator.serviceWorker.register('/holly/sw.js').then(function (registration) {
		console.log('ServiceWorker registration', registration);
		
		
		
	}).catch(function(err) {
		console.log('Не могу подключить воркер: ' + err);
	});
}*/
/*
var endpoint;
if ('serviceWorker' in navigator) {
	console.log('serviceWorker in navigator');
	navigator.serviceWorker.register('/holly/sw.js').then(function(registration) {
		console.log('serviceWorker.register');
		return registration.pushManager.getSubscription().then(function(subscription) {

			if (subscription) {
				console.log('subscription', subscription);
				return subscription;
			}
			console.log('pushManager.subscribe');
			
			// const subscribeOptions = {
				// userVisibleOnly: false,
				// applicationServerKey: new Uint8Array(['AAAALAXED1s:APA91bFE0qAvxzzJZS1j1lx7wV4IOL5rnp_ZUP31MRYNeeI13JM2_gDkcJwXt01NVxzV4qS4zT6gMul30a9tyHn2Pm7xPMdC4ZFd8ScfhBUzZyviZRuKQ-QYDU3TZYk3x_yl11HgaVoj'
				// ])
			// };
			// return registration.pushManager.subscribe(subscribeOptions);
		});
	}).then(function(subscription) {
		//endpoint = subscription.endpoint;
		//console.log('endpoint', endpoint);
	});
}

console.log(endpoint);
*/


/*
function notifyRequestPermission(permission) {
    if( permission != 'granted' ) {
		return false;
	}
    var notify = new Notification('Братишка! Спасибо за подпиську!');
};

if (!('Notification' in window)) {
	console.log('Братишка!!! Уведомления не поддерживаются браузером');
} else if (Notification.permission === 'granted') {
	
	console.log('Братишка! Уведомления поддерживаются браузером!');
	
	//var localUserSettings = new LocalUserSettings(loggedInUser);
	//if (localUserSettings.notificationRights == 'granted') {
		try {
			var notification = new Notification('[ONLINE] Уведомление', {
				body: 'Братишка! Пришло уведомление из браузера!',
				icon: '/holly/holly.jpg',
				lang: 'ru',
				tag: 'kyrlik'
			});
			setTimeout(function () {
				notification.close();
			}, 10000);
		} catch (e) {
			console.log('[ONLINE] ERROR: ' + e);
			
		}
		try {
			
			// if ('serviceWorker' in navigator) {
				// navigator.serviceWorker.register('/holly/sw.js').then(function (registration) {
					// registration.showNotification('[OFFLINE] Уведомление', {
						// body: 'Братишка! Пришло уведомление из браузера!',
						// icon: '/holly/holly.jpg',
						// vibrate: [200, 100, 200, 100, 200, 100, 200],
						// tag: 'kyrlik'
					// });
				// });
			// }
		} catch (e) {
			console.log('[OFFLINE] ERROR: ' + e);
		}
		
	//}
} else {
	Notification.requestPermission(notifyRequestPermission);
	console.log('Братишка! Попроси!');
}
*/

/*
document.addEventListener('hello', function(event) {
	console.log('hello!', event);

});
var event = new Event('hello', {
	bubbles: true,
	cancelable: true
});
*/
/*
var isPushEnabled = false;

window.addEventListener('load', function() {  
  var pushButton = document.querySelector('.js-push-button');  
  pushButton.addEventListener('click', function() {  
    if (isPushEnabled) {  
      unsubscribe();  
    } else {  
      subscribe();  
    }  
  });

  // Check that service workers are supported, if so, progressively  
  // enhance and add push messaging support, otherwise continue without it.  
  if ('serviceWorker' in navigator) {  
    navigator.serviceWorker.register('/holly/sw.js')  
    .then(initialiseState);  
  } else {  
    console.warn('Service workers aren\'t supported in this browser.');  
  }  
});

// Once the service worker is registered set the initial state  
function initialiseState(registration) {  

	console.log('ServiceWorker registration', registration);
	
	registration.pushManager.subscribe().then(
      function(pushSubscription) {
        console.log(pushSubscription.subscriptionId);
        console.log(pushSubscription.endpoint);
        // The push subscription details needed by the application
        // server are now available, and can be sent to it using,
        // for example, an XMLHttpRequest.
      }, function(error) {
        // During development it often helps to log errors to the
        // console. In a production environment it might make sense to
        // also report information about errors back to the
        // application server.
        console.log(error);
      }
    );
	
  // Are Notifications supported in the service worker?  
  if (!('showNotification' in ServiceWorkerRegistration.prototype)) {  
    console.warn('Notifications aren\'t supported.');  
    return;  
  }

  // Check the current Notification permission.  
  // If its denied, it's a permanent block until the  
  // user changes the permission  
  if (Notification.permission === 'denied') {  
    console.warn('The user has blocked notifications.');  
    return;  
  }

  // Check if push messaging is supported  
  if (!('PushManager' in window)) {  
    console.warn('Push messaging isn\'t supported.');  
    return;  
  }
	
	console.log('initialiseState'); 
	
  // We need the service worker registration to check for a subscription  
  navigator.serviceWorker.ready.then(function(serviceWorkerRegistration) {  
    // Do we already have a push message subscription?  
	console.log('serviceWorker ready'); 
    serviceWorkerRegistration.pushManager.getSubscription()  
      .then(function(subscription) {  
        // Enable any UI which subscribes / unsubscribes from  
        // push messages.  
        var pushButton = document.querySelector('.js-push-button');  
        pushButton.disabled = false;
		console.log('pushManager then'); 
        if (!subscription) {  
          // We aren't subscribed to push, so set UI  
          // to allow the user to enable push  
          return;  
        }

        // Keep your server in sync with the latest subscriptionId
        sendSubscriptionToServer(subscription);

        // Set your UI to show they have subscribed for  
        // push messages  
        pushButton.textContent = 'Disable Push Messages';  
        isPushEnabled = true;  
		console.log('isPushEnabled true'); 
      })  
      .catch(function(err) {  
        console.warn('Error during getSubscription()', err);  
      });  
  });  
}


function subscribe() {  
  // Disable the button so it can't be changed while  
  // we process the permission request  
  var pushButton = document.querySelector('.js-push-button');  
  pushButton.disabled = true;

  navigator.serviceWorker.ready.then(function(serviceWorkerRegistration) {  
    serviceWorkerRegistration.pushManager.subscribe()  
      .then(function(subscription) {  
        // The subscription was successful  
        isPushEnabled = true;  
        pushButton.textContent = 'Disable Push Messages';  
        pushButton.disabled = false;

        // TODO: Send the subscription.endpoint to your server  
        // and save it to send a push message at a later date
        return sendSubscriptionToServer(subscription);  
      })  
      .catch(function(e) {  
        if (Notification.permission === 'denied') {  
          // The user denied the notification permission which  
          // means we failed to subscribe and the user will need  
          // to manually change the notification permission to  
          // subscribe to push messages  
          console.warn('Permission for Notifications was denied');  
          pushButton.disabled = true;  
        } else {  
          // A problem occurred with the subscription; common reasons  
          // include network errors, and lacking gcm_sender_id and/or  
          // gcm_user_visible_only in the manifest.  
          console.error('Unable to subscribe to push.', e);  
          pushButton.disabled = false;  
          pushButton.textContent = 'Enable Push Messages';  
        }  
      });  
  });  
}

function unsubscribe() {  
  var pushButton = document.querySelector('.js-push-button');  
  pushButton.disabled = true;

  navigator.serviceWorker.ready.then(function(serviceWorkerRegistration) {  
    // To unsubscribe from push messaging, you need get the  
    // subscription object, which you can call unsubscribe() on.  
    serviceWorkerRegistration.pushManager.getSubscription().then(  
      function(pushSubscription) {  
        // Check we have a subscription to unsubscribe  
        if (!pushSubscription) {  
          // No subscription object, so set the state  
          // to allow the user to subscribe to push  
          isPushEnabled = false;  
          pushButton.disabled = false;  
          pushButton.textContent = 'Enable Push Messages';  
          return;  
        }

        var subscriptionId = pushSubscription.subscriptionId;  
        // TODO: Make a request to your server to remove  
        // the subscriptionId from your data store so you
        // don't attempt to send them push messages anymore

        // We have a subscription, so call unsubscribe on it  
        pushSubscription.unsubscribe().then(function(successful) {  
          pushButton.disabled = false;  
          pushButton.textContent = 'Enable Push Messages';  
          isPushEnabled = false;  
        }).catch(function(e) {  
          // We failed to unsubscribe, this can lead to  
          // an unusual state, so may be best to remove
          // the users data from your data store and
          // inform the user that you have done so

          console.log('Unsubscription error: ', e);  
          pushButton.disabled = false;
          pushButton.textContent = 'Enable Push Messages';
        });  
      }).catch(function(e) {  
        console.error('Error thrown while unsubscribing from push messaging.', e);  
      });  
  });  
}
*/

(function(console){

console.save = function(data, filename){

    if(!data) {
        console.error('Console.save: No data')
        return;
    }

    if(!filename) filename = 'console.json'

    if(typeof data === "object"){
        data = JSON.stringify(data, undefined, 4)
    }

    var blob = new Blob([data], {type: 'text/json'}),
        e    = document.createEvent('MouseEvents'),
        a    = document.createElement('a')

    a.download = filename
    a.href = window.URL.createObjectURL(blob)
    a.dataset.downloadurl =  ['text/json', a.download, a.href].join(':')
    e.initMouseEvent('click', true, false, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null)
    a.dispatchEvent(e)
 }
})(console)

// [Working example](/push-subscription-management_demo.html).

var subscriptionButton = document.getElementById('subscriptionButton');

// As subscription object is needed in few places let's create a method which
// returns a promise.
function getSubscription() {
	console.log('getSubscription');
	console.log('ready', navigator.serviceWorker.ready);
  return navigator.serviceWorker.ready
    .then(function(registration) {
		console.log('navigator.serviceWorker.ready', registration);
		return registration.pushManager.getSubscription();
    }).catch(function(e) {
		console.log('navigator.serviceWorker.ready catch: ' + e);
	});
}

// Register service worker and check the initial subscription state.
// Set the UI (button) according to the status.

function debug(text) {
	document.getElementById('debug').innerHTML = text;
}

console.log('serviceWorker');
debug('serviceWorker');
if ('serviceWorker' in navigator) {
	console.log('serviceWorker in navigator');
	debug('serviceWorker in navigator');
  navigator.serviceWorker.register('/sw.js')
    .then(function() {
      console.log('service worker registered');
	  debug('service worker registered');
      subscriptionButton.removeAttribute('disabled');
    });
  getSubscription()
    .then(function(subscription) {
      if (subscription) {
        console.log('Already subscribed', subscription.endpoint);
        setUnsubscribeButton();
      } else {
		console.log('need subscribe');
        setSubscribeButton();
      }
    });
}

// Get the `registration` from service worker and create a new
// subscription using `registration.pushManager.subscribe`. Then
// register received new subscription by sending a POST request with its
// endpoint to the server.
function subscribe() {
  navigator.serviceWorker.ready.then(function(registration) {
    return registration.pushManager.subscribe({ userVisibleOnly: true });
  }).then(function(subscription) {
    console.log('Subscribed', subscription.endpoint);
    console.log('Subscribed', subscription);
		
		//var sss = new Uint8Array(subscription.getKey('p256dh'));
		//console.log(sss, sss.length)
	
    return fetch('/web-push/', {
		credentials: 'same-origin',
      method: 'post',
      headers: {
        'Content-type': 'application/json',
      },
      body: JSON.stringify({
        endpoint: subscription.endpoint,
		auth: btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('auth')))).replace(/\+/g, '-').replace(/\//g, '_'),
		p256dh: btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('p256dh')))).replace(/\+/g, '-').replace(/\//g, '_'),
		method: 'register'
      })
    });
  }).then(setUnsubscribeButton);
}

// Get existing subscription from service worker, unsubscribe
// (`subscription.unsubscribe()`) and unregister it in the server with
// a POST request to stop sending push messages to
// unexisting endpoint.
	function unsubscribe() {
		getSubscription().then(function (subscription) {
			return subscription.unsubscribe()
				.then(function () {
					console.log('Unsubscribed', subscription.endpoint);
					return fetch('/web-push/', {
						method: 'post',
						headers: {
							'Content-type': 'application/json'
						},
						body: JSON.stringify({
							endpoint: subscription.endpoint,
							auth: btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('auth'))))
								.replace(/\+/g, '-').replace(/\//g, '_'),
							p256dh: btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('p256dh'))))
								.replace(/\+/g, '-').replace(/\//g, '_'),
							method: 'unregister'
						})
					});
				});
		}).then(setSubscribeButton);
	}

// Change the subscription button's text and action.
function setSubscribeButton() {
	  subscriptionButton.onclick = subscribe;
	  subscriptionButton.textContent = 'Subscribe!';
}

function setUnsubscribeButton() {
  	subscriptionButton.onclick = unsubscribe;
  	subscriptionButton.textContent = 'Unsubscribe!';
}


function sendMessage() {
	fetch('/web-push/', {
		credentials: 'same-origin',
		method: 'post',
		headers: {
			'Content-type': 'application/json',
		},
		body: JSON.stringify({
			'method': 'push',
			'payload': {
				'title': 'Акция на выходные дни!',
				'body': 'Скидка 5% на все товары!',
				'data': {
					'onclick': '/personal/'
				},
			}
		})
    });
	
	return false;
}

	function cBrowser() {
		var ua = navigator.userAgent;
		var bName = function () {
			if (ua.search(/MSIE/) > -1) return "ie";
			if (ua.search(/Firefox/) > -1) return "firefox";
			if (ua.search(/Opera/) > -1) return "opera";
			if (ua.search(/Chrome/) > -1) return "chrome";
			if (ua.search(/Safari/) > -1) return "safari";
			if (ua.search(/Konqueror/) > -1) return "konqueror";
			if (ua.search(/Iceweasel/) > -1) return "iceweasel";
			if (ua.search(/SeaMonkey/) > -1) return "seamonkey";}();
		var version = function (bName) {
			switch (bName) {
				case "ie" : return (ua.split("MSIE ")[1]).split(";")[0];break;
				case "firefox" : return ua.split("Firefox/")[1];break;
				case "opera" : return ua.split("Version/")[1];break;
				case "chrome" : return (ua.split("Chrome/")[1]).split(" ")[0];break;
				case "safari" : return (ua.split("Version/")[1]).split(" ")[0];break;
				case "konqueror" : return (ua.split("KHTML/")[1]).split(" ")[0];break;
				case "iceweasel" : return (ua.split("Iceweasel/")[1]).split(" ")[0];break;
				case "seamonkey" : return ua.split("SeaMonkey/")[1];break;
			}}(bName);
		return [bName,bName + version.split(".")[0],bName + version];
	}
	var current_browser = cBrowser();
	console.log(current_browser);
</script>