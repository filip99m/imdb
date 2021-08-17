<?php 
    include '../db.php';

    isset($_GET['id']) && is_numeric($_GET['id']) ? $id = $_GET['id'] : exit("ID Greska...");

    $sql = "DELETE FROM zanr WHERE id = $id";
    $res = mysqli_query($dbconn, $sql);

    if($res){
        header("location: index.php?msg=izbrisan_zanr");
    }else{
        header("location: index.php?msg=greska_pri_brisanju");
    }

?>