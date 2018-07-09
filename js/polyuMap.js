		var map;
        function initialize() {
            var mapOptions = { zoom: 14,
                center: new google.maps.LatLng( 22.31, 114.18),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById('map-convas'), mapOptions);

            var geoCoder= new google.maps.Geocoder();
            geoCoder.geocode({address:"The Hong Kong Polytechnic University"},
                function geoResult(results,status){
                    if(status==google.maps.GeocoderStatus.OK){
                        var marker = new google.maps.Marker({
                            map: map,
                            title: 'The Hong Kong Polytechnic University',
                            position: results[0].geometry.location,
                            draggable: false,
							animation: google.maps.Animation.DROP,
							icon:'./img/rsz_polyu.png'
						});
                        marker.setMap(map);
						var infowindow=new google.maps.InfoWindow({
                            content:'<p>The Hong Kong Polytechnic University</p><p>'+
                            '</p><a href="https://www.polyu.edu.hk/web/en/home/index.html">Visit Us</a></p>'
                        });
                        google.maps.event.addListener(marker,'mouseover',function(){
                            infowindow.open(map,marker)
                        });

                    }else{
                        alert(":error "+status);
                    }
                }
            );
        }
        google.maps.event.addDomListener(window, 'load', initialize);