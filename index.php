<?php 

/*

Partiamo da questo array di hotel. https://www.codepile.net/pile/OEWY7Q1G
Stampare tutti i nostri hotel con tutti i dati disponibili.

Bonus:
1 - Aggiungere un form ad inizio pagina che tramite una richiesta GET permetta di filtrare gli hotel che hanno un parcheggio.

2 - Aggiungere un secondo campo al form che permetta di filtrare gli hotel per voto (es. inserisco 3 ed ottengo tutti gli hotel che hanno un voto di tre stelle o superiore)

*/

$hotels = [
  [
    'name' => 'Hotel Belvedere',
    'description' => 'Hotel Belvedere Descrizione',
    'parking' => true,
    'vote' => 4,
    'distance_to_center' => 10.4,
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


// prendo le variabili che mi arrivano dal form tramite GET

$isParkingRequired = $_GET['isParkingRequired'] ?? false;

$minimumVoteRequired = $_GET['vote'] ?? 0;





// anzichè lavorare con valori di stringa "on" e "off", li cambio con i rispettivi booleani
if($isParkingRequired == "on") {
  $isParkingRequired = true;
}


// creiamo un altro array, che corrisponderà solo agli hotel da visualizzare in base ai filtri
$filteredHotels = $hotels;

// filtriamo questi hotel in base alle richieste dell'utente che leggiamo tramite i get
// e modifichiamo quindi gli elementi presenti in questo array
// in pagina poi visualizzeremo solo gli elementi presenti in questo array

// filtro del parcheggio
if($isParkingRequired) {

  // prima lo svuoto
  $tempFilteredHotels = [];

  // per ogni hotel dell'array iniziale, controllo che abbia il parcheggio
  // in quel caso, lo inserisco nell'array degli hotel filtrati

  foreach($hotels as $singleHotel) {

    if($singleHotel['parking'] == true) {
      // pusho questo hotel nell'array degli hotel filtrati
      $tempFilteredHotels[] = $singleHotel;

    }

  }

  // sostituire gli hotel che visualizzo con quelli corrispondenti al nuovo filtro
  $filteredHotels = $tempFilteredHotels;
  
}


// controllo del voto
if($minimumVoteRequired > 0) {

  // dobbiamo filtrare i nostri hotel tenendo nell'array solo quelli dove la proprietà "vote" è >= al voto scelto

  // mi creo un array temporaneo dove filtrerò gli hotel
  $tempFilteredHotels = [];

  // farò il nuovo filtro solo sugli hotel già filtrati
  foreach($filteredHotels as $singleFilteredHotel) {

    // controllo se l'hotel ha il voto maggiore o uguale a quello indicato dall'utente
    if($singleFilteredHotel['vote'] >= $minimumVoteRequired) {

      // in quel caso lo pusho nell'array dei nuovi hotel filtrati
      $tempFilteredHotels[] = $singleFilteredHotel;

    }

  }

  // sostituire gli hotel che visualizzo con quelli corrispondenti al nuovo filtro
  $filteredHotels = $tempFilteredHotels;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Hotel</title>

  <!-- bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>

<h1>Hotels</h1>

<h2>Filtri</h2>

<form action="index.php" method="GET">

  <div class="mb-3">
    <input name="isParkingRequired" type="checkbox" class="btn-check" id="btn-check-outlined" autocomplete="off">
    <label class="btn btn-outline-primary" for="btn-check-outlined">Parcheggio presente</label><br>
  </div>

  <div class="mb-3">
    <label for="vote" class="form-label">Voto minimo</label>
    <input name="vote" type="number" min="1" max="5" id="vote" step="1">
  </div>


  <button class="btn btn-primary" type="submit">Filtra</button>
</form>


<hr>
<pre>
  Output del form:

</pre>

<hr>

  
<table class="table">

  <thead>
    <tr>
      
    <?php 

    foreach($hotels[0] as $chiave => $valore) {

      ?>
      
      <th scope="col"><?php echo $chiave ?></th>

      <?php

    }

    ?>
    
    </tr>
      
  </thead>

  <tbody>

    <?php 
    
    foreach($filteredHotels as $singleHotel) {

      echo "<tr>";

      foreach($singleHotel as $hotelPropertyKey => $hotelPropertyValue) {

        if($hotelPropertyKey == "parking") {

          // codice con if esteso
          /*
          if($hotelPropertyValue == true) {
            ?>
            <td>Sì</td>
            <?php
          } else {
            ?>
            <td>No</td>
            <?php
          }
          */

          // possiamo fare questo controllo con il ternario
          ?>  
          <td> <?php echo $hotelPropertyValue ? 'Sì' : 'No' ?> </td>
          <?php

        } else {

          echo "<td>{$hotelPropertyValue}</td>";

        }

      }

      echo "</tr>";


    }

    ?>

  </tbody>

</table>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>