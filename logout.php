<?php
session_start();
$error = false;
    function checkToken($token) {
        $url = "http://localhost:5000/protected"; // Endpoint Flask untuk verifikasi token
    
        // Buat cURL request
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $token, // Kirim token di header
            'Content-Type: application/json'
        ]);
        
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    
        return $httpcode === 200; // Token valid jika status code 200
    }
    
    $token = $_SESSION['token'] ?? null;
    
    if (checkToken($token) == 200) {
        session_unset();
        session_destroy();
        header("Location: index.php"); // Arahkan ke halaman index
        exit;
    }else {
        print_r(!$token);
        echo "<script>
                alert('Logout failed. Please try again.');
              </script>";
    }

// if (!$token) {
//     echo "<script>
//             alert('No token found. You are already logged out.');
//           </script>";
//     header("Location: login.php");
//     exit;
// } 

// Panggil API logout Flask
// $url = "http://localhost:5000/logout";
// $url_with_token = $url . "?token=" . $token;

// $ch = curl_init($url_with_token);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_HTTPGET, true);
// $response = curl_exec($ch);
// $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
// curl_close($ch);

// // Hapus sesi dan cookie setelah respons diterima
// if ($httpcode === 200) {
//     $_SESSION = [];
//     session_unset();
//     session_destroy();
//     setcookie('token', '', time() - 3600, "/"); // Hapus token dari cookie
//     header("Location: login.php");
//     exit;
// } else {
//     echo "<script>
//             alert('Logout failed. Please try again.');
//           </script>";
// }
?>
