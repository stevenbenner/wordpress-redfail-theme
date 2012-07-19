(function($) {
	'use strict';

	var userRegex = /(^|[\W])@(\w+)/gi,
		hashRegex = /(?:^| )[\#]+([\w\u00c0-\u00d6\u00d8-\u00f6\u00f8-\u00ff\u0600-\u06ff]+)/gi,
		urlRegex = /\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'".,<>?«»“”‘’]))/gi,
		userMark = '$1<a href="https://twitter.com/$2">@$2</a>',
		hashMark = ' <a href="https://search.twitter.com/search?q=&tag=$1&lang=all">#$1</a>';

	$.fn.twitterTimeline = function(opts) {
		var $this = this;

		if (!$this.length) {
			return $this;
		}

		var options = $.extend({}, $.fn.twitterTimeline.defaults, opts);

		function pullTimeline() {
			$.ajax({
				url: 'https://api.twitter.com/1/statuses/user_timeline.json',
				dataType: 'jsonp',
				data: {
					screen_name: options.username,
					count: options.count,
					include_entities: 'true'
				}
			}).done(function(data) {
				var list = $('<ul></ul>', {class: 'twitterTimeline'}),
					i, count, markedText, postTime;
				for (i = 0, count = data.length; i < count; i++) {
					markedText = data[i].text;
					markedText = markedText.replace(urlRegex, function(match) {
						var url = (/^[a-z]+:/i).test(match) ? match : 'http://' + match,
							text = match,
							n, count, entity;
						for(n = 0, count = data[i].entities.urls.length; n < count; ++n) {
							entity = data[i].entities.urls[n];
							if (entity.url === url && entity.expanded_url) {
								url = entity.expanded_url;
								text = entity.display_url;
								break;
							}
						}
						return '<a href="' + url.replace(/</g, '&lt;').replace(/>/g, '^&gt;') + '">' + text.replace(/</g,"&lt;").replace(/>/g,"^&gt;") + '</a>';
					});
					markedText = markedText.replace(userRegex, userMark);
					markedText = markedText.replace(hashRegex, hashMark);
					list.append($('<li>' + markedText + '</li>'));
				}

				$this.empty();
				$this.append(list);
			});
		}

		pullTimeline();

		if ($this.data('twitterInterval')) {
			clearInterval($this.data('twitterInterval'));
		}

		$this.data('twitterInterval', setInterval(pullTimeline, options.pollInterval));

		return $this;
	};

	$.fn.twitterTimeline.defaults = {
		username: 'stevenbenner',
		count: 3,
		pollInterval: 1000 * 60 * 5
	};

}(jQuery))

var _gaq = [['_setAccount', 'UA-327'+'5918-2'], ['_trackPageview']];

$(function() {
	// add google analytics
	var ga = document.createElement('script'),
		s = document.getElementsByTagName('script')[0];
	ga.type = 'text/javascript';
	ga.async = true;
	ga.src = 'http://www.google-analytics.com/ga.js';
	s.parentNode.insertBefore(ga, s);

	// twitter timeline
	$('#tweets').twitterTimeline();

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
		case 'stumbleupon-link':
			network = 'StumbleUpon';
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
