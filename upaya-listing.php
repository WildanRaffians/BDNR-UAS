<?php
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

        header("Location: upaya-listing.php");
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

        header("Location: upaya-listing.php");
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

        header("Location: upaya-listing.php");
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
                            <li class="nav-item"><a class="nav-link" href="topics-listing.php#list">List Sumber Air</a></li>
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
                            <!-- Form Tambah/Update Upaya -->
                            <div class="mt-5">
                                <h5 id="form-title">Tambah Upaya</h5>
                                <form method="POST" id="dynamic-form">
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
                            </div><br><br>

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
                                            <div class="custom-block-topics-listing-info d-flex">
                                                <div>
                                                    <h5 class="mb-2"><?= htmlspecialchars($upaya['nama_upaya']) ?></h5>
                                                    <form 
                                                        method="POST" 
                                                        class="d-inline"
                                                        onsubmit="return false;" 
                                                    >
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-warning" 
                                                            onclick="editData('<?= htmlspecialchars($upaya['_id']) ?>', '<?= htmlspecialchars($upaya['nama_upaya']) ?>')"
                                                        >
                                                            Edit
                                                        </button>
                                                    </form>


                                                    <form method="POST" class="d-inline">
                                                        <input type="hidden" name="id_upaya" value="<?= htmlspecialchars($upaya['_id']) ?>">
                                                        <button type="submit" name="delete_upaya" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                    <h6>Sumber Air yang Membutuhkan:</h6>
                                                    <p>
                                                        <?php
                                                        $sumberAirList = $listSumberAirByUpaya[$upaya['_id']] ?? [];
                                                        
                                                        if (!empty($sumberAirList)) {
                                                            foreach ($sumberAirList as $sumberAir) {
                                                                ?>
                                                                <a href="topics-detail.php?id_sumber_air=<?= htmlspecialchars($sumberAir['_id']) ?>" style="padding-top: 5px;">
                                                                    <button type="button" class="btn btn-info"><?= htmlspecialchars($sumberAir['nama_sumber_air']) ?></button>
                                                                </a>
                                                                <?php
                                                            }
                                                        } else {
                                                            echo " -- -- --";
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
