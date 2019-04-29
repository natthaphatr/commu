<?php
   require('connect_db.php');
   $sql_text ="SELECT * FROM commu where keyword LIKE '%b%'";
   $query = mysqli_query($conn,$sql_text);
   while($objresult=mysqli_fetch_assoc($query))
   {
       echo $objresult['answer']."<br>";
   }
?>