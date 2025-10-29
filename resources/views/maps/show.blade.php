<!DOCTYPE html>
<html>
<head>
    <title>Member Count Map</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #region_map {
            height: 600px;
            width: 100%;
        }
        .circle-label {
            background: white;
            border-radius: 8px;
            padding: 2px 6px;
            font-weight: bold;
            font-size: 12px;
            box-shadow: 0 0 3px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>
    <div id="region_map"></div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script nonce="{{ $cspNonce }}">        const regionMap = L.map('region_map').setView([26.8, 88.5], 5);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OSM Contributors'
        }).addTo(regionMap);

        // Predefined coordinates for selected states
        const coordinates = {
            "Uttar Pradesh": [26.8467, 80.9462],
            "Maharashtra": [19.7515, 75.7139],
            "Tamil Nadu": [11.1271, 78.6569],
            "Delhi": [28.7041, 77.1025],
            "Gujarat": [22.2587, 71.1924],
            "Karnataka": [15.3173, 75.7139],
            "West Bengal": [22.9868, 87.8550],
            "Bihar": [25.0961, 85.3131],
            "Rajasthan": [27.0238, 74.2179],
            "Punjab": [31.1471, 75.3412],
            "Thimphu": [27.4728, 89.6390],
            "Paro": [27.4305, 89.4167],
            "Punakha": [27.5946, 89.8775],
            "Wangdue Phodrang": [27.4408, 89.8996],
            "Trongsa": [27.5, 90.5]
        };

        const regions = @json($regions);

        regions.forEach(region => {
            const coords = coordinates[region.name];
            if (coords) {
                const diameter = 30 + region.count * 0.2;

                const icon = L.divIcon({
                    className: '',
                    html: `<div style="
                        width: ${diameter}px;
                        height: ${diameter}px;
                        background: #89CFF0;
                        border: 2px solid #0047AB	;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-weight: bold;
                        font-size: 14px;
                        box-shadow: 0 0 6px rgba(72, 70, 70, 0.15);
                    ">${region.count}</div>`,
                    iconSize: [diameter, diameter],
                    iconAnchor: [diameter/2, diameter/2]
                });

                const marker = L.marker(coords, { icon: icon }).addTo(regionMap);

                // Show region name on hover
                marker.bindTooltip(region.name, {
                    permanent: false,   // Only show on hover
                    direction: 'top',
                    className: 'circle-label'
                });

                // (Optional) Show region name on click as a popup
                marker.bindPopup(`<b>${region.name}</b><br>Members: ${region.count}`);
            }
        });
    </script>
</body>
</html>
