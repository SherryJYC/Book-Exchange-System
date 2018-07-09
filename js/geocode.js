var map;
	var markers =[];
    var addresses =[];
    
	function initialize() {
        var mapOptions = {
            zoom: 12,
            center: new google.maps.LatLng(22.31, 114.18),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById('map'), mapOptions);
    }
    google.maps.event.addDomListener(window, 'load', initialize);
	 document.getElementById('coderBtn').onclick=showGeocoder;
	
    function showGeocoder() {
		clearMarkers();
        var geoCoder = new google.maps.Geocoder();
        var address = document.getElementById('address').value;
        geoCoder.geocode({address: address, region: ".hk"},
            function geoResult(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
					for(var i=0; i<results.length;i++){
						var fmt_address = results[i].formatted_address;
						var pos = results[i].geometry.location
						map.setCenter(pos);
						var marker = new google.maps.Marker({
							map: map,
							title: address,
							position: pos,
							draggable: true,
							animation: google.maps.Animation.DROP,
						});
						markers.push(marker);	
						marker.addListener('click',function(){
							document.getElementById('finalAddress').innerHTML = fmt_address;
							document.getElementById('nullAddress').display = 'none';
							document.getElementById('submit_adr').value = pos;
							checkAddress();
							
						});
						
					}
					setMapOnAll(map);
					checkAddress();
                } else {
					wrongInput();
                }
            }
        );
    }
	function setMapOnAll(map){
		for(var i=0;i<markers.length;i++){
			markers[i].setMap(map);
		}
	}
	function clearMarkers(){
		setMapOnAll(null);
		markers = [];
		addresses = [];
	}
	function wrongInput(){
		document.getElementById('nullAddress').style.display ="block";
	}
	function rightInput(){
		document.getElementById('nullAddress').style.visibility ="hide";
	}
	function checkAddress(){
		var content = document.getElementById('finalAddress').value;
		if(content == null){wrongInput();}
		else{rightInput();}
	}
	function getCoordinate(){
		//var adr = document.getElementById('finalAddress').textContent; 
		//document.getElementById('submit_adr').value = adr;
		var submit = document.getElementById('submit_adr').value
		//alert(submit);
	}
	
	