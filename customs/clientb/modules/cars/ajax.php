<h1>Voitures Client B</h1>
<div id="data-containerB"></div>
<script>
    $.getJSON('/data/garages.json').done(function(garage) {
        $.getJSON('/data/cars.json').done(function(data) {
            console.log(data);
            $.each(data, function(index, car) {
                const garageTitle = garage[car.garageId - 1] ? garage[car.garageId - 1].title : "Garage inconnu";
                $("#data-containerB").append(
                    "<li>" + car.modelName + " " + car.brand + " " + garageTitle + "</li>"
                );
            
            });
        });
    });
</script>