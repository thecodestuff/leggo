<?php 
print_r($data) ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>open street maps api</title>
	<!---leaflet css-->
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
   integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
   crossorigin=""/>

   <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
   integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
   crossorigin=""></script>

   <!---importing functions.js -->
   
   <style rel="text/css">
   	#mapid { 
   		height: 500px;

   		background-color: grey ;
   	 }
   </style>
</head>
<body>
	<h2>Locate bus stop near by me </h2>
	<div id="mapid"></div>

	<script>
	function fetch_test_data(){
		console.log('fetching test data...') ;

		fetch('http://localhost/live%20tracking/api/v1/locate&apikey=abcd1234xyz').then(response=>{
			return response.json() ;
		}).then(data=>{
			//console.log('your data:'+data[1].bus_stop_name)
			for(let i=3 ;i<52;i++){
 			 	//console.log(data.feeds[i]['field1']+','+ data.feeds[i]['field2'] );
 			 	
 			 		var marker = L.marker([data[i].latitude, data[i].longitude]).addTo(mymap).bindPopup('bus stop name:'+data[i].bus_stop_name ,'lant:'+data[i].latitude+' , long: '+data[i].long).openPopup();
 			 }

		}) ;
	}
	//fetching data from thingspeak api using fetch api AIzaSyACQNPDXK2BP0OQsmSFBZqMtQpE8Ph9Vkw
	function fetch_data_from_api(){

		console.log('function evoked...')
		// Replace ./data.json with your JSON feed
		fetch('https://api.thingspeak.com/channels/684398/feeds.json?api_key=87F2N6QMW3SJKO5G&results=52').then(response => {
 			 return response.json();
		}).then(data => {
 			 // Work with JSON data here
 			 //console.log(data.feeds[0]['field1']);
 			 for(let i=3 ;i<52;i++){
 			 	//console.log(data.feeds[i]['field1']+','+ data.feeds[i]['field2'] );
 			 	if(data.feeds[i]['field1'] != null && data.feeds[i]['field2']!=null)
 			 		var marker = L.marker([data.feeds[i]['field1'], data.feeds[i]['field2']]).addTo(mymap).bindPopup('lant:'+data.feeds[i]['field1']+' , long: '+data.feeds[i]['field2']).openPopup();
 			 }
 			 				console.log('circling..')
 			 //adding polyline 
 			 var latlangs = [
    							[26.92339459 , 75.74867956],
    							[26.92375955 , 75.7492462],
    							[26.92373954 , 75.75052901],
    							[26.92378689 , 75.75184075],
    							[26.92391821 ,  75.75250699],
    							[26.92449864 ,  75.75262323],
    							[26.92420778 , 75.75319691]
			 				] ;

 			 var polyline = L.polyline(latlangs , {color:'red'}).addTo(mymap);

	



		});

		//setTimeout(fetch_data_from_api, 5000);
	}//EOF

	function route(){
		var marker = L.marker([26.9124 , 75.7873]).addTo(mymap);
		var marker2 = L.marker([26.92516321 , 75.75461675]).addTo(mymap);

	}
	var mymap = L.map('mapid').setView([26.9124, 75.7873], 13);
	// open stree map url -https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png
	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    	maxZoom: 21,
    	id: 'mapbox.streets',
    	accessToken: 'pk.eyJ1IjoibWFoZW5kcmFjaG91ZGhhcnkiLCJhIjoiY2pyOHdldHRkMDB0cTQ5bmt5ZmtmcGhkdCJ9.ELcQW-I7rlh75ZUF9sFChg'
	}).addTo(mymap);

	//functions 

	/*function map_data(){
		var lats = [
			26.92516321 ,
			26.92507749  , 
			26.92504144 ,
			26.92373954 
		]

		var longs = [
			75.75461675 , 
			75.75459408 ,
			75.75445597 ,
			75.75052901
		]
		console.log('lets map dude') ;
		//looping 2d array
		for(let i=0 ; i<=3;i++){
			var marker = L.marker([lats[i] , longs[i]]).addTo(mymap);
		}
	}*/


	//route() ;

			/*var circle = L.circle([26.9124 , 75.7873], {
    					color: 'red',
    					fillColor: '#f03',
    					fillOpacity: 0.5,
    					radius: 500
					}).addTo(mymap);
			var latlangs = [
				[26.9124 , 75.7873],
				[26.92516321 , 75.75461675]
			];
			var line = L.polyline(latlangs ,{color:'red'}).addTo(mymap) ;*/
	//adding marker
	//console.log('mapping data !!!!!') ; 
	//fetch_data_from_api() ;
	fetch_test_data() 

	</script>
</body>
</html>