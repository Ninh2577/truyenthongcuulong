// Dedicated Web Worker for autonomous chat message monitoring in background
var timer = null;
var currentLastId = 0;
var inFlight = false;
var pollInterval = 700;

function poll() {
    if (inFlight) return;
    inFlight = true;

    fetch('/cuulongteam/api/chat/check-new-messages?last_id=' + currentLastId, {
        headers: { 'Accept': 'application/json' },
        credentials: 'same-origin',
        cache: 'no-store'
    })
    .then(function (res) {
        if (res.status === 401 || res.status === 419) {
            self.postMessage({ type: 'session_expired' });
            return null;
        }
        if (!res.ok) return null;
        return res.json();
    })
    .then(function (data) {
        inFlight = false;
        if (!data) return;

        if (currentLastId === 0) {
            currentLastId = data.latest_id || 0;
            self.postMessage({ type: 'baseline', lastId: currentLastId, unread: data.unread_count });
            return;
        }

        if (data.has_new && data.message_id > currentLastId) {
            currentLastId = data.message_id;
            self.postMessage({ type: 'new_message', data: data });
        } else if (data.unread_count !== undefined) {
            self.postMessage({ type: 'unread_count', count: data.unread_count });
        }
    })
    .catch(function () {
        inFlight = false;
    });
}

self.onmessage = function (e) {
    if (!e.data) return;
    if (e.data.action === 'start') {
        currentLastId = e.data.lastId || 0;
        if (timer) clearInterval(timer);
        poll();
        timer = setInterval(poll, pollInterval);
    } else if (e.data.action === 'set_last_id') {
        currentLastId = e.data.lastId || 0;
    } else if (e.data.action === 'stop') {
        if (timer) clearInterval(timer);
        timer = null;
    }
};
