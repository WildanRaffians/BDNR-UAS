<?php
$dataPerSlide = 3;
$dataCount = 5;
$slideCount = ceil($dataCount / $dataPerSlide);
$activeSlide = (isset($_GET["slide"])) ? $_GET["slide"] : 1;
$slideNo = 0;
$startSlide = ($dataPerSlide * $activeSlide) - $dataPerSlide;
// URL API
$base_url = 'http://localhost:5000/api/sumber_air_wilayah_limit';

// Simpan URL untuk masing-masing parameter
$slides = [
    // $base_url . '?start=0&limit=3',
    $base_url . '?start=3&limit=2'
];

// Hasil API
$data_slides = [];

// Ambil data dari API untuk setiap URL
foreach ($slides as $url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Decode JSON menjadi array
    $data = json_decode($response, true);

    if (is_array($data)) {
        $data_slides[] = $data;
    } else {
        $data_slides[] = [];
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>HydroCulus</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/bootstrap-icons.css" rel="stylesheet">

    <link href="css/templatemo-topic-listing.css" rel="stylesheet">

    <style>
        .image-wrapper {
            position: relative;
            display: inline-block;
            /* border-radius: 20px; */
        }

        .image-wrapper::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;

            box-shadow: 0 0 5px 5px white inset;
        }
    </style>

</head>

<body class="topics-listing-page" id="top">
    <input type="number" hidden id="slideCount" value="<?= $slideCount ?>">
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
                            <a class="nav-link " href="topics-listing.php#section_1">List Sumber Air</a>
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


        <section class="hero-section d-flex justify-content-center align-items-center" id="section_0">
            <div class="container">
                <div class="row">

                    <div class="col-lg-8 col-12 mx-auto">
                        <h1 class="text-white text-center">Sumber Air di Indonesia</h1>

                    </div>

                </div>
            </div>
        </section>


        <section class="featured-section" style="border-radius: 0">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-lg-4 col-12 mb-4 mb-lg-0">
                        <div class="custom-block bg-white shadow-lg">
                            <a href="topics-listing.php#list">
                                <div class="d-flex">
                                    <div>
                                        <h5 class="mb-2">HydroCulus?</h5>

                                        <p class="mb-0">Kami adalah website yang berfokus pada pencarian sumber air di Indonesia.</p>
                                    </div>

                                    <span class="badge bg-design rounded-pill ms-auto">19</span>
                                </div>

                                <img src="images/topics/undraw_Remote_design_team_re_urdx.png" class="custom-block-image img-fluid" alt="">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-12">
                        <div class="custom-block custom-block-overlay">
                            <div class="d-flex flex-column h-100">
                                <img src="images/tetesan-air-0.jpg" class="custom-block-image img-fluid" alt="">

                                <div class="custom-block-overlay-text d-flex">
                                    <div>
                                        <h5 class="text-white mb-2">Bisa ngapain aja?</h5>
                                        <p class="text-white">Kalian bisa mencari daerah yang memiliki sumber air dan juga karakteristiknya. Mengetahui kondisinya? Bisa. Suhunya? Bisa dong. Warna dan pH-nya? Tentu saja bisa. Kalian juga bisa mencari hal lainnya yang berkaitan dengan sumber air di Indonesia :)</p>
                                        <a href="#all" class="btn custom-btn mt-2 mt-lg-3">Jelajahi</a>
                                    </div>

                                    <span class="badge bg-finance rounded-pill ms-auto">45</span>
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
                                            <a href="#" class="social-icon-link bi-instagram"></a>
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
        </section>

        <section class="explore-section section-padding" id="section_2" style="padding-top: 0px; padding-bottom: 500px" style="position: relative">
            <!-- <a id="prev-button" style="position:absolute; left: 0; top: 1100px; width: 50px; height:500px; z-index: 99;"></a>
            <a id="next-button" style="position:absolute; right: 0; top: 1150px; width: 50px; height:500px; z-index: 99;"></a>
            <img src="images/button/next-svgrepo-com.svg" alt="" style="position:absolute; top: 1350px; right: 0; width:30px; height:30px; z-index: 98;">
            <img src="images/button/previous-svgrepo-com.svg" alt="" style="position:absolute; top: 1350px; left: 0; width:30px; height:30px; z-index: 98;"> -->
            <div class="container-fluid">
                <div class="row">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="all" data-bs-toggle="tab" data-bs-target="#all-pane" type="button" role="tab" aria-controls="all-pane" aria-selected="true">Sumber Air</button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="tab-content" id="myTabContent" style="position:relative">
                            <div id="active-search">
                                <?php
                                foreach ($data_slides as $index => $sumber_air_list) {
                                ?>
                                    <div class="tab-pane fade " id="all-pane" role="tabpanel" aria-labelledby="all" data-index="0" style="position:absolute">
                                        <div class="row">
                                            <?php
                                            $count = 0;
                                            foreach ($sumber_air_list as $sumberAir) {
                                            ?>
                                                <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-3">
                                                    <div class="custom-block bg-white shadow-lg">
                                                        <a href="topics-detail.php?id_sumber_air=<?= $sumberAir['_id'] ?>">
                                                            <div class="d-flex">
                                                                <div>
                                                                    <h5 class="mb-2"><?= $sumberAir['nama_sumber_air'] ?></h5>
                                                                    <h6 class="mb-1"><?= $sumberAir['kabupaten']['name'] ?>, <?= $sumberAir['provinsi']['name'] ?></h6>
                                                                    <p class="mb-0">Kondisi Sumber Air : <?= $sumberAir['kondisi_sumber_air'] ?></p>
                                                                    <p class="mb-1">Kelayakan Minum : <?= $sumberAir['kelayakan'] ?></p>
                                                                </div>
                                                                <!-- <span class="badge bg-design rounded-pill ms-auto">0</span> -->
                                                            </div>
                                                            <img class="img-fluid " src="images/foto_sumber_air/<?= $sumberAir['foto_sumber_air'] ?>" class="custom-block-image img-fluid" alt="" style="border-radius: 20px;">
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php
                                                $count++;
                                            }
                                            ?>
                                            <?php
                                            if (1 == 1) {
                                            ?>
                                                <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-3">
                                                    <div class="custom-block bg-white shadow-lg">
                                                        <a href="topics-listing.php#section_1">
                                                            <div class="d-flex">
                                                                <div>
                                                                    <br>
                                                                    <h5 class="mb-1">Masih banyak loh sumber air lainnya.</h5>
                                                                    <br>
                                                                    <h6 class="mb-1">Yuk lihat</h6>
                                                                    <br>
                                                                </div>
                                                                <!-- <span class="badge bg-design rounded-pill ms-auto">0</span> -->
                                                            </div>
                                                            <img class="img-fluid " src="images/lainnya.png" class="custom-block-image img-fluid" alt="" style="border-radius: 20px;">
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>

                            </div>
                        </div>
        </section>

        <section class="timeline-section section-padding" id="section_3">
            <div class="section-overlay"></div>

            <div class="container">
                <div class="row">

                    <div class="col-12 text-center">
                        <h2 class="text-white mb-4">Upaya Melestarikan Sumber Air</h1>
                    </div>

                    <div class="col-lg-10 col-12 mx-auto">
                        <div class="timeline-container">
                            <ul class="vertical-scrollable-timeline" id="vertical-scrollable-timeline">
                                <div class="list-progress">
                                    <div class="inner"></div>
                                </div>

                                <li>
                                    <h4 class="text-white mb-3">Memperluas gerakan penghijauan</h4>

                                    <p class="text-white">Penghijauan sebagai saran pencegah terjadinya bencana banjir dan erosi tanah. Dengan banyaknya pohon besar dan tinggi, air hujan akan diserap oleh akar tumbuhan. Kemudian air hujan tersebut diubah menjadi air tanah yang dapat memenuhi kebutuhan manusia dan makhluk lainnya.</p>

                                    <div class="icon-holder">
                                        <i class="bi-search"></i>
                                    </div>
                                </li>

                                <li>
                                    <h4 class="text-white mb-3">Menggunakan air bersih dengan bijaksana</h4>

                                    <p class="text-white">Menggunakan air bersih dengan bijaksana atau seperlunya saja memiliki banyak manfaat. Diantaranya adalah dapat menjaga cadangan air agar tidak menipis, menjaga keseimbangan jumlah air, menjaga keseimbangan ekosistem air, dan untuk menghemat biaya pengeluaran air.</p>

                                    <div class="icon-holder">
                                        <i class="bi-lightbulb-fill"></i>
                                    </div>
                                </li>

                                <li>
                                    <h4 class="text-white mb-3">Tidak membuang sampah sembarangan</h4>

                                    <p class="text-white">Membuang sampah ke tempatnya ataupun melakukan 3R (Reduce, Reuse, Recycle) merupakan langkah mudah yang bisa dilakukan oleh masyarakat untuk melestarikan sumber air.</p>

                                    <div class="icon-holder">
                                        <i class="bi-trash"></i>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-12 text-center mt-5">
                        <p class="text-white">
                            Ingin tahu lebih banyak?
                            <a href="upaya-listing.php" class="btn custom-btn custom-border-btn ms-3">lainnya</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="faq-section section-padding" id="section_4">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-12">
                        <h2 class="mb-4">Sumber Air itu apa sih?</h2>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-lg-5 col-12">
                        <img src="images/faq_graphic.jpg" class="img-fluid" alt="FAQs">
                    </div>

                    <div class="col-lg-6 col-12 m-auto">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Apa itu sumber air?
                                    </button>
                                </h2>

                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        sumber air adalah tempat atau wadah air alami dan atau buatan yang terdapat pada, di atas, ataupun di bawah permukaan tanah.
                                        Beberapa jenis sumber air diantaranya adalah mata air, waduk, sungai, danau dan sumur.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Sumber air dengan kondisi yang baik?
                                    </button>
                                </h2>

                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Sumber air yang memiliki kondisi yang baik adalah sumber air yang baik dalam penyediaan dan penggunaannya. Sumber air yang menyediakan air melimpah juga konsisten, dapat digunakan oleh masyarakat dengan baik,
                                        memiliki fasilitas yang terawat, memiliki akses yang mudah, tidak rusak dan tidak tercemar sampah.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Sumber air perlu dilestarikan?
                                    </button>
                                </h2>

                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Tentu saja sumber air perlu dilestarikan. Kita harus berupaya untuk menjaga ketersediaan dan kualitas air pada sumber air. Karena air menjalankan fungsi penting untuk keberlangsungan hidup manusia. Air yang bersih adalah hak asasi manusia karena air yang bersih berguna untuk menopang kesehatan masyarakat. Oleh karenanya penting bagi manusia melestarikan air dan menggunakannya dengan bijak.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- <section class="contact-section section-padding section-bg" id="section_5">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12 text-center">
                            <h2 class="mb-5">Get in touch</h2>
                        </div>

                        <div class="col-lg-5 col-12 mb-4 mb-lg-0">
                            <iframe class="google-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2595.065641062665!2d-122.4230416990949!3d37.80335401520422!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80858127459fabad%3A0x808ba520e5e9edb7!2sFrancisco%20Park!5e1!3m2!1sen!2sth!4v1684340239744!5m2!1sen!2sth" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mb-3 mb-lg- mb-md-0 ms-auto">
                            <h4 class="mb-3">Head office</h4>

                            <p>Bay St &amp;, Larkin St, San Francisco, CA 94109, United States</p>

                            <hr>

                            <p class="d-flex align-items-center mb-1">
                                <span class="me-2">Phone</span>

                                <a href="tel: 305-240-9671" class="site-footer-link">
                                    305-240-9671
                                </a>
                            </p>

                            <p class="d-flex align-items-center">
                                <span class="me-2">Email</span>

                                <a href="mailto:info@company.com" class="site-footer-link">
                                    info@company.com
                                </a>
                            </p>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mx-auto">
                            <h4 class="mb-3">Dubai office</h4>

                            <p>Burj Park, Downtown Dubai, United Arab Emirates</p>

                            <hr>

                            <p class="d-flex align-items-center mb-1">
                                <span class="me-2">Phone</span>

                                <a href="tel: 110-220-3400" class="site-footer-link">
                                    110-220-3400
                                </a>
                            </p>

                            <p class="d-flex align-items-center">
                                <span class="me-2">Email</span>

                                <a href="mailto:info@company.com" class="site-footer-link">
                                    info@company.com
                                </a>
                            </p>
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
                            <a href="#" class="site-footer-link">Home</a>
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
    <script src="js/click-scroll.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/search.js"></script>

</body>

</html>