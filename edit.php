<div id="details-container"></div>
<script>
    const carId = <?= json_encode($_GET['id'] ?? null); ?>;
    $.getJSON('/data/cars.json', function(data) {
        console.log(data[1]);
        const date = new Date(data[carId].year * 1000);
        const formattedDate = date.getFullYear();

        $("#details-container").append(
            "<li>" + data[carId].modelName + " " + data[carId].brand + " " + formattedDate + " " + data[carId].power + "cv</li> "
        );
    });
</script>