<?php

    $id_prov = $_GET["id_prov"];

    // URL API untuk mendapatkan kabupaten berdasarkan provinsi
    $url = "http://localhost:5000/api/kabupaten?provinsi=" . urlencode($id_prov); // Ganti dengan URL API yang sesuai

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
    $kabupatens = json_decode($response, true);

    // Memeriksa apakah data kabupaten ada
    if (is_array($kabupatens) && count($kabupatens) > 0) {
        $data = [];
        // Pengulangan untuk memasukkan id dan nama ke dalam array
        foreach ($kabupatens as $kabupaten) {
            $data[] = ["id_kab" => $kabupaten["id_regency"], "nama" => $kabupaten["name"]];
        }

        // Menghasilkan output dalam format JSON
        echo json_encode($data);
    } else {
        // Jika tidak ada data, kirimkan pesan error
        echo json_encode(["error" => "No regencies found for the selected province"]);
    }

?>
