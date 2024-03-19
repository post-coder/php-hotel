<?php

$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],

];


// inizializzo il mio array uguale agli hotel iniziali
$filteredHotels = $hotels;

// per evitare il warning quando andiamo ad accedere al parametro parking-check anche quando non è stato settato nell'url
if( isset($_GET['parking-check']) && $_GET['parking-check'] == true ) {
    // filtrare gli hotel
    // echo "parcheggio da filtrare";

    // creo un nuovo array che conterrà gli hotel filtrati
    $filteredHotels = [];

    // ciclo gli hotel
    foreach($hotels as $currentHotel) {

        // var_dump($currentHotel);
        // se l'hotel corrente ha il parcheggio, lo inserisco nel nuovo array
        if($currentHotel['parking']) {
            // lo pusho nel nuovo array
            $filteredHotels[] = $currentHotel;
        }

    }

    // per debug, mostro il nuovo array
    // var_dump($filteredHotels);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - Hotel</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body data-bs-theme="dark">

    <div class="container py-5">
        <h1 class="mb-4">PHP - Hotel</h1>

        <form method="GET" action="index.php">
            <h2>
                Filtri
            </h2>
            <div class="row row-cols-2 mb-4">
                <div class="form-check col">
                    <input type="checkbox" class="form-check-input" name="parking-check" id="parking-check" value="true">
                    <label class="form-check-label" for="parking-check">Filtra per parcheggio</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Filtra</button>
        </form>

        <hr class="my-4">

        <table class="table border border-2">
            <thead class="table-primary">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Parcheggio</th>
                    <th scope="col">Voto</th>
                    <th scope="col">Distanza dal centro</th>
                </tr>
            </thead>
            <tbody>
                <?php


                foreach($filteredHotels as $currentHotel) {
                    
                    echo "
                    <tr>
                        <td>" . $currentHotel['name'] . "</td>
                        <td>" . $currentHotel['description'] . "</td>
                        <td>" . ($currentHotel['parking'] ? 'presente' : 'assente') . "</td>
                        <td>" . $currentHotel['vote'] . "</td>
                        <td>" . $currentHotel['distance_to_center'] . " km</td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
    
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>