<!-- Leaflet CSS and JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<div id="region_map" style="height: 600px;"></div>

<script>
    const map = L.map('region_map').setView([26.8, 88.5], 5);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const coordinates = {
        'IN-UP': [26.8467, 80.9462],
        'IN-DL': [28.6139, 77.2090],
        'IN-BR': [25.0961, 85.3131],
        'IN-MH': [19.7515, 75.7139],
        'IN-TN': [13.0827, 80.2707],
        'IN-KA': [12.9716, 77.5946],
        'IN-WB': [22.9868, 87.8550],
        'BT-15': [27.4728, 89.6390],
        'BT-11': [27.4305, 89.4136],
        'BT-14': [26.8997, 89.0971],
        // Add more or fallback
    };

    const memberCounts = @json($memberCounts);
    const regions = @json($regions);

    for (const country in regions) {
        regions[country].forEach(state => {
            const code = state.state_code;
            const name = state.state_name;
            const count = memberCounts[code] ?? 0;

            const latlng = coordinates[code] ?? [23.5937, 80.9629];

            // Red circle based on count
            const circle = L.circle(latlng, {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.4,
                radius: count * 5000
            }).addTo(map);

            circle.bindPopup(`<strong>${name}</strong><br>Members: ${count}`);

            // Black box label with count
            L.marker(latlng, {
                icon: L.divIcon({
                    className: 'custom-label',
                    html: `<div style="color:white;padding:3px 6px;border-radius:4px;font-size:12px;font-weight:bold;">${count}</div>`,
                    iconAnchor: [10, 10]
                })
            }).addTo(map);
        });
    }
</script>
