var map;
        function initialize() {
            var mapOptions = { zoom: 14,
                center: new google.maps.LatLng( 22.31, 114.18),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById('map-convas'), mapOptions);

            
			if(city!=''){
				var length = city.length;
				var arr = city.substr(1,length-2);
				arr = arr.split(",");
				//alert(arr);
				var coordinate = new google.maps.LatLng(arr[0],arr[1]);
				var marker = new google.maps.Marker({
					map: map,
					title: 'Location of the user',
					position: coordinate,
					draggable: false,
					animation: google.maps.Animation.DROP,
				});
				marker.setMap(map);
				map.setCenter(coordinate);
				var infowindow=new google.maps.InfoWindow({
					content:'<p>'+name+' is here!</p><p>'
				});
				google.maps.event.addListener(marker,'mouseover',function(){
					infowindow.open(map,marker)
				});

			}else{
				document.getElementById("noLoc").visibility = visible;
				//alert("City is null!")
			}
        }
        google.maps.event.addDomListener(window, 'load', initialize);