// script.js
//* DEBUG
var DebugValueForAlert = 0;
function bip() {
    alert("bip " + DebugValueForAlert);
    DebugValueForAlert++;
}
window.onerror = function (msg, url, linenumber) {
    alert('Error message: ' + msg + '\nURL: ' + url + '\nLine Number: ' + linenumber + '\nalert number: ' + DebugValueForAlert);
    DebugValueForAlert++;
}
// */

//.