<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Página proyecto delMasAjax</title>
<meta charset="utf-8">
<link href="css/globe.css" rel="stylesheet">
<meta http-equiv="refresh" content="300">
</head>
<body>
	<div id="container"></div>
	<div class="rightInfo">
		<div class="author">
			<table>
				<tr>
					<td>Latitude</td>
					<td id="latitude" style="text-align: right;"></td>
					<td></td>
				</tr>
				<tr>
					<td>Longitude</td>
					<td id="longitude" style="text-align: right;"></td>
					<td></td>
				</tr>
				<tr>
					<td>Altitude</td>
					<td id="altitude" style="text-align: right;"></td>
					<td></td>
				</tr>
				<tr>
					<td>Velocity</td>
					<td id="velocity" style="text-align: right;"></td>
					<td></td>
				</tr>
			</table>
			<table>
				<tr>
					<th></th>
					<th>Position (km)</th>
					<th>Velocity (m/s)</th>
				</tr>
				<tr>
					<td>X</td>
					<td id="USLAB000032"></td>
					<td id="USLAB000035"></td>
				</tr>
				<tr>
					<td>Y</td>
					<td id="USLAB000033"></td>
					<td id="USLAB000036"></td>
				</tr>
				<tr>
					<td>Z</td>
					<td id="USLAB000034"></td>
					<td id="USLAB000037"></td>
				</tr>
			</table>
			<a href="http://github.com/NorthIsUp/orbital2">Orbital Part Deux</a>
		</div>
		<span class="bull">&bull;</span>
	</div>

	<div class="leftInfo">
		<a class="twitter-timeline" href="https://twitter.com/ISSData"
			data-widget-id="587215743219068928">Tweets por el @ISSData.</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

		<div class="share">
			<!-- twitter share button -->
			<a href="https://twitter.com/share" class="twitter-share-button"
				data-text="#Python and #Nginx powering Orbital 2.0. Built #PyCon tough."
				data-via="Disqus" data-related="NorthIsUp">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
	</div>

	<div id="postInfo"></div>

	<script
		src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script
		src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.9.0/TweenMax.min.js"></script>
	<script src="http://underscorejs.org/underscore-min.js"></script>
	<script src="js/third-party/system.min.js"></script>
	<script src="js/third-party/three56.js"></script>
	<script src="js/third-party/tween.js"></script>
	<script src="js/third-party/eventsourcePollyfill.js"></script>
	<script src="js/orbital.js"></script>
	<script src="js/util.js"></script>
	<script src="js/geoutil.js"></script>
	<script src="js/point.js"></script>
	<script src="js/globe.js"></script>
	<script src="js/demo.js"></script>
</body>
<script>
	      setInterval(function() {
	      
	      var xhr;
	      
	      xhr = new XMLHttpRequest();
	      xhr.open('GET', 'https://api.wheretheiss.at/v1/satellites/25544', true);
	      xhr.onreadystatechange = function(e) {
	        if (xhr.readyState === 4) {
	          if (xhr.status === 200) {
	            var data = JSON.parse(xhr.responseText);
		    console.log(data);
	            globe.addPoint(data.latitude, data.longitude,data.altitude/400);
				$("#longitude").html(data.longitude + ' º');
				$("#latitude").html(data.latitude + " º");
				$("#altitude").html(data.altitude + " km");
				$("#velocity").html(data.velocity + " km/h");
	          }
	        }
	      };
	      xhr.send(null);
	    },3000);
	</script>

<script src="//demos.lightstreamer.com/commons/require.js"></script>

<script src="//demos.lightstreamer.com/commons/lightstreamer.js"></script>

<script src="//code.jquery.com/jquery-2.1.3.min.js"></script>



<script>
	
	require(["LightstreamerClient","Subscription"],function(LightstreamerClient,Subscription) {
	
		var client = new LightstreamerClient("https://push.lightstreamer.com","ISSLIVE");
	
		client.connect();
	
		
	
		var sub = new Subscription("MERGE",["USLAB000032","USLAB000035","USLAB000033","USLAB000036","USLAB000034","USLAB000037"],["Value"]);
	
		client.subscribe(sub);
	
		
	
		sub.addListener({
	
			onItemUpdate: function(update) {
	
				$("#"+update.getItemName()).text(update.getValue("Value"));
	
			}
	
		});
	
		
	
	});
	
	</script>

</html>
