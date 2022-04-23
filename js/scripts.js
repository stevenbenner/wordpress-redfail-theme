var _gaq = [['_setAccount', 'UA-327'+'5918-2'], ['_trackPageview']];

$(function() {
	// add google analytics
	var ga = document.createElement('script'),
		s = document.getElementsByTagName('script')[0];
	ga.type = 'text/javascript';
	ga.async = true;
	ga.src = 'https://www.google-analytics.com/ga.js';
	s.parentNode.insertBefore(ga, s);

	// ga click tracking
	$('#social-links a').on('click', function() {
		var className = $(this).attr('class'),
			network = 'Unknown',
			action = 'share';

		switch (className) {
		case 'facebook-link':
			network = 'Facebook';
			break;
		case 'twitter-link':
			network = 'Twitter';
			action = 'tweet';
			break;
		case 'delicious-link':
			network = 'Delicious';
			break;
		case 'digg-link':
			network = 'Digg';
			break;
		case 'reddit-link':
			network = 'Reddit';
			break;
		}

		_gaq.push(['_trackEvent', 'Share Buttons', network, document.location.href]);
		_gaq.push(['_trackSocial', network.toLowerCase(), socialAction]);
	});
});
