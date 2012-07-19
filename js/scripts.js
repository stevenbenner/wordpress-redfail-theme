(function($){$.fn.tweet=function(o){var s={username:["stevenbenner"],avatar_size:null,count:3,intro_text:null,outro_text:null,join_text:null,auto_join_text_default:"i said,",auto_join_text_ed:"i",auto_join_text_ing:"i am",auto_join_text_reply:"i replied to",auto_join_text_url:"i was looking at",loading_text:null,query:null};if(o)$.extend(s,o);$.fn.extend({linkUrl:function(){var returning=[];var regexp=/((ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?)/gi;this.each(function(){returning.push(this.replace(regexp,"<a href=\"$1\">$1</a>"))});return $(returning);},linkUser:function(){var returning=[];var regexp=/[\@]+([A-Za-z0-9-_]+)/gi;this.each(function(){returning.push(this.replace(regexp,"<a href=\"https://twitter.com/$1\">@$1</a>"))});return $(returning);},linkHash:function(){var returning=[];var regexp=/ [\#]+([A-Za-z0-9-_]+)/gi;this.each(function(){returning.push(this.replace(regexp,' <a href="http://search.twitter.com/search?q=&tag=$1&lang=all&from='+s.username.join("%2BOR%2B")+'">#$1</a>'))});return $(returning);},capAwesome:function(){var returning=[];this.each(function(){returning.push(this.replace(/(a|A)wesome/gi,'AWESOME'))});return $(returning);},capEpic:function(){var returning=[];this.each(function(){returning.push(this.replace(/(e|E)pic/gi,'EPIC'))});return $(returning);},makeHeart:function(){var returning=[];this.each(function(){returning.push(this.replace(/(&lt;)+[3]/gi,"<tt class='heart'>&#x2665;</tt>"))});return $(returning);}});function relative_time(time_value){var parsed_date=Date.parse(time_value);var relative_to=(arguments.length>1)?arguments[1]:new Date();var delta=parseInt((relative_to.getTime()-parsed_date)/1000);if(delta<60){return'less than a minute ago';}else if(delta<120){return'about a minute ago';}else if(delta<(45*60)){return(parseInt(delta/60)).toString()+' minutes ago';}else if(delta<(90*60)){return'about an hour ago';}else if(delta<(24*60*60)){return'about '+(parseInt(delta/3600)).toString()+' hours ago';}else if(delta<(48*60*60)){return'1 day ago';}else{return(parseInt(delta/86400)).toString()+' days ago';}}
return this.each(function(){var list=$('<ul class="tweet_list">').appendTo(this);var intro='<p class="tweet_intro">'+s.intro_text+'</p>'
var outro='<p class="tweet_outro">'+s.outro_text+'</p>'
var loading=$('<p class="loading">'+s.loading_text+'</p>');if(typeof(s.username)=="string"){s.username=[s.username];}
var query='';if(s.query){query+='q='+s.query;}
query+='&q=from:'+s.username.join('%20OR%20from:');var url='http://search.twitter.com/search.json?&'+query+'&rpp='+s.count+'&callback=?';if(s.loading_text)$(this).append(loading);$.getJSON(url,function(data){if(s.loading_text)loading.remove();if(s.intro_text)list.before(intro);$.each(data.results,function(i,item){if(s.join_text=="auto"){if(item.text.match(/^(@([A-Za-z0-9-_]+)) .*/i)){var join_text=s.auto_join_text_reply;}else if(item.text.match(/(^\w+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&\?\/.=]+) .*/i)){var join_text=s.auto_join_text_url;}else if(item.text.match(/^((\w+ed)|just) .*/im)){var join_text=s.auto_join_text_ed;}else if(item.text.match(/^(\w*ing) .*/i)){var join_text=s.auto_join_text_ing;}else{var join_text=s.auto_join_text_default;}}else{var join_text=s.join_text;};var join_template='<span class="tweet_join"> '+join_text+' </span>';var join=((s.join_text)?join_template:' ')
var avatar_template='<a class="tweet_avatar" href="https://twitter.com/'+item.from_user+'"><img src="'+item.profile_image_url+'" height="'+s.avatar_size+'" width="'+s.avatar_size+'" alt="'+item.from_user+'\'s avatar" title="'+item.from_user+'\'s avatar" border="0"/></a>';var avatar=(s.avatar_size?avatar_template:'')
var date='<a href="https://twitter.com/'+item.from_user+'/statuses/'+item.id+'" title="view tweet on twitter" class="tweettime">'+relative_time(item.created_at)+'</a>';var text='<span class="tweet_text">'+$([item.text]).linkUrl().linkUser().linkHash().makeHeart().capAwesome().capEpic()[0]+'</span>';list.append('<li>'+avatar+date+join+text+'</li>');list.children('li:first').addClass('tweet_first');list.children('li:odd').addClass('tweet_even');list.children('li:even').addClass('tweet_odd');});if(s.outro_text)list.after(outro);});});};})(jQuery);

var _gaq = [['_setAccount', 'UA-327'+'5918-2'], ['_trackPageview']];

$(function() {
	(function(d) {
		var ga = d.createElement('script');
		ga.type = 'text/javascript';
		ga.async = true;
		ga.src = 'http://www.google-analytics.com/ga.js';
		var s = d.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(ga, s);
	})(document);
	$('#tweets').tweet({
		count: 3,
		query: 'from%3Astevenbenner',
		loading_text: 'searching twitter...'
	});
	$('#social-links a').on('click', function() {
		var className = $(this).attr('class');
		var network = 'Unknown';
		var action = 'share';
		if (className === 'facebook-link') {
			network = 'Facebook';
		} else if (className === 'twitter-link') {
			network = 'Twitter';
			action = 'tweet'
		} else if (className === 'delicious-link') {
			network = 'Delicious';
		} else if (className === 'stumbleupon-link') {
			network = 'StumbleUpon';
		} else if (className === 'digg-link') {
			network = 'Digg';
		} else if (className === 'reddit-link') {
			network = 'Reddit';
		};
		_gaq.push(['_trackEvent', 'Share Buttons', network, document.location.href]);
		_gaq.push(['_trackSocial', network.toLowerCase(), socialAction]);
	});
});
