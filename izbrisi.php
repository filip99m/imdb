<?php 

    include 'db.php';

    isset($_GET['id']) && is_numeric($_GET['id']) ? $id = $_GET['id'] : "";

    $sql1 = "DELETE FROM slike WHERE ime_id=$id";
    $res= mysqli_query($dbconn,$sql1);
    if($res){
        $sql2 = "DELETE FROM naziv WHERE id = $id";
        $res2 = mysqli_query($dbconn, $sql2);
    }



    
    if($res){
    header("location: index.php?msg=izbrisan_film_serija");
    }else{
    header("location: index.php?msg=greska_pri_brisanju");
    }

?>