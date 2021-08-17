<?php

    include '../db.php';

    isset($_POST['zanr_filma']) ? $zanr_filma = $_POST['zanr_filma'] : $zanr_filma = "err1";

    $sql_insert = "INSERT INTO zanr (zanr_filma) VALUES ('$zanr_filma')";

    $res_insert = mysqli_query($dbconn, $sql_insert);

    if($res_insert){
        header("location: index.php?msg=zanr_dodat");
    }else{  
        header("location: index.php?msg=greska_pri_dodavanju");
    }
    
?>






