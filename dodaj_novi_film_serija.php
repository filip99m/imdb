<?php

include 'db.php';

isset($_POST['ime']) ? $ime = $_POST['ime'] : $ime = "err1";
isset($_POST['id_tip']) && is_numeric($_POST['id_tip']) ? $id_tip = $_POST['id_tip'] : $id_tip = "err2";
isset($_POST['id_zanr']) && is_numeric($_POST['id_zanr']) ? $id_zanr = $_POST['id_zanr'] : $id_zanr = "err3";
isset($_POST['glumci']) ? $glumci = $_POST['glumci'] : $glumci = "err4";
isset($_POST['reziser']) ? $reziser = $_POST['reziser'] : $reziser = "err5";
isset($_POST['trajanje']) ? $trajanje = $_POST['trajanje'] : $trajanje = "err6";
isset($_POST['godina']) ? $godina = $_POST['godina'] : $godina = "err7";

$sql_insert = "INSERT INTO naziv
                                        (
                                            ime,
                                            id_tip,
                                            id_zanr,
                                            glumci,
                                            reziser,
                                            trajanje,
                                            godina                                      
                                        )
                                VALUES
                                        (
                                            '$ime',
                                            $id_tip,
                                            $id_zanr,
                                            '$glumci',
                                            '$reziser',
                                            '$trajanje',
                                            '$godina'
                                        )
                ";

$res_insert = mysqli_query($dbconn, $sql_insert);
$id = mysqli_insert_id($dbconn);


if (isset($_FILES['fotografija'])) {
    $foto = $_FILES['fotografija'];
    $fotoCount = count($foto["name"]);

    for ($i = 0; $i < $fotoCount; $i++) {
        $ext = explode(".", $foto['name'][$i]);
        $ext = $ext[count($ext) - 1];

        $dest = "./uploads/" . uniqid() . "." . $ext;

        copy($foto['tmp_name'][$i], $dest);

        $q = "INSERT INTO slike (slika, ime_id) VALUES ('$dest', '$id')";
        mysqli_query($dbconn, $q);
    }
}

if ($res_insert) {
    header("location: index.php?msg=film_serija_dodata");
} else {
    header("location: index.php?msg=greska_pri_dodavanju");
}
