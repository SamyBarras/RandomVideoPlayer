

////
function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function loadVideo(link) {
	var page = document.querySelector("#page");
	regEx = /([a-z]*\.[a-z]*)\/(.*)/gi;
	var match_link = regEx.exec(link);
	//alert(match_link);
	if (match_link) {
		// proper link
		var video_tag = '<iframe id="player1" src="http://player.vimeo.com/video/'+match_link[2]+'?api=1&player_id=player1&\
		autoplay=1&color=ff0179&title=0&byline=0&portrait=0" width="1920" height="1080" frameborder="0" \
		webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
		if (video_tag)
		{
			page.innerHTML = video_tag;
		}
	}
}