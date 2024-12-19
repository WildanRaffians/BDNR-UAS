<?php
    session_start();
    if(!isset($_SESSION["login"])) {
        header("Location: login.php");
    }
    include('function.php');
    global $conn;
    $listUpaya = readUpaya();
    // $listSumberAir = readSumberAir();

    // $r_jenis = readTable($conn, 'jenis_sumber_air');
    // $r_wilayah = readTable('wilayah');
    // $r_upaya = readTable($conn, 'upaya_peningkatan_ketersediaan_air');
    // echo '<pre>';
    // print_r($r_jenis);

    // foreach($r_jenis as $jenis) {
    //     echo $jenis['nama_jenis_sumber_air'];
    // }

    // echo "<br>";


if (isset($_POST['submit-add'])) {

    // $listUpaya = $_POST['listUpaya'];

  // jalankan query tambah record baru
  $isAddSucceed = addUpaya($_POST, $_FILES);
  
  
  if ($isAddSucceed > 0) {
    // jika penambahan sukses, tampilkan alert
    echo "
          <script>
              
              alert('Data Berhasil di ditambahkan');
              document.location.href = 'admin_upaya.php#topics-detail';
          </script>
      ";
  } 
}

// print_r($r_jenis);
// echo $isAddSucceed;
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Topic Listing Contact Page</title>

        <!-- CSS FILES -->        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap" rel="stylesheet">
                        
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link href="css/templatemo-topic-listing.css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

	    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

        <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script> -->
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

                            <li class="nav-item">
                                <a class="nav-link " href="topics-listing.php#list" >List Sumber Air</a>
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
                                    <li class="breadcrumb-item"><a href="index.php">Homepage</a></li>

                                    <li class="breadcrumb-item active" aria-current="page">Add Upaya Pelestarian</li>
                                </ol>
                            </nav>

                            <h2 class="text-white">Add Upaya Pelestarian</h2>
                        </div>

                    </div>
                </div>
            </header>


            <section class="section-padding section-bg" id="form">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12">
                            <h3 class="mb-4 pb-2">Data Upaya Pelestarian Baru</h3>
                        </div>

                        <div class="col-lg-6 col-12">
                            <form action="#" method="post" class="custom-form contact-form" role="form" id="form-update" enctype="multipart/form-data">
                                 
                                <div class="row">
                                    <div class="col-lg-12 col-12">
                                        <div class="form-floating">
                                            <textarea name="nama_upaya" id="upaya" class="form-control" placeholder="" required></textarea>
                                            
                                            <label for="floatingInput">Masukkan Upaya</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12 ms-auto">
                                        <button form="form-update" type="submit" class="form-control" name="submit-add" id="submit-add" style="margin-top: 12px;">Submit</button>
                                    </div>

                                </div>

                                
                                
                            </div>
                                <div class="col-lg-5 col-12 mx-auto mt-5 mt-lg-0">
                                    <div class="topics-detail-block bg-white shadow-lg" id="imgBox">
                                        <img src="images/mondo.jpg" class="topics-detail-block-image img-fluid">
                                    </div>
                                    <br>
                                    
                                </div>
                            </form>
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
        <!-- slider -->
        

           


        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/custom.js"></script>

    </body>
</html>