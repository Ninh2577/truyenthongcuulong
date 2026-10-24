// Service Worker for Truyền Thông Cửu Long - Desktop Push & System Notifications
self.addEventListener('install', function (event) {
    self.skipWaiting();
});

self.addEventListener('activate', function (event) {
    event.waitUntil(self.clients.claim());
});

self.addEventListener('notificationclick', function (event) {
    event.notification.close();

    var targetUrl = (event.notification.data && event.notification.data.url)
        ? event.notification.data.url
        : '/cuulongteam/chat-inbox';

    event.waitUntil(
        clients.matchAll({ type: 'window', includeUncontrolled: true }).then(function (windowClients) {
            for (var i = 0; i < windowClients.length; i++) {
                var client = windowClients[i];
                if ('focus' in client) {
                    if ('navigate' in client) {
                        client.navigate(targetUrl);
                    }
                    return client.focus();
                }
            }
            if (clients.openWindow) {
                return clients.openWindow(targetUrl);
            }
        })
    );
});
