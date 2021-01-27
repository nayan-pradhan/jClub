<?php

include_once 'head.php';
?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

<?php

include_once 'nav.php';
?>

<!-- For displaying current user's location -->
<div id="mapid" style="height:600px;margin-top:100px;"></div>

<script>
    api_url = 'http://ipinfo.io/?token=e6555b96b138dd';

    async function getdata() {
        response = await fetch(api_url);
        data = await response.json();
        var loc = data.loc.split(",");
        var lat = loc[0];
        var lon = loc[1];
        var ip = data.ip;
        console.log(lat);
        console.log(lon);

        var mymap = L.map('mapid').setView([lat, lon], 14);
        var marker = L.marker([lat, lon]).addTo(mymap);
        var circle = L.circle([lat, lon], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0,
            radius: 800
        }).addTo(mymap);
        marker.bindPopup('IP: '+ip).openPopup();
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiYXBhbmRpdDEiLCJhIjoiY2tpNGwwbTQ4MmhyYzJxbXBwaXJjNjNndSJ9.vkD7xj8wWQ8O9KjxchedQQ'
        }).addTo(mymap);
    }
    getdata();
</script>

<?php

include_once 'footer.php';

?>