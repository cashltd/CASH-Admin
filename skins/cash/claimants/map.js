    var iconBlue = new GIcon(); 
    iconBlue.image = 'http://'+ document.domain +'/skins/cash/images/allocated.png';
    iconBlue.iconSize = new GSize(10, 10);
    iconBlue.iconAnchor = new GPoint(5, 5);
    iconBlue.infoWindowAnchor = new GPoint(5, 1);

    var iconRed = new GIcon(); 
    iconRed.image = 'http://'+ document.domain +'/skins/cash/images/allocated.png';
    iconRed.iconSize = new GSize(10, 10);
    iconRed.iconAnchor = new GPoint(5, 5);
    iconRed.infoWindowAnchor = new GPoint(5, 1);

    var customIcons = [];
    customIcons["0"] = iconRed;
    customIcons["1"] = iconBlue;
    customIcons["2"] = iconRed;
    customIcons["3"] = iconBlue;
    customIcons["4"] = iconBlue;
    customIcons["5"] = iconBlue;
    customIcons["6"] = iconBlue;

    function load() {
      if (GBrowserIsCompatible()) {
      	
        var map = new GMap2(document.getElementById("map"));
        map.addControl(new GLargeMapControl());
        map.addControl(new GMapTypeControl());
        map.enableScrollWheelZoom();
        map.setCenter(new GLatLng(54.367758, -3.383789), 6);

        GDownloadUrl("http://"+ document.domain +"/cache/distribution.xml", function(data) {
          var xml = GXml.parse(data);
          var markers = xml.documentElement.getElementsByTagName("marker");
          for (var i = 0; i < markers.length; i++) {
            var name = markers[i].getAttribute("name");
            var address = markers[i].getAttribute("address");
            var type = markers[i].getAttribute("type");
            var point = new GLatLng(parseFloat(markers[i].getAttribute("lat")),
                                    parseFloat(markers[i].getAttribute("lng")));
            var marker = createMarker(point, name, address, type);
            map.addOverlay(marker);
          }
        });
      }
    }

    function createMarker(point, name, address, type) {
      var marker = new GMarker(point, customIcons[type]);
      var html = "<b>" + name + "</b> <br/>" + address;
      
      return marker;
    }
    
    document.onload = load();