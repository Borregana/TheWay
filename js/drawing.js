
var markersArray = [];
var routeArray = [];

function submitRoute() {
    var p = "";
    for (var i=0; i<routeArray.length; i++) {
        p += routeArray[i].getPath().getArray().toString() + "\n";
    }
    var s = "";
    for (var j=0; i<markersArray.length; j++) {
        s += markersArray[i].getPosition().toString();
    }
    var parametros = {
        "lines" : p,
        "puntos": s,
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
        drawingControl: true,
        drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: [
                google.maps.drawing.OverlayType.MARKER,
                google.maps.drawing.OverlayType.POLYLINE
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
    });

    drawingManager.setMap(map);

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

        $("#btnBar").append('<div style="float: left; line-height: 0;"><div id="btnRoute" style="direction: ltr; overflow: hidden; text-align: left; position: relative; color: rgb(51, 51, 51); font-family: Arial,sans-serif; -moz-user-select: none; font-size: 13px; background: none repeat scroll 0% 0% rgb(255, 255, 255); padding: 4px; border-width: 1px 1px 1px 0px; border-style: solid solid solid none; border-color: rgb(113, 123, 135) rgb(113, 123, 135) rgb(113, 123, 135) -moz-use-text-color; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4); font-weight: normal;" title="Save Route"><span style="display: inline-block;"><div style="width: 16px; height: 16px; overflow: hidden; position: relative;"><img style="position: absolute; left: 0px; top: -195px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; width: 16px; height: 350px;" src="img/goma.png" draggable="false"></div></span></div></div>');

        $("#btnBar").append('<div style="float: left; line-height: 0;"><div id="btnSave" style="direction: ltr; overflow: hidden; text-align: left; position: relative; color: rgb(51, 51, 51); font-family: Arial,sans-serif; -moz-user-select: none; font-size: 13px; background: none repeat scroll 0% 0% rgb(255, 255, 255); padding: 4px; border-width: 1px 1px 1px 0px; border-style: solid solid solid none; border-color: rgb(113, 123, 135) rgb(113, 123, 135) rgb(113, 123, 135) -moz-use-text-color; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4); font-weight: normal;" title="Save"><span style="display: inline-block;"><div style="width: 16px; height: 16px; overflow: hidden; position: relative;"><img style="position: absolute; left: 0px; top: -195px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; width: 16px; height: 350px;" src="img/save.png" draggable="false"></div></span></div></div>');



        google.maps.event.addDomListener(document.getElementById('btnSave'), 'click', submitMarker);
        google.maps.event.addDomListener(document.getElementById('btnRoute'), 'click', submitRoute);

        google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
            if(event.type == google.maps.drawing.OverlayType.POLYLINE) {
                google.maps.event.addListener(drawingManager, 'polylinecomplete', function(polyline) {
                    routeArray.push(polyline);
                });
            }
            else if(event.type == google.maps.drawing.OverlayType.MARKER) {
                    var newMarker = event.overlay;
                    newMarker.content = contentString + markersArray.length;
                    google.maps.event.addListener(newMarker, 'click', function() {
                        infoWindow.setContent(this.content);
                        infoWindow.open(map, this);
                    });
                    markersArray.push(newMarker);
                }
            });
           });
    }

    google.maps.event.addDomListener(window, 'load', initialize);

