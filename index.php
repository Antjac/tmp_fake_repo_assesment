<?php
$clients = ['clienta', 'clientb', 'clientc'];
$clientCookie = $_COOKIE['client_id'] ?? 'clienta';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client = $_POST['client'] ?? '';
    if (in_array($client, $clients)) {
        setcookie('client_id', $client, time() + 3600, '/');
        header('Location: index.php');
        exit;
    } else {
        echo "<p style='color:red;'>Sélectionnez un client valide.</p>";
    }
}

$clients_To_Show = $clientCookie ? array_values(array_filter($clients, function($c) use ($clientCookie) {
    return $c !== $clientCookie;
})) : $clients;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tool4cars</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function () {
            console.log("Client actuel: <?= $clientCookie ?>");
            const client = "<?= $clientCookie ?>";
            if (client) {
                const module = $(".dynamic-div").data("module");
                const script = $(".dynamic-div").data("script");
                const url = `http://mrt4s:8080/customs/${client}/modules/${module}/${script}.php`;

                // Charger dynamiquement le contenu dans la div
                $(".dynamic-div").load(url, function (response, status, xhr) {
                    if (status === "error") {
                        $(this).html("<p>Erreur lors du chargement du fichier.</p>");
                    }
                });
            }
        });

        $(document).on("click", ".loadDetails", function() {
            const carId = $(this).data("id");
            $(".dynamic-div").load("edit.php?id=" + carId);
        });

        $(document).on("click", ".loadGarageDetails", function() {
            const garageId = $(this).data("garage-id");
            $(".dynamic-div").load("edit2.php?id=" + garageId);
        });

        function loadModule($module) {
            const client = "<?= $clientCookie ?>";
            if (client) {
                const url = "http://mrt4s:8080/customs/"+client+"/modules/"+$module+"/ajax.php";
                $(".dynamic-div").load(url);
            }
        }
    </script>
</head>
<body>
    <?php if ($clientCookie === 'clientb'): ?>
    <div id="module-navigation">
        <button onclick="loadModule('cars')">Module Voitures</button>
        <button onclick="loadModule('garage')">Module Garages</button>
    </div>
    <?php endif; ?>
    
    <form method="post">
        <label for="client">Je suis :</label>
        <select name="client" id="client" required>
            <option value="">--Choisir un client--</option>
            <?php foreach ($clients_To_Show as $client): ?>
                <option value="<?= $client ?>"><?= ucfirst($client) ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Se connecter</button>
    </form>
    <div class="dynamic-div" data-module="cars" data-script="ajax"></div>
</body>
</html>