<?php 
// hapus.php


if(isset($_POST["id"])){
      $connect = new PDO('mysql:host=localhost;dbname=calendar','root','');
      
      $query = "DELETE from events WHERE id = :id";
      
      $stmt = $connect->prepare($query);
      $stmt->execute(
            array(
                  'id' => $_POST['id'],
            )
      );
}

?>