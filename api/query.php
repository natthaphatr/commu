<?php
$host = 'us-cdbr-gcp-east-01.cleardb.net';
$user = 'b2ce45e147adf3';
$pass = '38b5e984b71cdfc';
$db = 'gcp_51ac2d698fb071e43c4f';
$conn = new mysqli($host,$user,$pass,$db);

mysqli_query($conn, "SET NAMES utf8");
    $office = $_POST["office"];
    $keyword = $_POST["keyword"];
    /*$office = 'j091';
    $keyword = '00';*/
    $sql_text = "SELECT * FROM tbl_equipment WHERE office_id = '$office' AND (equip_id LIKE '%$keyword%' OR equip_name LIKE '%$keyword%')";
    $query = mysqli_query($conn,$sql_text);
    $data_return = array();
    while($obj = mysqli_fetch_assoc($query))
    {
       array_push($data_return,$obj);
    }
    echo json_encode($data_return);
?>