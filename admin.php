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
    
    
    // Ambil token dari session atau cookie
    $token = $_SESSION['token'] ?? null;
    
    if (!$token || !checkToken($token)) {
        // Token tidak valid atau tidak ditemukan
        header("Location: login.php"); // Arahkan ke halaman login
        exit;
    }
    // Bangun URL dengan parameter
    $urlSumberAir = "http://localhost:5000/api/sumber_air_lookup";

    // Ambil data dari API
    $listSumberAir = json_decode(file_get_contents($urlSumberAir), true);
    
    // $listSumberAir = readSumberAir();
    // if (isset($_GET['id_sumber_air'])) {
    //   $id = ($_GET["id_sumber_air"]);
    //   $result_air = readOneSumberAir($id);
    //   $detail_air = mysqli_fetch_assoc($result_air);
    //   $result_upaya = readUpayaSumberAir($id);
      
    
    // // echo '<pre>';
    // // print_r($detail_air);
    // // print_r($result_upaya);

    // // echo $detail_air['nama_sumber_air'];
    
    
    // }
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Admin</title>

        <!-- CSS FILES -->        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap" rel="stylesheet">
                        
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link href="css/templatemo-topic-listing.css" rel="stylesheet">
<!--

TemplateMo 590 topic listing

https://templatemo.com/tm-590-topic-listing

-->
    </head>
    
    <body id="top">

        <main>

        <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand" href="index.php">
                        <i class="bi-back"></i>
                        <span>HydroCulus</span>
                    </a>

                    <div class="d-lg-none ms-auto me-4">
                        <a href="#top" class="navbar-icon bi-person smoothscroll"></a>
                    </div>
    
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
    
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-lg-5 me-lg-auto">
                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="dashboard.php#chart">Dashboard</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link " href="topics-listing.php" >List Sumber Air</a>
                            </li>

                            <li class="nav-item" >
                                <a class="nav-link"  href="upaya-listing.php" >List Upaya Pelestarian</a>
                            </li>
                        </ul>

                        <div class="d-none d-lg-block">
                            <a href="login.php" class="navbar-icon bi-person smoothscroll"></a>
                        </div>
                    </div>
                </div>
            </nav>
            

            <header class="site-header d-flex flex-column justify-content-center align-items-center">
                <div class="container">
                    <div class="row justify-content-center align-items-center">

                        <div class="col-lg-5 col-12 mb-5">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="admin.php">Halaman Admin</a></li>
                                </ol>
                            </nav>

                            <h2 class="text-white">Hanya untuk admin dan orang yang memiliki akses</h2>
                            <a type="button" class="btn btn-danger" href="logout.php">Log Out</a>
                        </div>

                        <div class="col-lg-5 col-12">
                            <div class="topics-detail-block bg-white shadow-lg">
                                <img src="images/sumber/c1.jpg" class="topics-detail-block-image img-fluid">
                            </div>
                        </div>

                    </div>
                </div>
            </header>


            <section class="topics-detail-section section-padding" id="topics-detail">
            
                <div class="container">
                    <a type="button" class="btn btn-primary btn-sm" href="admin.php#topics-detail">Tabel Sumber Air</a>
                    <a type="button" class="btn btn-secondary btn-sm" href="admin_upaya.php#topics-detail">Tabel Upaya</a>
                <br><br><br>
                <h1>Tabel Sumber Air</h1><br><br>
                <a type="button" class="btn btn-outline-primary" href="addWater.php">Tambah Data</a>
                <table class="table caption-top">
                    <caption>List of sumber air</caption>
                    <thead>
                        <tr>
                        <th scope="col"></th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kondisi</th>
                        <th scope="col">Suhu</th>
                        <th scope="col">Warna</th>
                        <th scope="col">pH</th>
                        <th scope="col">Layak Minum</th>
                        <th scope="col">Wilayah</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $cacah = 1;
                            foreach($listSumberAir as $sumberAir) {
                        ?>
                        <tr>
                        <th scope="row"><?=$cacah?></th>
                        <td><?=$sumberAir['nama_sumber_air']?></td>
                        <td><?=$sumberAir['kondisi_sumber_air']?></td>
                        <td><?=$sumberAir['suhu']?></td>
                        <td><?=$sumberAir['warna']?></td>
                        <td><?=$sumberAir['ph']?></td>
                        <td><?=$sumberAir['kelayakan']?></td>
                        <td><?=$sumberAir['kabupaten']['name']?>, <?=$sumberAir['provinsi']['name']?></td>
                        <td><?=$sumberAir['jenis_sumber_air']['nama_jenis_sumber_air']?></td>
                        <td><a href="images/foto_sumber_air/<?=$sumberAir['foto_sumber_air']?>">See image</a></td>
                        <td><a type="button" class="btn btn-outline-success" href="updateWater.php?id_sumber_air=<?=$sumberAir['_id']?>">Update</a> 
                        <a type="button" class="btn btn-outline-danger"onclick="return confirm('Yakin Hapus?')" href="deleteWater.php?id=<?=$sumberAir['_id']?>">Delete</a>
                        </td>
                        </tr>
                        <?php
                                $cacah++;
                            }
                        ?>
                    </tbody>
                    </table>
                </div>
            </section>

        </main>
		
        <footer class="site-footer section-padding">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-12 mb-4 pb-2">
                        <a class="navbar-brand mb-2" href="index.php">
                            <i class="bi-back"></i>
                            <span>HydroCulus</span>
                        </a>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <h6 class="site-footer-title mb-3">Resources</h6>

                        <ul class="site-footer-links">
                            <li class="site-footer-link-item">
                                <a href="index.php" class="site-footer-link">Home</a>
                            </li>

                            <li class="site-footer-link-item">
                                <a href="topics-listing.php" class="site-footer-link">List Sumber Air</a>
                            </li>

                            <li class="site-footer-link-item">
                                <a href="#" class="site-footer-link">Upaya Melestarikan Sumber Air</a>
                            </li>

                            <li class="site-footer-link-item">
                                <a href="admin.php" class="site-footer-link">Login</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6 mb-4 mb-lg-0">
                        <h6 class="site-footer-title mb-3">Information</h6>

                        <p class="text-white d-flex mb-1">
                            <a href="tel:" class="site-footer-link">
                                17-08-1945
                            </a>
                        </p>

                        <p class="text-white d-flex">
                            <a href="mailto:info@company.com" class="site-footer-link">
                                hydroculus@sumberair.com
                            </a>
                        </p>
                    </div>

                    <div class="col-lg-3 col-md-4 col-12 mt-4 mt-lg-0 ms-auto">
                        <!-- <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            English</button>

                            <ul class="dropdown-menu">
                                <li><button class="dropdown-item" type="button">Thai</button></li>

                                <li><button class="dropdown-item" type="button">Myanmar</button></li>

                                <li><button class="dropdown-item" type="button">Arabic</button></li>
                            </ul>
                        </div> -->

                        <p class="copyright-text mt-lg-5 mt-4">Copyright © 2023 HydroCulus. <br> All rights reserved.
                        <!-- <br><br>Design: <a rel="nofollow" href="https://templatemo.com" target="_blank">TemplateMo</a></p> -->
                        
                    </div>

                </div>
            </div>
        </footer>

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/custom.js"></script>

    </body>
</html>