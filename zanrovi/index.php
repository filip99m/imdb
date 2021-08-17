<?php 
    include '../db.php';

    $where_arr = [];
    $where_arr[] = " 1=1 ";
    if( isset($_GET['zanr_filma']) && $_GET['zanr_filma'] != "" ){
        $zanr_filma = strtolower($_GET['zanr_filma']);
        $where_arr[] = " lower(zanr_filma) LIKE '%$zanr_filma%' ";
    }
    
    $where_str = implode("AND", $where_arr );

    $sql = "SELECT * FROM zanr WHERE $where_str";
    $res = mysqli_query($dbconn, $sql);
    $cnt = mysqli_num_rows($res);


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Zanr</title>
</head>
<body style="background-color: #1b1b1b; color: white;">

    <div class="container">
        <div>
            <p style="color: #f3ce13; font-weight: bold; font-size: 50px; text-align: center;">IMDb na SPR način</p>
        </div>
        <div class="nav justify-content-center mb-5 mt-3">
            <ul class="nav nav-pills justify-content-center">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php" style="color: white;">Filmovi/Serije</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="index.php" style="background-color: #f3ce13;">Zanrovi</a>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" style="color: white;">+ Dodaj novi zanr</button>
                </li>
            </ul>
        </div>
    
    

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: black;">Dodaj zanr</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="dodaj_novi_zanr.php" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" name="zanr_filma" placeholder="Unesi naziv" required>
                        </div>
                    
                </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Izađi</button>
                            <button class="btn" style="background-color: #f3ce13;">Dodaj</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>

    <div class="text-center row mt-5">
            <div class="col-4"></div>
            <div class="col-4">
                <form action="index.php" method="GET" class="form">
                    <input class="form-control mb-3" type="text" name="zanr_filma" placeholder="Unesi naziv zanra">
                    <button class="btn btn-warning" style="color: white; font-weight: bold;">PRETRAGA</button>
                    <a href="index.php"><button type="button" class="btn btn-dark"><i class="fa fa-times"></i></button></a>
                </form>
            </div>
    </div>
    
    <div class="container">
        <div class="spisak text-center mt-5">
            <table class="table" style="color: white;">
                <thead>
                    <tr>
                        <th class="text-left">Zanr</th>
                        <th>Izbrisi</th>
                        <th>Izmijeni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($red = mysqli_fetch_assoc($res)){
                            $id_temp = $red['id'];
                            $link1 = "<a style=\"color: red;\" href=\"izbrisi_zanr.php?id=$id_temp\"><i class=\"fa fa-times\"></i></a>";
                            $link2 = "<a style=\"color: #f3ce13;\" href=\"izmijeni_zanr.php?id=$id_temp\"><i class=\"fa fa-edit\"></i></a>";
                            echo "<tr>";
                                echo "<td class=\"text-left\">".$red['zanr_filma']."</td>";
                                echo "<td>".$link1."</td>";
                                echo "<td>".$link2."</td>";
                            echo "</tr>";
                        }

                    ?>
                </tbody>
            </table>

            <p style="text-align: center;">Ukupno: <?=$cnt?></p>

        </div>



    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>