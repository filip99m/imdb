<?php 
    include 'db.php';

    isset($_GET['id']) && is_numeric($_GET['id']) ? $id = $_GET['id'] : exit("ID Greska...");

    $sql = "SELECT 
                naziv.*, 
                zanr.zanr_filma as zanr_filma,
                tip.tip_filma as tip_filma
            FROM naziv 
            LEFT JOIN zanr on naziv.id_zanr = zanr.id 
            LEFT JOIN tip on naziv.id_tip = tip.id
            WHERE naziv.id = $id";

    $res = mysqli_query($dbconn, $sql);
    $cnt = mysqli_num_rows($res);


    if($cnt == 0){
        exit("Nema filma/serije sa ovim ID-em...");
    }

    $naziv = mysqli_fetch_assoc($res);

    $res = mysqli_query($dbconn, "SELECT slika FROM slike WHERE ime_id = $id");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Detalji <?=$id?> </title>
</head>
<body style="background-color: #1b1b1b; color: white;">

        <div>
            <p style="color: #f3ce13; font-weight: bold; font-size: 50px; text-align: center;">IMDb na SPR način</p>
        </div>

        <div class="nav justify-content-center mb-5 mt-3">
            <ul class="nav nav-pills justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php" style="color: white; background-color: #f3ce13;">Filmovi/Serije</a>
                </li>
            </ul>
        </div>

    <div class="naslov">
        <h2 class="text-center mt-3 mb-3"><i class="fa fa-info"></i> Detalji</h2>
    </div>

    <div class="container">
        <table class="table table-borderless" style="color: white;">
            <tr>
                <td rowspan="10">
                    
<?php

                    $i = 0;
                    while ($slika = mysqli_fetch_assoc($res)) {
                        $path = $slika['slika'];
                        $act = "";
                        if ($i == 0)
                            $act = "active";
                        echo "<div class='$act'>";
                        echo "  <img src='$path' width='220px'>";
                        echo "</div>";
                        $i += 1;
                    }

?>
                </td>
            </tr>
            <tr>
                <td class="boldovano">Naziv:</td>
                <td><?=$naziv['ime']?></td>
            </tr>
            <tr>
                <td class="boldovano">Tip:</td>
                <td><?=$naziv['tip_filma']?></td>
            </tr>
            <tr>
                <td class="boldovano">Zanr:</td>
                <td><?=$naziv['zanr_filma']?></td>
            </tr>
            <tr>
                <td class="boldovano">Glumci:</td>
                <td><?=$naziv['glumci']?></td>
            </tr>
            <tr>
                <td class="boldovano">Reziser:</td>
                <td><?=$naziv['reziser']?></td>
            </tr>
            <tr>
                <td class="boldovano">Trajanje:</td>
                <td><?=$naziv['trajanje']?> </td>
            </tr>
            <tr>
                <td class="boldovano">Godina:</td>
                <td><?=$naziv['godina']?></td>
            </tr>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


</body>
</html>
