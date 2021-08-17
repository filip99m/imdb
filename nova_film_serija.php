<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">

<heameta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body style="background-color: #1b1b1b; color: white;">
    <div class="naslov">
        <div>
            <p style="color: #f3ce13; font-weight: bold; font-size: 50px; text-align: center;">IMDb na SPR način</p>
        </div>
        <h2 class="text-center mt-5 mb-5"><i class="fa fa-file"></i> Novi film/serija</h2>
    </div>

    <div class="container">
        <table class="table table-borderless" style="color: white;">
            <form action="dodaj_novi_film_serija.php" method="POST" enctype="multipart/form-data">
                <tr>
                    <td class="boldovano">Naziv filma/serije:</td>
                    <td>
                        <input class="form-control" type="text" name="ime" placeholder="Unesi naziv filma/serije">
                    </td>
                </tr>
                <tr>
                    <td class="boldovano">Odaberi tip:</td>
                    <td>
                        <select class="form-control" name="id_tip" require>
                            <option value="">-odaberite tip-</option>
<?php
                                $res = mysqli_query($dbconn, "SELECT * FROM tip ORDER BY tip_filma ASC");
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id_temp = $row['id'];
                                    $naziv_temp = $row['tip_filma'];
                                    echo "<option value=\"$id_temp\">$naziv_temp</option>";
                                }

?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="boldovano">Odaberi zanr:</td>
                    <td>
                        <select class="form-control" name="id_zanr" require>
                            <option value="">-odaberite zanr-</option>
<?php
                            $res = mysqli_query($dbconn, "SELECT * FROM zanr ORDER BY zanr_filma ASC");
                            while ($row = mysqli_fetch_assoc($res)) {
                                $id_temp = $row['id'];
                                $naziv_temp = $row['zanr_filma'];
                                echo "<option value=\"$id_temp\">$naziv_temp</option>";
                            }

?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="boldovano">Glumci:</td>
                    <td>
                        <input class="form-control" type="text" name="glumci" placeholder="Unesi imena">
                    </td>
                </tr>
                <tr>
                    <td class="boldovano">Reziser:</td>
                    <td>
                        <input class="form-control" type="text" name="reziser" placeholder="Unesi ime rezisera">
                </tr>
                <tr>
                    <td class="boldovano">Trajanje:</td>
                    <td>
                        <input class="form-control" type="text" name="trajanje" placeholder="Unesi trajanje">
                        
                    </td>
                </tr>
                <tr>
                    <td class="boldovano">Godina:</td>
                    <td>
                        <input class="form-control" type="text" name="godina" placeholder="Unesi godinu: ">
                        
                    </td>
                </tr>
                <tr>
                    <td class="boldovano">Izaberi sliku:</td>
                    <td>
                        <input type="file" required name="fotografija[]" multiple>  
                    </td>
                </tr>
                <tr>
                    <td>
                        <button class="btn btn-warning btn-block" style="color: white; font-weight: bold;">SACUVAJ</button>
                        
                    </td>
                    <td>
                        <a href="index.php"><button type="button" data-dismiss class="btn btn-dark"><i class="fa fa-times"></i></button></a>
                    </td>
                </tr>
            </form>
        </table>
    </div>

    
        

    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>