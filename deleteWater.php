<?php
    session_start();
    if(!isset($_SESSION["login"])) {
        header("Location: login.php");
    }
    include('function.php');


    $id = $_GET['id'];
   

        
        $urlWaterUpdate = "http://localhost:5000/api/sumber_air_delete"; // Ganti dengan ID
        $isDeleteSucceed = file_get_contents("$urlWaterUpdate/$id", false, $context);
        //$isDeleteSucceed = deleteWater($id); 
        if ($isDeleteSucceed > 0) {
        echo "
        <script>
        alert('Delete Success !');
        document.location.href = 'admin.php';
        </script>
        ";
        } else {
        echo "
        <script>
        alert('Delete Failed !');
        document.location.href = 'admin.php';
        </script>
        ";
    }
    
?>
