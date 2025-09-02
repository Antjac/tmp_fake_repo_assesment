<div id="garage-details-container"></div>
<script>
    var garageId = <?= json_encode($_GET['id'] ?? null); ?>;

    if (garageId !== null) {
        $.getJSON('/data/garages.json', function(data) {
            if (data[garageId - 1]) {
                const garage = data[garageId - 1];
                $("#garage-details-container").append(
                    "<h2>Détails du garage</h2>" +
                    "<p><strong>Nom:</strong> " + garage.title + "</p>" +
                    "<p><strong>Localisation:</strong> " + garage.address + "</p>"
                );
            } 
        });
    }
</script>