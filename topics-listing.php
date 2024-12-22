<?php
    // include('function.php');
    // $listSumberAir = readSumberAir();

    // URL API untuk mengambil data
    $urlSumberAir = "http://localhost:5000/api/sumber_air_lookup"; // Ganti dengan URL endpoint API Anda
    // $urlSumberAirUpaya = "http://localhost:5000/api/sumber-air-upaya"; // Tambahkan endpoint sumber air jika ada
    
    // Mengambil data Upaya dari API
    $listSumberAir = json_decode(file_get_contents($urlSumberAir), true);

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
<!--

TemplateMo 590 topic listing

https://templatemo.com/tm-590-topic-listing

-->
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

                            <li class="nav-item" >
                                <a class="nav-link active"  href="topics-listing.php#list" >List Sumber Air</a>
                            </li>

                            <li class="nav-item" >
                                <a class="nav-link"  href="upaya-listing.php#list" >List Upaya Pelestarian</a>
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


            <section class="section-padding" id="list">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12 text-center">
                            <h3 class="mb-4">Sumber Air</h3>
                            <!-- Button trigger modal -->
                            
                            <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Filter
                            </button> -->
                        </div>

                

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Filters</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <!-- Example single danger button -->
                                            
                                            <!-- <div class="btn-group">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Field
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                                                </ul>
                                            </div> -->
                                        <div class="row">
                                            
                                            <div class="col-sm-3" style="display: inline-block">Sort by : </div>
                                            
                                            <div class="col-sm-3" >
                                            <div style="display: inline-block">
                                                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                                    <option selected>Open this select menu</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3" style="display: inline-block">Order by : </div>
                                        <div class="col-sm-3" >
                                            <div style="display: inline-block">
                                                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                                    <option selected>Open this select menu</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                        </div>

                                        </div>
                            
                                        
                                            
                                    
                                        <!-- <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Order
                                        </button>
                                        
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><option value="">test</option></a></li>
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="#">Separated link</a></li>
                                        </ul>
                                        </div> -->

                                        

                                        
                                        
                                        <br>
                                        <br>
                                        <div class="input-group">
                                        <span class="input-group-text">Range Suhu dari</span>
                                        <input type="text" aria-label="First name" class="form-control" >
                                        <span class="input-group-text">sampai</span>
                                        <input type="text" aria-label="Last name" class="form-control" >
                                        </div>

                                        <br>
                                        
                                        <div class="input-group">
                                        <span class="input-group-text">Range pH dari</span>
                                        <input type="text" aria-label="First name" class="form-control" >
                                        <span class="input-group-text">sampai</span>
                                        <input type="text" aria-label="Last name" class="form-control" >
                                        </div> 
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem vero dolores cumque corrupti, ullam at iusto officiis laborum sit minus nobis debitis quis harum dolorum, obcaecati doloremque modi nisi. Ipsa!

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="submit-filter">Save changes</button>
                                    </div>
                                </form>
                                    </div>
                                </div>
                            </div>


                        
                        <div class="col-lg-8 col-12 mt-3 mx-auto">
                        <?php
                            $cacah = 0;
                            foreach($listSumberAir as $sumberAir){
                                
                        ?>
                            <div class="custom-block custom-block-topics-listing bg-white shadow-lg mb-5">
                                <div class="d-flex">
                                    <span class="badge bg-design rounded-pill"><?=$cacah+=1?></span>
                                    <img src="images/foto_sumber_air/<?=$sumberAir['foto_sumber_air']?>" class="custom-block-image img-fluid" alt=""  style="border-radius: 10px;">

                                    <div class="custom-block-topics-listing-info d-flex">
                                        <div>
                                            <h5 class="mb-2"><?=$sumberAir['nama_sumber_air']?></h5>

                                            <h6 class="mb-1"><?=$sumberAir["kabupaten"]["name"]?>, <?=$sumberAir['provinsi']['name']?></h6>

                                            <br>

                                            <p class="mb-0">Kondisi Sumber Air : <?=$sumberAir['kondisi_sumber_air']?></p>
                                            <p class="mb-0">Kelayakan Minum : <?=$sumberAir['kelayakan']?></p>

                                            <a href="topics-detail.php?id_sumber_air=<?=$sumberAir['_id']?>" class="btn custom-btn mt-3 mt-lg-4">Detail</a>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <?php
                                }
                            ?>

                            <!-- <div class="custom-block custom-block-topics-listing bg-white shadow-lg mb-5">
                                <div class="d-flex">
                                    <img src="images/topics/undraw_online_ad_re_ol62.png" class="custom-block-image img-fluid" alt="">

                                    <div class="custom-block-topics-listing-info d-flex">
                                        <div>
                                            <h5 class="mb-2">Advertising</h5>

                                            <p class="mb-0">Visit TemplateMo website to download free CSS templates. Lorem ipsum dolor, sit amet consectetur adipisicing elit animi necessitatibus</p>

                                            <a href="topics-detail.php" class="btn custom-btn mt-3 mt-lg-4">Learn More</a>
                                        </div>

                                        <span class="badge bg-advertising rounded-pill ms-auto">30</span>
                                    </div>
                                </div>
                            </div>

                            <div class="custom-block custom-block-topics-listing bg-white shadow-lg mb-5">
                                <div class="d-flex">
                                    <img src="images/topics/undraw_Podcast_audience_re_4i5q.png" class="custom-block-image img-fluid" alt="">

                                    <div class="custom-block-topics-listing-info d-flex">
                                        <div>
                                            <h5 class="mb-2">Podcast</h5>

                                            <p class="mb-0">Lorem ipsum dolor, sit amet consectetur adipisicing elit animi necessitatibus</p>

                                            <a href="topics-detail.php" class="btn custom-btn mt-3 mt-lg-4">Learn More</a>
                                        </div>

                                        <span class="badge bg-music rounded-pill ms-auto">20</span>
                                    </div>
                                </div>
                            </div> -->
                        </div>

                        <!-- <div class="col-lg-12 col-12">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center mb-0">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">Prev</span>
                                        </a>
                                    </li>

                                    <li class="page-item active" aria-current="page">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    
                                    <li class="page-item">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    
                                    <li class="page-item">
                                        <a class="page-link" href="#">3</a>
                                    </li>

                                    <li class="page-item">
                                        <a class="page-link" href="#">4</a>
                                    </li>

                                    <li class="page-item">
                                        <a class="page-link" href="#">5</a>
                                    </li>
                                    
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div> -->

                    </div>
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