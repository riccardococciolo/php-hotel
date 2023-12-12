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

    if (isset($_GET['parking']) && $_GET['parking'] !== '') {
        $parkingFilter = filter_var($_GET['parking'], FILTER_VALIDATE_BOOLEAN);
        $hotels = array_filter($hotels, function ($hotel) use ($parkingFilter) {
            return $hotel['parking'] === $parkingFilter;
        });
    }
    
    if (isset($_GET['minVote']) && $_GET['minVote'] !== '') {
        $minVoteFilter = filter_var($_GET['minVote'], FILTER_VALIDATE_INT);
        $hotels = array_filter($hotels, function ($hotel) use ($minVoteFilter) {
            return $hotel['vote'] >= $minVoteFilter;
        });
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<form method="get">
    <label for="parking">Parcheggio:</label>
    <select name="parking" id="parking">
        <option value="">Qualsiasi</option>
        <option value="1">Sì</option>
        <option value="0">No</option>
    </select>

    <label for="minVote">Voto minimo:</label>
    <input type="number" name="minVote" id="minVote" min="1" max="5">

    <button type="submit">Filtra</button>
</form>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">NOME</th>
      <th scope="col">DESCRIZIONE</th>
      <th scope="col">PARCHEGGIO</th>
      <th scope="col">VOTO</th>
      <th scope="col">DISTANZA DAL CENTRO</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($hotels as $hotel) { ?>
    <tr>
      <th scope="row"><?php echo $hotel['name']; ?></th>
      <td><?php echo $hotel['description']; ?></td>
      <td><?php echo $hotel['parking'] ? 'Sì' : 'No'; ?></td>
      <td><?php echo $hotel['vote']; ?></td>
      <td><?php echo $hotel['distance_to_center']; ?></td>
    </tr>
    <?php } ?> 
  </tbody>
</table>
</body>
</html>