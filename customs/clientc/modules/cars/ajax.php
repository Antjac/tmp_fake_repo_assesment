<h1>Voitures Client C</h1>
<div id="data-containerC"></div>
<script>
    $.getJSON('/data/garages.json').done(function(garage) {
        $.getJSON('/data/cars.json').done(function(data) {
            console.log(data);
            $.each(data, function(index, car) {
                const garageTitle = garage[car.garageId - 1] ? garage[car.garageId - 1].title : "Garage inconnu";
                $("#data-containerC").append(
                    "<li id='couleur' style='background-color:" + car.colorHex + "; color: #fff; padding: 5px;'>" + car.modelName + " " + car.brand +  " " + garageTitle + " "   + car.power + "cv " + "</li>"
                );
                
            });
        });
    });
</script>