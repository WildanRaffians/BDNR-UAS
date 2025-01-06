<?php
    session_start();
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

    // URL API untuk mengambil data dan operasi CRUD
    $urlUpaya = "http://localhost:5000/api/upaya"; // Endpoint GET all
    $urlUpayaCreate = "http://localhost:5000/api/upaya-create"; // Endpoint POST
    $urlUpayaUpdate = "http://localhost:5000/api/upaya-update"; // Endpoint PUT
    $urlUpayaDelete = "http://localhost:5000/api/upaya-delete"; // Endpoint DELETE

    // Mengambil data Upaya dari API
    $listUpaya = json_decode(file_get_contents($urlUpaya), true);

    // Fungsi CREATE (POST) Upaya
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_upaya'])) {
        $namaUpaya = $_POST['nama_upaya'];
        $data = ["nama_upaya" => $namaUpaya];

        $options = [
            'http' => [
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
            ],
        ];
        $context  = stream_context_create($options);
        file_get_contents($urlUpayaCreate, false, $context);

        header("Location: admin_upaya.php");
        exit;
    }

    // Fungsi UPDATE (PUT) Upaya
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_upaya'])) {
        $idUpaya = $_POST['id_upaya'];
        $namaUpaya = $_POST['nama_upaya'];
        $data = ["nama_upaya" => $namaUpaya];

        $options = [
            'http' => [
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'PUT',
                'content' => json_encode($data),
            ],
        ];
        $context  = stream_context_create($options);
        file_get_contents("$urlUpayaUpdate/$idUpaya", false, $context);

        header("Location: admin_upaya.php");
        exit;
    }

    // Fungsi DELETE (DELETE) Upaya
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_upaya'])) {
        $idUpaya = $_POST['id_upaya'];

        $options = [
            'http' => [
                'method' => 'DELETE',
            ],
        ];
        $context  = stream_context_create($options);
        file_get_contents("$urlUpayaDelete/$idUpaya", false, $context);

        header("Location: admin_upaya.php");
        exit;
    }
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
    </head>
    
    <body id="top">

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
                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="dashboard.php#chart">Dashboard</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="topics-listing.php">List Sumber Air</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="upaya-listing.php">List Upaya Pelestarian</a>
                            </li>
                        </ul>
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
                    <a type="button" class="btn btn-secondary btn-sm" href="admin.php#topics-detail">Tabel Sumber Air</a>
                    <a type="button" class="btn btn-primary btn-sm" href="admin_upaya.php#topics-detail">Tabel Upaya</a>
                    <br><br><br>
                    <h1>Tabel Upaya Pelestarian Sumber Air</h1><br><br>
                    <form method="POST" id="dynamic-form">
                        <h5 id="form-title">Tambah Upaya</h5>
                        <input type="hidden" id="id_upaya" name="id_upaya">
                        <div class="mb-3">
                            <textarea 
                                id="nama_upaya" 
                                name="nama_upaya" 
                                class="form-control" 
                                placeholder="Masukkan deskripsi upaya pelestarian..." 
                                rows="5" 
                                required
                            ></textarea>
                        </div>
                        <button type="submit" name="create_upaya" id="form-button" class="btn btn-primary">Tambah</button>
                        <button type="button" id="cancel-button" class="btn btn-secondary" onclick="resetForm()" style="display: none;">Batal</button>
                    </form>
                    <br><br>
                    <table class="table caption-top">
                        <caption>List of upaya</caption>
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Upaya</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $cacah = 1;
                                foreach ($listUpaya as $upaya) {
                            ?>
                            <tr>
                                <th scope="row"><?=$cacah?></th>
                                <td><?=$upaya['nama_upaya']?></td>
                                <td>
                                    <button 
                                        type="button" 
                                        class="btn btn-outline-success" 
                                        onclick="editData('<?=$upaya['_id']?>', '<?=$upaya['nama_upaya']?>')"
                                    >
                                        Update
                                    </button>
                                    <form method="POST" class="d-inline">
                                        <input type="hidden" name="id_upaya" value="<?=$upaya['_id']?>">
                                        <button type="submit" name="delete_upaya" class="btn btn-outline-danger">Delete</button>
                                    </form>
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
        <script>
        function editData(id, nama) {
            // Ubah judul formulir
            document.getElementById('form-title').innerText = 'Update Upaya';

            // Isi input dengan data
            document.getElementById('id_upaya').value = id;
            document.getElementById('nama_upaya').value = nama;

            // Ubah tombol menjadi tombol update
            const formButton = document.getElementById('form-button');
            formButton.innerText = 'Update';
            formButton.name = 'update_upaya';
            formButton.classList.remove('btn-primary');
            formButton.classList.add('btn-warning');

            // Tampilkan tombol batal
            document.getElementById('cancel-button').style.display = 'inline-block';
        }

        function resetForm() {
            // Reset judul formulir
            document.getElementById('form-title').innerText = 'Tambah Upaya';

            // Kosongkan input
            document.getElementById('id_upaya').value = '';
            document.getElementById('nama_upaya').value = '';

            // Ubah tombol menjadi tombol tambah
            const formButton = document.getElementById('form-button');
            formButton.innerText = 'Tambah';
            formButton.name = 'create_upaya';
            formButton.classList.remove('btn-warning');
            formButton.classList.add('btn-primary');

            // Sembunyikan tombol batal
            document.getElementById('cancel-button').style.display = 'none';
        }
        </script>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/custom.js"></script>

    </body>
</html>