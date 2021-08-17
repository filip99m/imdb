<?php 
    include '../db.php';

    isset($_GET['id']) && is_numeric($_GET['id']) ? $id = $_GET['id'] : exit("ID Greska...");

    $sql = "SELECT * FROM zanr WHERE id = $id";
    $res = mysqli_query($dbconn, $sql);
    $cnt = mysqli_num_rows($res);

    if($cnt == 0){
        exit("Nema zanra sa ovim ID-em...");
    }

    $zanr = mysqli_fetch_assoc($res);

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Izmijeni</title>
</head>
<body style="background-color: #1b1b1b; color: white;">

    <div class="nav justify-content-center mb-5 mt-3">
        <ul class="nav nav-pills justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" href="index.php" style="background-color: #f3ce13;">Zanrovi</a>
            </li>
        </ul>
    </div>


    <div class="text-center row mt-5">
            <div class="col-4"></div>
            <div class="col-4">
                <h3>Izmijeni</h3>
                <form action="dodaj_novu_izmjenu_zanra.php" class="form" method="POST">
                    <input class="form-control" type="hidden" name="id" value="<?=$id?>">
                    <input class="form-control" type="text" name="zanr_filma" placeholder="Unesi zanr" value="<?=$zanr['zanr_filma']?>">
                    <button class="btn  btn-warning btn-block btn-block my-3" style="color: white; font-weight: bold">IZMIJENI</button>
                </form>
                <a href="index.php"><button data-dismiss class="btn btn btn-dark btn-block my-3"><i class="fa fa-times"></i></button></a>
            </div>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>