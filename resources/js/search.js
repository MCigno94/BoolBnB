import { services } from '@tomtom-international/web-sdk-services';
import SearchBox from '@tomtom-international/web-sdk-plugin-searchbox';
//import tt from '@tomtom-international/web-sdk-services';
import tt from '@tomtom-international/web-sdk-maps';

var lat = 45.87162000;
var lon = 8.91306000;
var coordinates = [lon, lat];
var map = tt.map({
    container: 'map',
    key: 'kZ6HRy3q9inkB8ydTon7vCtbYvd6yMSV',
    //style: 'tomtom://vector/1/basic-main',
    center: coordinates,
    zoom: 10
});
var marker = new tt.Marker().setLngLat(coordinates).addTo(map);
map.addControl(new tt.FullscreenControl());
map.addControl(new tt.NavigationControl());
var popupOffsets = {
    top: [0, 0],
    bottom: [0, -40],
    'bottom-right': [0, -70],
    'bottom-left': [0, -70],
    left: [25, -35],
    right: [-25, -35]
}
var popup = new tt.Popup({
    offset: popupOffsets
}).setHTML(`${this.name}<br>${this.address}`);
marker.setPopup(popup).togglePopup();