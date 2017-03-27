<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://f.vimeocdn.com/js/froogaloop2.min.js"></script>
<script src="script.js"></script>
<link rel="stylesheet" href="style.css">
<script>
	// load external text file with list of vimeo links
    var xmlhttp;
	xmlhttp=new XMLHttpRequest();
	xmlhttp.open('GET', "link.txt", false);
	xmlhttp.send();
	var videos = xmlhttp.responseText.split("\n");
	// get existing cookie
	var previous = readCookie("prevvideo");
	// pick up randomly a vimeo link in list, and check if it is not previously viewed
	var item = videos[Math.floor(Math.random()*videos.length)];
	if (previous != null) {
		do {
			item = videos[Math.floor(Math.random()*videos.length)];
		}
		while (item == previous);
	};
	// doc ready, load the video
	$(document).ready(function() {
 		// executes when HTML-Document is loaded and DOM is ready
 		loadVideo(item);
		// create the cookie
		createCookie("prevvideo",item, 2);
	});
	
	$(function() {
    var player = $('iframe');
    var playerOrigin = '*';
    var status = $('.status');

    // Listen for messages from the player
    if (window.addEventListener) {
        window.addEventListener('message', onMessageReceived, false);
    }
    else {
        window.attachEvent('onmessage', onMessageReceived, false);
    }

    // Handle messages received from the player
    function onMessageReceived(event) {
        // Handle messages from the vimeo player only
        if (!(/^https?:\/\/player.vimeo.com/).test(event.origin)) {
            return false;
        }
        
        if (playerOrigin === '*') {
            playerOrigin = event.origin;
        }
        
        var data = JSON.parse(event.data);
        
        switch (data.event) {
            case 'ready':
                onReady();
                break;
               
            case 'playProgress':
                onPlayProgress(data.data);
                break;
                
            case 'pause':
                onPause();
                break;
               
            case 'finish':
                onFinish();
                break;
        }
    }

    // Call the API when a button is pressed
    $('button').on('click', function() {
        post($(this).text().toLowerCase());
    });

    // Helper function for sending a message to the player
    function post(action, value) {
        var data = {
          method: action
        };
        
        if (value) {
            data.value = value;
        }
        
        var message = JSON.stringify(data);
        player[0].contentWindow.postMessage(message, playerOrigin);
    }

    function onReady() {
        status.text('ready');
        
        post('addEventListener', 'pause');
        post('addEventListener', 'finish');
        post('addEventListener', 'playProgress');
    }

    function onPause() {
        status.text('paused');
    }

    function onFinish() {
        status.text('finished');
        location.reload(); 
    }

    function onPlayProgress(data) {
        status.text(data.seconds + 's played');
    }
	});
	
</script>
</head>
<body>
<div id="page">
</div>
<div id="stat">Status: <span class="status">&hellip;</span></div>
</body>
</html>