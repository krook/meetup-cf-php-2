var xmlhttp;
function sendAsyncRequest(url, cfunc) {
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = cfunc;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}
function consumeCors() {
	sendAsyncRequest("http://krook-service-provider.mybluemix.net/cors-provider", function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("cors-content").innerHTML = xmlhttp.responseText;
        } else if (xmlhttp.readyState == 4) {
        	document.getElementById("cors-content").innerHTML = "HTTP Error";
        }
    });
}
function consumeNonCors() {
	sendAsyncRequest("http://krook-service-provider.mybluemix.net/non-cors-provider", function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("non-cors-content").innerHTML = xmlhttp.responseText;
        } else if (xmlhttp.readyState == 4) {
        	document.getElementById("non-cors-content").innerHTML = "HTTP Error";
        }
    });
}