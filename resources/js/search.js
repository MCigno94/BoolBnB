import tt from '@tomtom-international/web-sdk-maps';


let latitude = document.querySelector('#map').getAttribute('latitude');
let longitude = document.querySelector('#map').getAttribute('longitude');

console.log(latitude, longitude);
let speedyPizzaCoordinates = [longitude, latitude];

const map = tt.map({
    container: 'map',
    key: 'kZ6HRy3q9inkB8ydTon7vCtbYvd6yMSV',
    center: speedyPizzaCoordinates,
    zoom: 15
});

let marker = new tt.Marker().setLngLat(speedyPizzaCoordinates).addTo(map);

//document.querySelector('#map').getAttribute('latitude')