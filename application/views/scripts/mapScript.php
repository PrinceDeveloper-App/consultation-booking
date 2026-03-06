<script>
    // Initialize map
    function initMap() {
      // Example coordinates (e.g. New Delhi)
      const location = { lat: 28.6139, lng: 77.2090 };

      // Create map
      const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 12,
        center: location,
      });

      // Add marker
      const marker = new google.maps.Marker({
        position: location,
        map: map,
        title: "My Location",
      });
    }
  </script>