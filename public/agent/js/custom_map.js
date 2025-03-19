function initMap(latitude = 41.015137, longitude = 28.979530, want_to_change = false) {
    const map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: latitude, lng: longitude },
        zoom: 16,
        mapTypeControl: false,
    });

    const input = document.getElementById("pac-input");
    const options = {
        types: ['geocode'],
    };

    const autocomplete = new google.maps.places.Autocomplete(input, options);
    autocomplete.bindTo("bounds", map);

    let marker;
    if (want_to_change) {
        marker = new google.maps.Marker({
            map,
            anchorPoint: new google.maps.Point(0, -29),
            position: map.getCenter(),
            draggable: want_to_change,
        });
    } else {
        marker = new google.maps.Marker({
            map,
            anchorPoint: new google.maps.Point(0, -29),
            position: map.getCenter(),
        });
    }

    autocomplete.addListener("place_changed", () => {
        marker.setVisible(false);
        const place = autocomplete.getPlace();
        if (!place.geometry || !place.geometry.location) {
            window.alert("No hay detalles disponibles para la entrada: '" + place.name + "'");
            return;
        }
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
        updateInputField(place.geometry.location);
    });

    // Add listener for marker's dragend event only if want_to_change is true
    if (want_to_change) {
        google.maps.event.addListener(marker, 'dragend', function () {
            updateInputField(marker.getPosition());
            fetchAddress(marker.getPosition());
        });

        google.maps.event.addListener(map, 'click', function (event) {
            marker.setPosition(event.latLng);
            marker.setVisible(true);
            updateInputField(event.latLng);
            fetchAddress(event.latLng);
        });
    }

    // Function to update the input field with the Google Maps link
    function updateInputField(location) {
        if (want_to_change) {
            const property_latitude = document.getElementById("property_latitude");
            const property_longitude = document.getElementById("property_longitude");
            property_latitude.value = location.lat();
            property_longitude.value = location.lng();
        }
    }

    function fetchAddress(latLng) {
        const geocoder = new google.maps.Geocoder();
        geocoder.geocode({ 'location': latLng }, function (results, status) {
            if (status === 'OK') {
                if (results[0]) {
                    input.value = results[0].formatted_address;
                }
            } else {
                console.log('Geocoder failed due to: ' + status);
            }
        });
    }

    // Add custom control button
    const controlDiv = document.createElement('div');
    createCustomControl(controlDiv, map);

    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(controlDiv);

    function createCustomControl(controlDiv, map) {
        const controlUI = document.createElement('div');
        controlUI.style.backgroundColor = '#fff';
        controlUI.style.border = '2px solid #fff';
        controlUI.style.borderRadius = '3px';
        controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUI.style.cursor = 'pointer';
        controlUI.style.marginTop = '8px';
        controlUI.style.marginRight = '10px';
        controlUI.style.textAlign = 'center';
        controlUI.title = 'Click to open Google Maps';
        controlDiv.appendChild(controlUI);

        const controlText = document.createElement('div');
        controlText.style.color = 'rgb(25,25,25)';
        controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
        controlText.style.fontSize = '16px';
        controlText.style.lineHeight = '38px';
        controlText.style.paddingLeft = '5px';
        controlText.style.paddingRight = '5px';
        controlText.innerHTML = 'Open in Google Maps';
        controlUI.appendChild(controlText);

        controlUI.addEventListener('click', () => {
            const lat = marker.getPosition().lat();
            const lng = marker.getPosition().lng();
            const googleMapsUrl = `https://www.google.com/maps?q=${lat},${lng}`;
            window.open(googleMapsUrl, '_blank');
        });
    }
}

window.initMap = initMap;
