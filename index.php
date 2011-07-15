<html>
<head>
	<title>Spotify Catalog Browser</title>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script>
	<script>
	$(document).ready(function () {
		
	});
	function spotify_search()
	{
		$('#results').html('loading results...');
		$.ajax({
			type: "GET",
			url: "http://ws.spotify.com/search/1/"+$('#type').val()+"?q="+$('#keyword').val(),
			dataType: ($.browser.msie) ? "text/xml" : "xml",
			success: function(xml) {
			     xmlParser(xml,$('#type').val());
    		}
    	});
   }
   
   function xmlParser(xml,search_type)
	{
		$('#results').html('');
		switch (search_type) {
			case 'artist':
				var html = '<table><tr><th>Artist</th></tr>';
				$(xml).find("artist").each(function () {
					// artist id: $(this).attr('href')
					html = html+'<tr class="lines"><td class="title"><a href="javascript:void(0);" onclick="search_link(\'album\',\''+$(this).find("name").text()+'\');" class="search_link">' + $(this).find("name").text() + '</a></td></tr>';
				});
			break;
			case 'album':
				var html = '<table><tr><th>Artist</th><th>Album</th></tr>';
				$(xml).find("album").each(function () {
					var artist = $(this).find("artist").text();
					var artist_attr = $(this).find("artist").attr('href')
					
					html = html+'<tr class="lines"><td class="title">'+artist+'</td><td class="album">'+$(this).children("name").text()+' <div id="extra">('+$(this).children("availability").text()+')<br />'+artist_attr+'</div></td></tr>';
					
				});
			break;
		}
		$('#results').html(html+'</table>');
	}
	
	function search_link(type,keyword)
	{
		$('#type').val(type);
		$('#keyword').val(keyword);
		spotify_search();
	}
	</script>
</head>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-543394-25']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<body>
<style>
body {
		font-family: arial, san-serif;
		background: #373737;
		color: #fff;
		font-size: 12px;
	}
a {color: #afe059;}
a:hover {color: #60910f;}
th {
text-align: left;
font-size: 12px;
color: #111;
	padding: 5px;
	text-shadow:0px 1px 0px #b7b7b7;
	font-weight: bold;
	background: #a8a8a8; /* Old browsers */
	background: -moz-linear-gradient(top, #a8a8a8 0%, #868686 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#a8a8a8), color-stop(100%,#868686)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top, #a8a8a8 0%,#868686 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top, #a8a8a8 0%,#868686 100%); /* Opera11.10+ */
	background: -ms-linear-gradient(top, #a8a8a8 0%,#868686 100%); /* IE10+ */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a8a8a8', endColorstr='#868686',GradientType=0 ); /* IE6-9 */
	background: linear-gradient(top, #a8a8a8 0%,#868686 100%); /* W3C */
}
tr.lines {padding: 5px;}
tr.lines:nth-child(odd) {background: #313131;}
tr.lines:nth-child(even) {background: #373737;}
tr.lines:hover {
	color: #afe059;
	background: #252525; /* Old browsers */
	background: -moz-linear-gradient(top, #252525 0%, #1f1f1f 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#252525), color-stop(100%,#1f1f1f)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top, #252525 0%,#1f1f1f 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top, #252525 0%,#1f1f1f 100%); /* Opera11.10+ */
	background: -ms-linear-gradient(top, #252525 0%,#1f1f1f 100%); /* IE10+ */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#252525', endColorstr='#1f1f1f',GradientType=0 ); /* IE6-9 */
	background: linear-gradient(top, #252525 0%,#1f1f1f 100%); /* W3C */
}



.title, .album {
vertical-align: top;
font-size: 12px;
padding: 5px 8px;
}

a.search_link {
text-decoration: none;
color: #fff;
}
a.search_link:hover {
color: #afe059;
}

#extra_link {cursor: pointer; float: right; font-size: 10px; border-bottom: 1px dotted #fff;}
#extra {display: none; font-size: 10px;}

.side_bar {
	position: absolute;
	width: 300px;
	overflow: auto;
	right: 10;
	top: 10;
}


</style>
<div class="side_bar">
	<img src="http://upload.wikimedia.org/wikipedia/commons/archive/7/79/20110126015610!Spotify_logo.png" style="float: right; margin: 0 0 5px 5px;">
	<h2>Browse Catalog</h2>
	This was developed to help your browse the Spotify catalog before you <a href="http://www.spotify.com/us/get-spotify/overview/">purchase the paid packages</a> - which BTW is well worth it!
	<br /><br />
	<a href="https://github.com/jveldboom/Spotify-Catalog-Brower">Visit our github</a> page to help us improve or squash bugs.
	<br /><br />
	<a href="http://open.spotify.com/user/jveldboom"><img src="https://www.spotify.com/static/images/social-badge-en_US.png" alt="Follow me on Spotify" title="Follow me on Spotify"></a>
	<br /><br />
	<a href="http://twitter.com/#!/jveldboom" title="twitter"><img src="http://cdn1.iconfinder.com/data/icons/vector_social_media_icons/16px/twitter.png" border=0></a>
	<a href="http://www.facebook.com/johnveldboom" title="Facebook"><img src="http://cdn1.iconfinder.com/data/icons/vector_social_media_icons/16px/facebook.png" border=0></a>
	<a href="https://plus.google.com/117818393527494042939/about" title="Google+"><img src="https://lh3.googleusercontent.com/-5IAsU14e0rA/Th_DOWo7rjI/AAAAAAAADRU/0SVKF1I5xoo/s16/g-plus-icon-16x16.png" border=0></a>
	<br /><br />
	<iframe src="http://www.facebook.com/plugins/like.php?app_id=122324204524908&amp;href=http%3A%2F%2Fwww.linein.org%2Fexamples%2Fspotify%2F&amp;send=false&amp;layout=button_count&amp;width=250&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font=verdana&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:21px;" allowTransparency="true"></iframe>
	<br /><br />
	<g:plusone size="medium"></g:plusone>
</div>
<form onsubmit="spotify_search(); return false;">
<select id="type">
	<option value="artist">Artist</option>
	<option value="album">Album</option>
	<!--<option value="track">Track</option>-->
</select>
<input type="text" name="keyword" id="keyword">
<input type="submit" value="search" class="search_button">
</form>
<br /><br />
<div id="results"></div>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<body>
</html>