<?php
   $host = 'us-cdbr-gcp-east-01.cleardb.net';
   $user =  'b2ce45e147adf3';
   $pass = '38b5e984b71cdfc';
   $db = 'gcp_51ac2d698fb071e43c4f';
   $conn = new mysqli($host,$user,$pass,$db);
   mysqli_query($conn,"SET NAMES utf8");
   
?>