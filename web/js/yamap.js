ymaps.ready(init);
var myMap,
    markGubina2A;

function init() {   
    myMap = new ymaps.Map("map", {
        center: [43.909557, 42.714101],
        zoom: 17,
        controls: ["default"]
    });

    myMap.controls.remove("geolocationControl");
    myMap.controls.remove("searchControl");
    myMap.controls.remove("trafficControl");
    myMap.behaviors.disable('scrollZoom');

    markGubina2A = new ymaps.Placemark([43.909557, 42.714101], { hintContent: 'Центр недвижимости PLATINUM' });

    myMap.geoObjects.add(markGubina2A);

}
