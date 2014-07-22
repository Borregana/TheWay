
var markersArray = [];
var routeArray = [];

function submitRoute() {
    var p = "";
    for (var i=0; i<routeArray.length; i++) {
        p += routeArray[i].getPosition().toString() + "\n";
    }
    var parametros = {
        "lines" : p,
        "nocache" : Math.random() // no cache
    };

    $.ajax({
        data:  parametros,
        url:   'saveRoute.php',
        type:  'post',
        success:  function (response) {
            alert(response);
        }
    });
}

function submitMarker(){
    var s = "";
    for (var i=0; i<markersArray.length; i++) {
        s += markersArray[i].getPosition().toString();
    }
    var parametros = {
        "puntos" : s,
        "nocache" : Math.random() // no cache
    };

    $.ajax({
        data:  parametros,
        url:   'saveMarkers.php',
        type:  'post',
        success:  function (response) {
            alert(response);
        }

    });
}

function initialize() {

    var mapOptions = {
        center: new google.maps.LatLng(39.8867882,-0.0867385,15),
        zoom: 14
    };

    var map = new google.maps.Map(document.getElementById('map-canvas'),
        mapOptions);

    var contentString = '<div>'+
        '<form  id="punto" action="infoPunto.php" class="smart-form client-form" method="post">'+
        '<header>'+
        'Punto de Interes'+
        '</header>'+
        '<fieldset>'+
        '<section>'+
        '<label class="input"> <i class="icon-append fa fa-picture-o"></i>'+
        '<input type="text" name="nombre" placeholder="Nombre">'+
        '<b class="tooltip tooltip-bottom-right">Nombre del punto</b> </label>'+
        '</section>'+
        '</fieldset>'+
        '<footer>'+
        '<button type="submit" class="btn btn-primary" onclick="submitPoint()">'+
        'Guardar'+
        '</button>'+
        '</footer>'+
        '</form>'+
        '</div>';

    function submitPoint(){
        var puntos="";

        $.ajax({
            data: puntos,
            url: 'infoPunto.php',
            type: 'post',
            success:  function (response) {
                alert(response);
            },
            error: alert(error)
        });
    }
    var infoWindow = new google.maps.InfoWindow({
        content: contentString
    });
    var drawingManager = new google.maps.drawing.DrawingManager({
        //drawingMode: google.maps.drawing.OverlayType.MARKER,
        drawingControl: true,
        drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: [
                google.maps.drawing.OverlayType.MARKER,
                google.maps.drawing.OverlayType.POLYLINE
                // google.maps.drawing.OverlayType.CIRCLE,
            ]
        },
        markerOptions: {
            editable: true,
            draggable: true
        },

        polylineOptions: {
            editable: true,
            draggable: true
        }

        // circleOptions: {
        //     editable: true,
        // }
    });

    drawingManager.setMap(map);

    function setAllMap(map){
        for(var i = 0; i< markersArray.length; i++){
            markersArray[i].setMap(map);
        }
    }

    function clearMarkers(){
        setAllMap(null);
    }

    function deleteMarkers(){
        clearMarkers();
        markersArray=[];
    }

    // var bounds = new google.maps.LatLngBounds(
    // 	new google.maps.LatLng(-32, 150),
    // 	new google.maps.LatLng(-33, 151)
    // );

    // // Define a rectangle and set its editable property to true.
    // var rectangle = new google.maps.Rectangle({
    // 	bounds: bounds,
    // 	editable: true
    // });

    // rectangle.setMap(map);

    google.maps.event.addListenerOnce(map, 'idle', function() {
        // do something only the first time the map is loaded
        $(".gmnoprint").each(function() {
            var newObj = $(this).find("[title='Stop drawing']");
            newObj.attr('id', 'btnStop');

            // ID the toolbar
            newObj.parent().parent().attr("id", "btnBar");

            // ID the Marker button
            newObj = $(this).find("[title='Add a marker']");
            newObj.attr('id', 'btnMarker');

            // ID the line button
            newObj = $(this).find("[title='Draw a line']");
            newObj.attr('id', 'btnLine');
        });

        $("#btnBar").append('<div style="float: left; line-height: 0;"><div id="btnRoute" style="direction: ltr; overflow: hidden; text-align: left; position: relative; color: rgb(51, 51, 51); font-family: Arial,sans-serif; -moz-user-select: none; font-size: 13px; background: none repeat scroll 0% 0% rgb(255, 255, 255); padding: 4px; border-width: 1px 1px 1px 0px; border-style: solid solid solid none; border-color: rgb(113, 123, 135) rgb(113, 123, 135) rgb(113, 123, 135) -moz-use-text-color; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4); font-weight: normal;" title="Delete Selected"><span style="display: inline-block;"><div style="width: 16px; height: 16px; overflow: hidden; position: relative;"><img style="position: absolute; left: 0px; top: -195px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; width: 16px; height: 350px;" src="goma.png" draggable="false"></div></span></div></div>');

        $("#btnBar").append('<div style="float: left; line-height: 0;"><div id="btnSave" style="direction: ltr; overflow: hidden; text-align: left; position: relative; color: rgb(51, 51, 51); font-family: Arial,sans-serif; -moz-user-select: none; font-size: 13px; background: none repeat scroll 0% 0% rgb(255, 255, 255); padding: 4px; border-width: 1px 1px 1px 0px; border-style: solid solid solid none; border-color: rgb(113, 123, 135) rgb(113, 123, 135) rgb(113, 123, 135) -moz-use-text-color; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4); font-weight: normal;" title="Save"><span style="display: inline-block;"><div style="width: 16px; height: 16px; overflow: hidden; position: relative;"><img style="position: absolute; left: 0px; top: -195px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; width: 16px; height: 350px;" src="save.png" draggable="false"></div></span></div></div>');

        // google.maps.event.addDomListener(document.getElementById('btnDelete'), 'click', deleteSelectedShape);
        // google.maps.event.addDomListener(document.getElementById('btnDelete'), 'mousedown', function () {
        //     $("#btnDelete img").css("top", "-212px");
        // });
        // google.maps.event.addDomListener(document.getElementById('btnDelete'), 'mouseup', function () {
        //     $("#btnDelete img").css("top", "-195px");
        // });

        google.maps.event.addDomListener(document.getElementById('btnSave'), 'click', submitMarker);
        google.maps.event.addDomListener(document.getElementById('btnRoute'), 'click', submitRoute);

        google.maps.event.addListener(drawingManager, 'markercomplete', function(marker) {
            markersArray.push(marker);
        });
        google.maps.event.addListener(marker,'click', function(){
            infoWindow.open(map,marker);
        });
        google.maps.event.addListener(drawingManager, 'linecomplete', function(line) {
            routeArray.push(line);
        });

    });
    var myLatlng = new google.maps.LatLng(39.8867882,-0.0867385,15);

    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title:"Hello World!"
    });


    marker.setMap(map);

}

google.maps.event.addDomListener(window, 'load', initialize);

