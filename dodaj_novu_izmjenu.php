<?php

    include 'db.php';

    isset($_POST['id']) && is_numeric($_POST['id']) ? $id = $_POST['id'] : exit("err0");
    isset($_POST['ime']) ? $ime = $_POST['ime'] : $ime = "err1";
    isset($_POST['id_tip']) && is_numeric($_POST['id_tip']) ? $id_tip = $_POST['id_tip'] : $id_tip = "err2";
    isset($_POST['id_zanr']) && is_numeric($_POST['id_zanr']) ? $id_zanr = $_POST['id_zanr'] : $id_zanr = "err3";
    isset($_POST['glumci']) ? $glumci = $_POST['glumci'] : $glumci = "err4";
    isset($_POST['reziser']) ? $reziser = $_POST['reziser'] : $reziser = "err5";
    isset($_POST['trajanje']) ? $trajanje = $_POST['trajanje'] : $trajanje = "err6";
    isset($_POST['godina']) ? $godina = $_POST['godina'] : $godina = "err7";

    

    $sql_update = "UPDATE naziv SET
                                        ime = '$ime',
                                        id_tip = $id_tip,
                                        id_zanr = $id_zanr,
                                        glumci = '$glumci',
                                        reziser = '$reziser',
                                        trajanje = '$trajanje',
                                        godina = '$godina'                                        
                    WHERE id = $id;
                ";

    $res_update = mysqli_query($dbconn, $sql_update);

    if($res_update){
        header("location: index.php?msg=film_serija_izmijenjena");
    }else{  
        header("location: index.php?msg=greska_pri_izmjeni");
    }
    
?>


