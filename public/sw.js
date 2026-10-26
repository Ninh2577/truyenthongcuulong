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
            // 1. Look for an existing chat-inbox tab first
            for (var i = 0; i < windowClients.length; i++) {
                var client = windowClients[i];
                if (client.url.indexOf('/cuulongteam/chat-inbox') !== -1 && 'focus' in client) {
                    if ('navigate' in client) {
                        client.navigate(targetUrl);
                    }
                    return client.focus();
                }
            }
            // 2. Look for any other open admin panel tab (/cuulongteam)
            for (var j = 0; j < windowClients.length; j++) {
                var adminClient = windowClients[j];
                if (adminClient.url.indexOf('/cuulongteam') !== -1 && 'focus' in adminClient) {
                    if ('navigate' in adminClient) {
                        adminClient.navigate(targetUrl);
                    }
                    return adminClient.focus();
                }
            }
            // 3. If no admin tab is open, open a new window/tab so the current frontend page is not replaced
            if (clients.openWindow) {
                return clients.openWindow(targetUrl);
            }
        })
    );
});
