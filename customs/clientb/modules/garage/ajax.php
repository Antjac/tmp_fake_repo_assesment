<h1>Garages Client B</h1>
<div id="data-containerB-garage"></div>
<script>
    $.getJSON('/data/garages.json', function(data) {
        console.log(data);
        $.each(data, function(index, garage) {
            $("#data-containerB-garage").append(
                "<li><button class='loadGarageDetails' data-garage-id='" + garage.id + "'>" + 
                garage.title + " - " + garage.address + 
                "</button></li>"
            );
        });
    });
</script>