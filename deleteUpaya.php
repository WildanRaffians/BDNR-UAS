<?php
    session_start();
    if(!isset($_SESSION["login"])) {
        header("Location: login.php");
    }
    include('function.php');


    $id = $_GET['id'];
    if ($id > 0) {
        
        $isDeleteSucceed = deleteUpaya($id); 
        if ($isDeleteSucceed > 0) {
        echo "
        <script>
        alert('Delete Success !');
        document.location.href = 'admin_upaya.php#topics-detail';
        </script>
        ";
        } else {
        echo "
        <script>
        alert('Delete Failed !');
        document.location.href = 'admin_upaya.php#topics-detail';
        </script>
        ";
    }
    }
?>
