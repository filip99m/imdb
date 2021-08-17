<?php 
    include 'db.php';

    isset($_GET['id']) && is_numeric($_GET['id']) ? $id = $_GET['id'] : exit("ID Greska...");

    $sql = "SELECT * FROM naziv WHERE id = $id";
    $res = mysqli_query($dbconn, $sql);
    $cnt = mysqli_num_rows($res);

    if($cnt == 0){
        exit("Nema filma/serije sa ovim ID-em...");
    }

    $naziv = mysqli_fetch_assoc($res);

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Izmijeni</title>
</head>
<body style="background-color: #1b1b1b; color: white;">

    
    <div class="nav justify-content-center mb-2 mt-3">
        <ul class="nav nav-pills justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" href="index.php" style="background-color: #f3ce13;">Film/Serija</a>
            </li>
        </ul>
    </div>

    <div class="container text-center">
            <div class="col">
                    <form action="dodaj_novu_izmjenu.php" class="form" method="POST">
                        <input class="form-control" type="hidden" name="id" value="<?=$id?>">
                        <table class="table" style="color: white;">
                            <tr>
                                <td colspan="2">
                                    <label class="boldovano" for="ime">Naziv:</label>
                                    <input class="form-control" type="text" name="ime" placeholder="Unesi naziv filma/serije" value="<?=$naziv['ime']?>">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                <label class="boldovano" for="id_tip">Tip:</label>
                                    <select class="form-control" name="id_tip" required>
                                        <option value="">-odaberite tip-</option>
<?php
                                            $res = mysqli_query($dbconn, "SELECT * FROM tip ORDER BY tip_filma ASC");
                                            $id_tip = $naziv['id_tip'];
                                            while($row = mysqli_fetch_assoc($res)){
                                                $id_temp = $row['id'];
                                                $naziv_temp = $row['tip_filma'];
                                                $izabrano = "";
                                                if($id_tip == $id_temp){
                                                    $izabrano = "selected";
                                                }

                                                echo "<option value=\"$id_temp\" $izabrano >$naziv_temp</option>";
                                            }
?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="boldovano" for="tip_zanr">Zanr:</label>
                                    <select class="form-control" name="id_zanr" required>
                                        <option value="">-odaberite zanr-</option>
<?php
                                            $res = mysqli_query($dbconn, "SELECT * FROM zanr ORDER BY zanr_filma ASC");
                                            $tip_zanr = $naziv['id_zanr'];
                                            while($row = mysqli_fetch_assoc($res)){
                                                $id_temp = $row['id'];
                                                $naziv_temp = $row['zanr_filma'];
                                                $izabrano = "";
                                                if($tip_zanr == $id_temp){
                                                    $izabrano = "selected";
                                                }

                                                echo "<option value=\"$id_temp\" $izabrano >$naziv_temp</option>";
                                            }

?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="boldovano" for="glumci">Glumci:</label>
                                    <input class="form-control" type="text" name="glumci" placeholder="Unesi imena glumaca" value="<?=$naziv['glumci']?>">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="boldovano" for="reziser">Reziser:</label>
                                    <input class="form-control" type="text" name="reziser" placeholder="Unesi ime rezisera" value="<?=$naziv['reziser']?>">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="boldovano" for="trajanje">Trajanje:</label>
                                    <input class="form-control" type="text" name="trajanje" placeholder="Unesi minute filma" value="<?=$naziv['trajanje']?>">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label class="boldovano" for="godina">Godina:</label>
                                    <input class="form-control" type="text" name="godina" placeholder="Unesi godinu" value="<?=$naziv['godina']?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button class="btn btn-warning btn-block my-3" style="color: white;">IZMIJENI</button>
                    </form>
                                </td>
                                <td style="float: left;">
                                    <a href="index.php"><button data-dismiss class="btn btn-dark my-3"><i class="fa fa-times"></i></button></a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    
                                </td>
                            </tr>
                        </table>
                        
                
            </div>
    </div>


    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>