<!doctype html>
<html lang="pl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>OPONY</title>
  <link rel="stylesheet" href="styl.css" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=ac_unit" />
</head>

<body>
  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "opony";

  $connection = mysqli_connect(hostname: $servername, username: $username, password: $password = "", database: $dbname);
  header('refresh: 10;');
  mysqli_close($connection);
  ?>
  <main class="blokGlowny">
    <aside class="blokBoczny">
      <?php
      $connection = mysqli_connect(hostname: $servername, username: $username, password: $password = "", database: $dbname);
      $query1 = "SELECT * FROM `opony` ORDER BY cena ASC LIMIT 10;";
      $result1 = mysqli_query($connection, $query1);

      while ($opona = mysqli_fetch_array($result1)) {
        if ($opona['sezon'] == "letnia") {
          $img = 'lato.png';
        } else if ($opona['sezon'] == "zimowa") {
          $img = 'zima.png';
        } else if ($opona['sezon'] == "uniwersalna") {
          $img = 'uniwer.png';
        }
        echo "<div class='opona'>
        <img src= {$img} alt='img'>
        <h4> Opona: {$opona['producent']} {$opona['model']} </h4>
        <h3> Cena: {$opona['cena']} </h3>
        </div>";
      }


      mysqli_close($connection);
      ?>
      <p><a href="https://opona.pl/">więcej ofert</a></p>
    </aside>
    <section class="Sekcja1i2">
      <section class="Sekcja1">
        <img src="opona.png" alt="Opona" />
        <h2>Opona dnia</h2>
        <?php
        $connection = mysqli_connect(hostname: $servername, username: $username, password: $password = "", database: $dbname);
        $query2 = "SELECT opony.producent,opony.model,opony.sezon,opony.cena FROM `opony` WHERE opony.nr_kat = 9;";
        $result2 = mysqli_query($connection, $query2);
        while($opona = mysqli_fetch_array($result2)){
        echo "<h2>{$opona['producent']} model {$opona['model']}</h2>
        <h2>Sezon: {$opona['sezon']}</h2>
        <h2>Tylko {$opona['cena']} zł!</h2>
        ";
        }
        mysqli_close($connection);
        ?>
      </section>
      <section class="Sekcja2">
        <h2>Najnowsze zamówienie</h2>
        <?php
        $connection = mysqli_connect(hostname: $servername, username: $username, password: $password = "", database: $dbname);
        $query3 = "SELECT zamowienie.id_zam,zamowienie.ilosc,opony.model,opony.cena FROM `zamowienie`,`opony` WHERE opony.nr_kat=zamowienie.nr_kat ORDER BY RAND() LIMIT 1;";
        $result3 = mysqli_query($connection, $query3);
        $opona = mysqli_fetch_array($result3);
        $wartosc = $opona['cena'] * $opona['ilosc'];
        echo "<h2>{$opona['id_zam']} {$opona['ilosc']} sztuki modelu {$opona['model']}</h2>
        <h2>Wartość zamówienia {$wartosc} zł</h2>";
        mysqli_close($connection);
        ?>
      </section>
    </section>
  </main>
  <footer class="blokStopki">
    <p>Stronę wykonał: EwaSladkowa</p>
  </footer>
</body>

</html>