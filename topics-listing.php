<?php
// Ambil parameter dari URL
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

// Bangun URL dengan parameter
$urlSumberAir = "http://localhost:5000/api/sumber_air_lookup_filter?page=$page&limit=$limit&keyword=" . urlencode($keyword);

// Ambil data dari API
$listSumberAir = json_decode(file_get_contents($urlSumberAir), true);

$totalData = $listSumberAir['total'];
$totalPages = ceil($totalData / $limit);
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
                            <a class="nav-link active" href="topics-listing.php#section_1">List Sumber Air</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="upaya-listing.php#list">List Upaya Pelestarian</a>
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
                <div class="row align-items-center">

                    <div class="col-lg-5 col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>

                                <li class="breadcrumb-item active" aria-current="page">List Sumber Air</li>
                            </ol>
                        </nav>

                        <h2 class="text-white">List Sumber Air</h2>
                    </div>

                </div>
            </div>
        </header>
        <section class="hero-section d-flex justify-content-center align-items-center" id="section_1" style="padding: 0px; background-image: linear-gradient(0deg, #367c93 0%, #367c93 100%); margin-bottom: 20px;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-12 mx-auto" style="height: 50px" id="search"></div>
                    <div class="col-lg-8 col-12 mx-auto" style="height: 120px">

                        <form method="get" action="" class="custom-form mt-4 pt-2 mb-lg-0 mb-5" role="search">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bi-search" id="basic-addon1"></span>
                                <input
                                    type="text"
                                    name="keyword"
                                    class="form-control"
                                    id="keyword"
                                    placeholder="Cari di wilayah"
                                    aria-label="Search"
                                    value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>"
                                    style="margin-bottom: 0px; border: none;">
                                <button type="submit" class="form-control" id="button-cari">Cari</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </section>


        <section class="section-padding" id="list">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12 text-center">
                        <h3 class="mb-4">Sumber Air</h3>
                        <!-- <?php if ($keyword): ?>
                            <p>Hasil pencarian untuk: <strong><?= htmlspecialchars($_GET['keyword']) ?></strong></p>
                        <?php endif; ?> -->
                    </div>
                    <div class="col-lg-8 col-12 mt-3 mx-auto">
                        <?php
                        if (!empty($listSumberAir)) {
                            // $cacah = 0;
                            foreach ($listSumberAir['data'] as $sumberAir) {
                        ?>
                                <div class="custom-block custom-block-topics-listing bg-white shadow-lg mb-5">
                                    <div class="d-flex">
                                        <!-- <span class="badge bg-design rounded-pill"><?= $cacah += 1 ?></span> -->
                                        <img src="images/foto_sumber_air/<?= $sumberAir['foto_sumber_air'] ?>" class="custom-block-image img-fluid" alt="" style="border-radius: 10px;">
                                        <div class="custom-block-topics-listing-info d-flex">
                                            <div>
                                                <h5 class="mb-2"><?= $sumberAir['nama_sumber_air'] ?></h5>
                                                <h6 class="mb-1"><?= $sumberAir["kabupaten"]["name"] ?>, <?= $sumberAir['provinsi']['name'] ?></h6>
                                                <br>
                                                <p class="mb-0">Kondisi Sumber Air: <?= $sumberAir['kondisi_sumber_air'] ?></p>
                                                <p class="mb-0">Kelayakan Minum: <?= $sumberAir['kelayakan'] ?></p>
                                                <a href="topics-detail.php?id_sumber_air=<?= $sumberAir['_id'] ?>" class="btn custom-btn mt-3 mt-lg-4">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<p class='text-center'>Tidak ada hasil ditemukan.</p>";
                        }
                        ?>
                    </div>
                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <!-- Tombol First -->
                        <?php if ($page > 3): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=1&keyword=<?= urlencode($keyword) ?>">&laquo;</a>
                            </li>
                        <?php endif; ?>

                        <!-- Tombol Previous -->
                        <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page - 1 ?>&keyword=<?= urlencode($keyword) ?>" tabindex="-1">Previous</a>
                        </li>

                        <!-- Pagination Pages -->
                        <?php
                        $startPage = max(1, $page - 2); // Halaman awal
                        $endPage = min($totalPages, $page + 2); // Halaman akhir

                        if ($endPage - $startPage < 5) {
                            if ($startPage > 1) {
                                $startPage = max(1, $endPage - 5);
                            }
                            if ($endPage < $totalPages) {
                                $endPage = min($totalPages, $startPage + 5);
                            }
                        }

                        for ($i = $startPage; $i <= $endPage; $i++): ?>
                            <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>&keyword=<?= urlencode($keyword) ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <!-- Tombol Next -->
                        <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page + 1 ?>&keyword=<?= urlencode($keyword) ?>">Next</a>
                        </li>

                        <!-- Tombol Last -->
                        <?php if ($page < $totalPages - 2): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $totalPages ?>&keyword=<?= urlencode($keyword) ?>">&raquo;</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>

            </div>
        </section>



        <!-- <section class="section-padding section-bg">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12">
                            <h3 class="mb-4">Trending Topics</h3>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12 mt-3 mb-4 mb-lg-0">
                            <div class="custom-block bg-white shadow-lg">
                                <a href="topics-detail.php">
                                    <div class="d-flex">
                                        <div>
                                            <h5 class="mb-2">Investment</h5>

                                            <p class="mb-0">Lorem Ipsum dolor sit amet consectetur</p>
                                        </div>

                                        <span class="badge bg-finance rounded-pill ms-auto">30</span>
                                    </div>

                                    <img src="images/topics/undraw_Finance_re_gnv2.png" class="custom-block-image img-fluid" alt="">
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12 mt-lg-3">
                            <div class="custom-block custom-block-overlay">
                                <div class="d-flex flex-column h-100">
                                    <img src="images/businesswoman-using-tablet-analysis.jpg" class="custom-block-image img-fluid" alt="">

                                    <div class="custom-block-overlay-text d-flex">
                                        <div>
                                            <h5 class="text-white mb-2">Finance</h5>

                                            <p class="text-white">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sint animi necessitatibus aperiam repudiandae nam omnis</p>

                                            <a href="topics-detail.php" class="btn custom-btn mt-2 mt-lg-3">Learn More</a>
                                        </div>

                                        <span class="badge bg-finance rounded-pill ms-auto">25</span>
                                    </div>

                                    <div class="social-share d-flex">
                                        <p class="text-white me-4">Share:</p>

                                        <ul class="social-icon">
                                            <li class="social-icon-item">
                                                <a href="#" class="social-icon-link bi-twitter"></a>
                                            </li>

                                            <li class="social-icon-item">
                                                <a href="#" class="social-icon-link bi-facebook"></a>
                                            </li>

                                            <li class="social-icon-item">
                                                <a href="#" class="social-icon-link bi-pinterest"></a>
                                            </li>
                                        </ul>

                                        <a href="#" class="custom-icon bi-bookmark ms-auto"></a>
                                    </div>

                                    <div class="section-overlay"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section> -->
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