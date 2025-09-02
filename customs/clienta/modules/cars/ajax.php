<h1>Voitures Client A</h1>
<div id="data-containerA"></div>
<script>
    $.getJSON('/data/cars.json', function(data) {
        console.log(data);
        $.each(data, function(index, car) {
            debugger;
            var date = new Date(car.year * 1000);
            var formattedDate = date.getFullYear();
            
            var currentYear = new Date().getFullYear();
            var carAge = currentYear - formattedDate;
            
            var AgeColor = '';
            if (carAge > 10) {
                AgeColor = 'background-color: #ffcccc; color: #cc0000;';
            } else if (carAge < 2) {
                AgeColor = 'background-color: #ccffcc; color: #006600;';
            }

            $("#data-containerA").append(
                "<li style='" + AgeColor + " padding: 5px; margin: 2px;'>" + 
                car.modelName + " " + car.brand + " " + formattedDate + " " + car.power + "cv " +
                "<button class='loadDetails' data-id='" + car.id + "'>En savoir plus</button>" +
                "</li>"
            );
            
        });
    });
</script>