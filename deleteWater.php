<?php
session_start();

function checkToken($token) {
    $url = "http://localhost:5000/protected";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $token,
        'Content-Type: application/json'
    ]);

    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $httpcode === 200;
}

$token = $_SESSION['token'] ?? null;

if (!$token || !checkToken($token)) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

// URL endpoint untuk menghapus data
$urlWaterUpdate = "http://localhost:5000/api/sumber_air_delete/$id";

// Inisialisasi cURL
$ch = curl_init();

// Konfigurasi cURL
curl_setopt($ch, CURLOPT_URL, $urlWaterUpdate);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); // Gunakan metode DELETE
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Eksekusi cURL dan dapatkan respons
$response = curl_exec($ch);

// Periksa apakah ada error
if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
    exit();
}

// Ambil kode status HTTP
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Tutup cURL
curl_close($ch);

// Periksa respons dan arahkan kembali
if ($httpCode === 200) {
    echo "
    <script>
    alert('Delete Success!');
    document.location.href = 'admin.php';
    </script>
    ";
} else {
    echo "
    <script>
    alert('Delete Failed!');
    document.location.href = 'admin.php';
    </script>
    ";
}
?>
