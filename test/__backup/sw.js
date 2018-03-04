// ЕСЛИ ПОДПИСКА СУЩЕСТВУЕТ, НО ОТВАЛИЛСЯ service worker?
// ТО после включения воркера, будет приходить лапша типа "этот сайт был обновлен в фоновом режиме"
// Это обязательно нужно как-то исправить



self.addEventListener('install', function (event) {
	console.log('install', event);
});

self.addEventListener('activate', function(event) {
    // активация
    console.log('activate', event);
});


self.addEventListener('push', function(event) {
	
	var data = {};
	if (event.data) {
		data = event.data.json();
	}
	console.log('PUSH');
	console.log(data.data.time);
	
	event.waitUntil(self.clients.matchAll({includeUncontrolled: true, type: 'all'}).then(function(clientList) {
		//console.log('PUSH - clientList', clientList);
		/*
		var focused = clientList.some(function(client) {
			console.log('client', client);
			return client.focused;
		});
		*/
		
		
		//if(!clientList.length) {
			//console.log(event);
			self.registration.showNotification(data.title, {
				body: data.body,
				icon: data.icon,
				data: data.data
				//tag: 'test',
			});
			
		//}
	
	}));
});

self.addEventListener('notificationclick', function(event) {
	console.log('On notification click: ', event.notification);
	event.notification.close();
	
	// This looks to see if the current is already open and
	// focuses if it is
	event.waitUntil(clients.matchAll({includeUncontrolled: true, type: 'all'}).then(function(clientList) {
		
		console.log('clientList.length', clientList.length);
		
		return clients.openWindow((event.notification.data.onclick != undefined ? event.notification.data.onclick : '/'));
		
		/*for (var i = 0; i < clientList.length; i++) {
		var client = clientList[i];
		if (client.url == '/' && 'focus' in client)
		return client.focus();
		}
		if (clients.openWindow)
		return clients.openWindow('/');*/
	}));
});
 
self.addEventListener('pushsubscriptionchange', function(event) {
  console.log('Subscription expired');
  event.waitUntil(
    self.registration.pushManager.subscribe({ userVisibleOnly: true })
    .then(function(subscription) {
      console.log('Subscribed after expiration', subscription.endpoint);
      return fetch('/web-push/', {
        method: 'post',
        headers: {
          'Content-type': 'application/json'
        },
        body: JSON.stringify({
          endpoint: subscription.endpoint,
            auth: btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('auth')))).replace(/\+/g, '-').replace(/\//g, '_'),
            p256dh: btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('p256dh')))).replace(/\+/g, '-').replace(/\//g, '_'),
		  method: 'register'
        })
      });
    })
  );
});