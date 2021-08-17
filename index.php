<?php

include 'db.php';

$where_arr = [" 1 = 1 "];

if( isset($_GET['ime']) && $_GET['ime'] != "" ){
    $ime = strtolower($_GET['ime']);
    $where_arr[] = " lower(ime) LIKE '%$ime%' ";
}
if (isset($_GET['tip']) && $_GET['tip'] > "0") {
    $id_tip = $_GET['tip'];
    $where_arr[] = " naz.id_tip = $id_tip ";
}
if (isset($_GET['zanr']) && $_GET['zanr'] > "0") {
    $id_zanr = $_GET['zanr'];
    $where_arr[] = " naz.id_zanr = $id_zanr ";
}



$where_str = implode("AND", $where_arr);

$sql = "SELECT naz.id, naz.ime, z.zanr_filma, t.tip_filma, naz.trajanje
            FROM naziv naz, zanr z, tip t
            WHERE naz.id_zanr=z.id 
            AND naz.id_tip=t.id 
            AND $where_str 
            ORDER BY ime ASC";

$res = mysqli_query($dbconn, $sql);
$cnt = mysqli_num_rows($res);

$rez_zanr = mysqli_query($dbconn, "SELECT * FROM zanr");
$rez_tipa = mysqli_query($dbconn, "SELECT * FROM tip");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>IMDb na SPR nacin</title>
</head>

<body style="background-color: #1b1b1b; color: white;">

    <div class="container center">
        <div>
            <p style="color: #f3ce13; font-weight: bold; font-size: 50px; text-align: center;">IMDb na SPR način</p>
        </div>

        

        <div class="nav justify-content-center mb-5 mt-3">
            <ul class="nav nav-pills justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php" style="background-color: #f3ce13;">Filmovi/Serije</a>
                </li>
                <li class="nav-item" >
                    <a class="nav-link" style="color: white;" href="zanrovi/index.php">Žanrovi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="nova_film_serija.php" style="color: white;">+ Dodaj film/seriju</a>
                </li>
            </ul>
        </div>


        <div class="pretraga mb-5">

            <form class="form" action="index.php" method="GET">
                <table class="table table-borderless text-center" style="color: white;">
                    <tr class="boldovano">
                        <td>Naziv</td>
                        <td>Tip</td>
                        <td>Zanr</td> 

                    </tr>
                    <tr>
                        <td>
                            <input class="form-control mb-3" type="text" name="ime" placeholder="Unesi naziv filma">
                        </td>
                        <td>
                            <select name="tip" class="form-control bold">
                                <option value="-1">-izaberi tip-</option>
                                <?php
                                while ($tip = mysqli_fetch_assoc($rez_tipa)) {
                                    $id = $tip['id'];
                                    $naziv = $tip['tip_filma'];
                                    echo "<option value='$id'>$naziv</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td> 
                            <select name="zanr" class="form-control">
                                <option value="-1">-izaberi zanr-</option>
                                <?php
                                while ($zanr = mysqli_fetch_assoc($rez_zanr)) {
                                    $id = $zanr['id'];
                                    $naziv = $zanr['zanr_filma'];
                                    echo "<option value='$id'>$naziv</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td>
                            <button class="btn  btn-warning btn-block" style="color: white; font-weight: bold;">PRETRAGA</button>
            </form>
                        </td>
            <td>
                <a href="./index.php"><button class="btn btn-dark"><i class="fa fa-times"></i></button></a>
            </td>
            </tr>
            </table>

        <div id="istrazi">
            <div>
                <h5 class="text-center mt-5 mb-4">
                    <i class="fa fa-tv"></i> Otkrijte sve filmove i serije na jednom mestu...
                </h5> 
            </div>
            <div id="carouselExampleControls" class="carousel slide istrazi" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="slike/imdb1.jpg" class="d-block w-100" alt="filmovi1">
                    </div>
                    <div class="carousel-item">
                        <img src="slike/imdb2.jpg" class="d-block w-100" alt="serije">
                    </div>
                    <div class="carousel-item">
                        <img src="slike/imdb3.jpg" class="d-block w-100" alt="filmovi">
                    </div>
                    <div class="carousel-item">
                        <img src="slike/imdb4.jpg" class="d-block w-100" alt="filmovi">
                    </div>
                    <div class="carousel-item">
                        <img src="slike/imdb5.jpg" class="d-block w-100" alt="filmovi">
                    </div>
                    <div class="carousel-item">
                        <img src="slike/imdb6.jpg" class="d-block w-100" alt="filmovi">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        </div>

        <div class="prikaz">

            <table class="table text-center" style="color: white;">
                <thead>
                    <tr>
                        <th>Naziv</th>
                        <th>Tip</th>
                        <th>Zanr</th>
                        <th>Trajanje</th>
                        <th>Detalji</th>
                        <th>Izbrisi</th>
                        <th>Izmijeni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($red = mysqli_fetch_assoc($res)) {
                        $id_temp = $red['id'];
                        $link1 = "<a href=\"film_serija.php?id=$id_temp\"><i class=\"fa fa-info\"></i></a>";
                        $link2 = "<a style=\"color: red;\" href=\"izbrisi.php?id=$id_temp\"><i class=\"fa fa-times\"></i></a>";
                        $link3 = "<a style=\"color: #f3ce13;\" href=\"izmijeni.php?id=$id_temp\"><i class=\"fa fa-edit\"></i></a>";
                        echo "<tr>";
                        echo "<td style=\"text-align: left;\">" .$red['ime']. "</td>";
                        echo "<td>" . $red['tip_filma'] . "</td>";
                        echo "<td>" . $red['zanr_filma'] . "</td>";
                        echo "<td>" . $red['trajanje'] . "</td>";
                        echo "<td>" . $link1 . "</td>";
                        echo "<td>" . $link2 . "</td>";
                        echo "<td>" . $link3 . "</td>";
                        echo "</tr>";
                    }

                    ?>
                </tbody>
            </table>
            <p style="text-align:center">Ukupno: <?= $cnt ?></p>

        </div>

    </div>






    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>