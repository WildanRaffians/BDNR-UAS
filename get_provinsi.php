<?php
    // URL API untuk mendapatkan provinsi
    $url = "http://localhost:5000/api/provinsi"; // Ganti dengan URL API yang benar

    // Inisialisasi cURL untuk mengambil data dari API
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Cek jika ada error pada cURL
    if ($response === false) {
        echo json_encode(["error" => "Failed to fetch data from API"]);
        exit;
    }

    // Decode JSON response dari API
    $provinces = json_decode($response, true);

    // Memeriksa apakah data provinsi ada
    if (is_array($provinces) && count($provinces) > 0) {
        $data = [];
        // Pengulangan untuk memasukkan id dan nama ke dalam array
        foreach ($provinces as $provinsi) {
            $data[] = ["id_prov" => $provinsi["id_province"], "nama" => $provinsi["name"]];
        }

        // Menghasilkan output dalam format JSON
        echo json_encode($data);
    } else {
        // Jika tidak ada data, kirimkan pesan error
        echo json_encode(["error" => "No provinces found"]);
    }
?>
