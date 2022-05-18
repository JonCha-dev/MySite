<?php
    header('Content-Type: text/javascript');

    if ($_COOKIE["session"]) {
        session_id($_COOKIE["session"]);
    }
    session_start();
    setcookie("session", session_id(), time()+1800); 
?>

// on load data collection
window.addEventListener('DOMContentLoaded', (event) => {

	// get cookie id from https://stackoverflow.com/questions/10730362/get-cookie-by-name
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${"session"}=`);
    if (parts.length === 2) {
        var cookie_id = parts.pop().split(';').shift();
    }

    // Static data
	var agent = navigator.userAgent;
	var language = navigator.language;
	var accept_cookies = navigator.cookieEnabled;
	var allow_images = false; 
	var allow_css = false;
	var allow_js = true;
  	var screen_width = screen.width;
	var screen_height = screen.height;
	var window_inner_width = window.innerWidth;
	var window_inner_height = window.innerHeight;
	var window_outer_width = window.outerWidth;
	var window_outer_height = window.outerHeight;
	var conn_type = navigator.connection.effectiveType;

	// from https://stackoverflow.com/questions/31740637/detect-if-browser-disables-images
	if ((document.getElementById('flag').offsetWidth==1 
		&& document.getElementById('flag').readyState=='complete')
         	||(document.getElementById('flag').offsetWidth==1
         	&& document.getElementById('flag').readyState==undefined))
    	{
    	 	allow_images = true;
    	}
	
	// from https://www.sitepoint.com/community/t/how-to-detect-whether-css-enabled-or-not-using-javascript/4597/11
	var testcss = document.createElement('div');
	testcss.style.position = 'absolute';
	document.getElementsByTagName('body')[0].appendChild(testcss);
	if (testcss.currentStyle) var currstyle = testcss.currentStyle['position'];
	else if (window.getComputedStyle) var currstyle = document.defaultView.getComputedStyle(testcss, null).getPropertyValue('position');
	var allow_css = (currstyle == 'static') ? false : true;
	document.getElementsByTagName('body')[0].removeChild(testcss);

    // save locally
    const myInit = {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({  "session_id": cookie_id, 
                                "agent": agent,
								"language": language,
								"accept_cookies": accept_cookies,
								"allow_images" : allow_images,
								"allow_css" : allow_css,
								"allow_js" : allow_js,
								"screen_width" : screen_width,
								"screen_height" : screen_height,
								"window_inner_width" : window_inner_width,
								"window_inner_height" : window_inner_height,
								"window_outer_width" : window_outer_width,
								"window_outer_height" : window_outer_height,
								"connection_type" : conn_type
                            })
    };
    const myRequest = new Request('/api/static/');
    fetch(myRequest, myInit)
        .then((response) => {
            console.log("static POSTs done");
    });

	// Performance data
	window.onload = function() {
		setTimeout(() => {
			var timing_obj = performance.timing;
			var load_start = timing_obj.navigationStart;
			var load_end = timing_obj.loadEventEnd;
			var total_loadtime = load_end - load_start;

			var last_page = document.referrer;
			var join_time = Date.now();

			const myInit = {
				method: 'POST',
				headers: {'Content-Type': 'application/json'},
				body: JSON.stringify({  "session_id": cookie_id, 
										"load_start" : load_start,
										"load_end" : load_end,
										"total_loadtime" : total_loadtime
									})
			};
			const myRequest = new Request('/api/performance/');
			fetch(myRequest, myInit)
				.then((response) => {
					console.log("click POSTs done");
			});
		}, 0);
	}


	// continuous data collection
	var idle_start = Date.now();

	document.onmousemove = function(event) {
		getIdleTime();
	}

	window.addEventListener('mouseup', (event) => {
		var mouse_x = event.pageX;
		var mouse_y = event.pageY;
		var scroll_pos = window.scrollY;
		var mouse_click = event.button;
		var last_page = document.referrer;
		getIdleTime();

		const myInit = {
			method: 'POST',
			headers: {'Content-Type': 'application/json'},
			body: JSON.stringify({  "session_id": cookie_id, 
									"mouse_x" : mouse_x,
									"mouse_y" : mouse_y,
									"mouse_click" : mouse_click,
									"scroll_pos" : scroll_pos,
									"key_up" : "none",
									"key_down" : "none",
									"idle_end" : -1,
									"idle_time_elapsed" : -1,
									"join_time" : -1,
									"leave_time" : -1, 
									"last_page" : last_page
								})
		};
		const myRequest = new Request('/api/activity/');
		fetch(myRequest, myInit)
			.then((response) => {
				console.log("click POSTs done");
		});
	});

	document.addEventListener('scroll', function(event) {
		var mouse_x = event.pageX;
		var mouse_y = event.pageY;
		var scroll_pos = window.scrollY;
		var last_page = document.referrer;
		getIdleTime();

		const myInit = {
			method: 'POST',
			headers: {'Content-Type': 'application/json'},
			body: JSON.stringify({  "session_id": cookie_id, 
									"mouse_x" : mouse_x,
									"mouse_y" : mouse_y,
									"scroll_pos" : scroll_pos,
									"mouse_click" : "none",
									"key_up" : "none",
									"key_down" : "none",
									"idle_end" : -1,
									"idle_time_elapsed" : -1,
									"join_time" : -1,
									"leave_time" : -1, 
									"last_page" : last_page
								})
		};
		const myRequest = new Request('/api/activity/');
		fetch(myRequest, myInit)
			.then((response) => {
				console.log("scroll POSTs done");
		});
	});

	document.addEventListener('keydown', function(event) {
		var key_down = event.code;
		var mouse_x = event.pageX;
		var mouse_y = event.pageY;
		var scroll_pos = window.scrollY;
		var last_page = document.referrer;
		getIdleTime();

		const myInit = {
			method: 'POST',
			headers: {'Content-Type': 'application/json'},
			body: JSON.stringify({  "session_id": cookie_id, 
									"key_down" : key_down,
									"key_up" : "none",
									"leave_time" : -1,
									"last_page" : last_page, 
									"join_time" : -1,
									"idle_end" : -1,
									"idle_time_elapsed" : -1,
									"mouse_x" : mouse_x,
									"mouse_y" : mouse_y,
									"mouse_click" : "none",
									"scroll_pos" : scroll_pos
								})
		};
		const myRequest = new Request('/api/activity/');
		fetch(myRequest, myInit)
			.then((response) => {
				console.log("keydown POSTs done");
		});


	});

	document.addEventListener('keyup', function(event) {
		var key_up = event.code;
		var mouse_x = event.pageX;
		var mouse_y = event.pageY;
		var scroll_pos = window.scrollY;
		var last_page = document.referrer;
		getIdleTime();

		const myInit = {
			method: 'POST',
			headers: {'Content-Type': 'application/json'},
			body: JSON.stringify({  "session_id": cookie_id, 
									"key_up" : key_up,
									"leave_time" : -1,
									"last_page" : last_page, 
									"join_time" : -1,
									"idle_end" : -1,
									"idle_time_elapsed" : -1,
									"mouse_x" : mouse_x,
									"mouse_y" : mouse_y,
									"mouse_click" : "none",
									"scroll_pos" : scroll_pos,
									"key_down" : "none"
								})
		};
		const myRequest = new Request('/api/activity/');
		fetch(myRequest, myInit)
			.then((response) => {
				console.log("keyup POSTs done");
		});
	});

	document.addEventListener('visibilitychange', function() {
		var mouse_x = event.pageX;
		var mouse_y = event.pageY;
		var scroll_pos = window.scrollY;
		var last_page = document.referrer;

		if (document.visibilityState === 'hidden') {
			var leave_time = Date.now();
			var last_page = document.referrer;

			const myInit = {
				method: 'POST',
				headers: {'Content-Type': 'application/json'},
				body: JSON.stringify({  "session_id": cookie_id, 
										"leave_time" : leave_time,
										"last_page" : last_page, 
										"join_time" : -1,
										"idle_end" : -1,
										"idle_time_elapsed" : -1,
										"mouse_x" : mouse_x,
										"mouse_y" : mouse_y,
										"mouse_click" : "none",
										"scroll_pos" : scroll_pos,
										"key_up" : "none",
										"key_down" : "none"
									})
			};
			const myRequest = new Request('/api/activity/');
			fetch(myRequest, myInit)
				.then((response) => {
					console.log("pageleave POSTs done");
			});
		}

		if (document.visibilityState === 'visible') {
			var join_time = Date.now();
			var last_page = document.referrer;

			const myInit = {
				method: 'POST',
				headers: {'Content-Type': 'application/json'},
				body: JSON.stringify({  "session_id": cookie_id, 
										"join_time" : join_time,
										"last_page" : last_page,
										"idle_end" : -1,
										"idle_time_elapsed" : -1,
										"mouse_x" : mouse_x,
										"mouse_y" : mouse_y,
										"mouse_click" : "none",
										"scroll_pos" : scroll_pos,
										"key_up" : "none",
										"key_down" : "none",
										"leave_time" : -1 
									})
			};
			const myRequest = new Request('/api/activity/');
			fetch(myRequest, myInit)
				.then((response) => {
					console.log("pagejoin POSTs done");
			});
		}
	});


	function getIdleTime() {
		var idle_end = Date.now();
		var time_elapsed = idle_end - idle_start;
		idle_start = Date.now();
		var mouse_x = event.pageX;
		var mouse_y = event.pageY;
		var scroll_pos = window.scrollY;
		var last_page = document.referrer;

		if(time_elapsed >= 2000) {
			const myInit = {
				method: 'POST',
				headers: {'Content-Type': 'application/json'},
				body: JSON.stringify({  "session_id": cookie_id, 
										"idle_end" : idle_end,
										"idle_time_elapsed" : time_elapsed,
										"mouse_x" : mouse_x,
										"mouse_y" : mouse_y,
										"mouse_click" : "none",
										"scroll_pos" : scroll_pos,
										"key_up" : "none",
										"key_down" : "none",
										"join_time" : -1,
										"leave_time" : -1, 
										"last_page" : last_page
									})
			};
			const myRequest = new Request('/api/activity/');
			fetch(myRequest, myInit)
				.then((response) => {
					console.log("idle POSTs done");
			});
		}
	}
});


