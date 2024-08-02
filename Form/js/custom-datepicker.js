jQuery(document).ready(function($) {
    // Initialize the datepicker
    $('#time_input').datepicker({
        dateFormat: 'mm/dd/yy', // Adjust the date format as needed
        showAnim: 'slideDown'   // Optional: animation for showing the calendar
    });

    // Automatically open the datepicker when the input is clicked
    $('#time_input').on('focus', function() {
        $(this).datepicker('show');
    });
});

let map;
let directionsService;
let directionsRenderer;

function initMap() {
    const initialLocation = { lat: 44.9799, lng: -93.2638 }; // Default location (Minneapolis)

    // Create the map
    map = new google.maps.Map(document.getElementById('map'), {
        center: initialLocation,
        zoom: 10,
    });

    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer();
    directionsRenderer.setMap(map);

    // Autocomplete for origin input
    const originInput = document.getElementById('origin-input');
    const originAutocomplete = new google.maps.places.Autocomplete(originInput);
    originAutocomplete.bindTo('bounds', map);

    originAutocomplete.addListener('place_changed', () => {
        const place = originAutocomplete.getPlace();
        if (place.geometry) {
            map.setCenter(place.geometry.location);
            new google.maps.Marker({
                position: place.geometry.location,
                map: map,
            });
            calculateAndDisplayRoute(); // Calculate route after selecting an origin
        }
    });

    // Autocomplete for destination input
    const destinationInput = document.getElementById('destination-input');
    const destinationAutocomplete = new google.maps.places.Autocomplete(destinationInput);
    destinationAutocomplete.bindTo('bounds', map);

    destinationAutocomplete.addListener('place_changed', () => {
        calculateAndDisplayRoute(); // Calculate route after selecting a destination
    });
}

function calculateAndDisplayRoute() {
    const origin = document.getElementById('origin-input').value;
    const destination = document.getElementById('destination-input').value;

    if (origin && destination) {
        directionsService.route({
            origin: origin,
            destination: destination,
            travelMode: google.maps.TravelMode.DRIVING,
        }, (response, status) => {
            if (status === 'OK') {
                directionsRenderer.setDirections(response);
                const distance = response.routes[0].legs[0].distance.text;
                const duration = response.routes[0].legs[0].duration.text;
                document.getElementById('distance').textContent = `Distance: ${distance}, Duration: ${duration}`;
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        });
    } else {
        alert("Please enter a valid starting location and destination.");
    }
}

// Load the map when the window loads
window.onload = initMap;
