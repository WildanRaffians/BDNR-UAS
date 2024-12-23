<?php
    // URL API untuk mengambil data
    $urlUpaya = "http://localhost:5000/api/upaya"; // Ganti dengan URL endpoint API Anda
    // $urlSumberAirUpaya = "http://localhost:5000/api/sumber-air-upaya"; // Tambahkan endpoint sumber air jika ada
    
    // Mengambil data Upaya dari API
    $listUpaya = json_decode(file_get_contents($urlUpaya), true);

    // Mengambil data Sumber Air Upaya dari API
    // $listSumberAirUpaya = json_decode(file_get_contents($urlSumberAirUpaya), true);
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Sumber Air</title>

        <!-- CSS FILES -->        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">
        <link href="css/templatemo-topic-listing.css" rel="stylesheet">
    </head>
    
    <body class="topics-listing-page" id="top">

        <main>
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand" href="index.php">
                        <i class="bi-back"></i>
                        <span>HydroCulus</span>
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
    
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-lg-5 me-lg-auto">
                            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="topics-listing.php#section_1">List Sumber Air</a></li>
                            <li class="nav-item"><a class="nav-link active" href="upaya-listing.php#list">List Upaya Pelestarian</a></li>
                        </ul>
                        <div class="d-none d-lg-block">
                            <a href="login.php" class="navbar-icon bi-person smoothscroll"></a>
                        </div>
                    </div>
                </div>
            </nav>

            <header class="site-header d-flex flex-column justify-content-center align-items-center">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-12">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">List Upaya Pelestarian Sumber Air</li>
                                </ol>
                            </nav>
                            <h2 class="text-white">List Upaya Pelestarian Sumber Air</h2>
                        </div>
                    </div>
                </div>
            </header>

            <section class="section-padding" id="list">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-12 text-center">
                            <h3 class="mb-4">Upaya Pelestarian Sumber Air</h3>
                        </div>

                        <div class="col-lg-8 col-12 mt-3 mx-auto">
                            <?php
                            if (!empty($listUpaya)) {
                                $idUpayas = array_column($listUpaya, '_id');
                                $url = "http://localhost:5000/api/sumber_air_by_upayas";
                                $ch = curl_init($url);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_POST, true);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["id_upayas" => $idUpayas]));
                                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                                $response = curl_exec($ch);
                                if (curl_errno($ch)) {
                                    echo "Error: " . curl_error($ch);
                                    $listSumberAirByUpaya = [];
                                } else {
                                    $listSumberAirByUpaya = json_decode($response, true);
                                }
                                curl_close($ch);
                                
                                $cacah = 0;
                                foreach ($listUpaya as $upaya) {
                                    ?>
                                    <div class="custom-block custom-block-topics-listing bg-white shadow-lg mb-5">
                                        <div class="d-flex">
                                            <span class="badge bg-design rounded-pill"><?= ++$cacah ?></span>
                                            <div class="custom-block-topics-listing-info d-flex">
                                                <div>
                                                    <h5 class="mb-2"><?= htmlspecialchars($upaya['nama_upaya']) ?></h5>
                                                    <h6>Sumber Air yang Membutuhkan:</h6>
                                                    <p>
                                                        <?php
                                                        $sumberAirList = $listSumberAirByUpaya[$upaya['_id']] ?? [];
                                                        if (!empty($sumberAirList)) {
                                                            foreach ($sumberAirList as $sumberAirUpaya) {
                                                                // if ($sumberAirUpaya['id_upaya_peningkatan_ketersediaan_air'] == $upaya['id_upaya_ketersediaan_air']) {
                                                                    ?>
                                                                    <a href="topics-detail.php?id_sumber_air=<?= htmlspecialchars($sumberAirUpaya['_id']) ?>" style="padding-top: 5px;">
                                                                        <button type="button" class="btn btn-info"><?= htmlspecialchars($sumberAirUpaya['nama_sumber_air']) ?></button>
                                                                    </a>
                                                                    <?php
                                                                // }
                                                            }
                                                        }
                                                        ?>
                                                    </p>                 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo "<p class='text-center'>Tidak ada data upaya pelestarian yang tersedia.</p>";
                            }
                            ?>
                        </div>
                    </div>
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
                            <li><a href="index.php" class="site-footer-link">Home</a></li>
                            <li><a href="topics-listing.php" class="site-footer-link">List Sumber Air</a></li>
                            <li><a href="#" class="site-footer-link">Upaya Melestarikan Sumber Air</a></li>
                            <li><a href="admin.php" class="site-footer-link">Login</a></li>
                        </ul>
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
