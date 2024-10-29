<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Places Autocomplete</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmX5w5ltGt09cjDod_YMamphRRgS8L-ZQ&libraries=places"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
    </style>
</head>
<body>
    <h1>Google Places Autocomplete</h1>
    <input id="source" type="text" placeholder="Enter a location" style="width: 300px;" />

    <div>
        <p id="latitude">Latitude: <span></span></p>
        <p id="longitude">Longitude: <span></span></p>
    </div>

    <script>
        $(document).ready(function () {
            // Initialize the Autocomplete object for the input field
            var source = new google.maps.places.Autocomplete(document.getElementById('source'), {
                types: ['geocode']
            });

            // Add an inline event listener for 'place_changed'
            source.addListener('place_changed', function () {
                // Get the place details from the autocomplete object
                var place = source.getPlace();

                // Check if the place has geometry
                if (place.geometry) {
                    var lat = place.geometry.location.lat();
                    var lng = place.geometry.location.lng();
                    console.log('Latitude:', lat);
                    console.log('Longitude:', lng);
                } else {
                    console.log('No geometry data found for this place.');
                }
            });
        });
    </script>
</body>
</html>