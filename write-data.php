<?php

    //Variabel database
    $servername = "localhost";
    $username = "id15443097_adnanmuh";
    $password = "U\UDLH9gh3q**l}{";
    $dbname = "id15443097_justdatabase";

    $conn = mysqli_connect("$servername", "$username", "$password","$dbname");
    // Prepare the SQL statement
    date_default_timezone_set('asia/jakarta');
    $d=date("Y-m-d");
    $t=date("H:i:s");
    
    $data = $_POST['data'];
    if(!empty($_POST['data']))
    {
        echo sukses;
        $result = mysqli_query ($conn,"INSERT INTO datasensor (data,waktu,tanggal) VALUES ('".$data."','".$t."','".$d."')"); 
    }
    else
    {
        echo eror ;
    
    }

   // if (!$result) 
     //   {
       //     die ('Invalid query: '.mysqli_error($conn));
        //}  
    $conn->close() ;
?>