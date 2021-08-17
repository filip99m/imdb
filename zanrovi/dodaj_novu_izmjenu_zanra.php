<?php

    include '../db.php';

    isset($_POST['id']) && is_numeric($_POST['id']) ? $id = $_POST['id'] : exit("err0");
    isset($_POST['zanr_filma']) ? $zanr_filma = $_POST['zanr_filma'] : $zanr_filma = "err1";


    $sql_update = "UPDATE zanr SET zanr_filma = '$zanr_filma' WHERE id = $id;";

    $res_update = mysqli_query($dbconn, $sql_update);

    if($res_update){
        header("location: index.php?msg=zanr_izmijenjen");
    }else{  
        header("location: index.php?msg=greska_pri_izmjeni");
    }
    
?>


