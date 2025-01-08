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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            /* width: 100%; */
            /* Pastikan kartu memenuhi kolom */
            /* max-width: 250px; */
            /* Ukuran maksimum kartu */
            min-height: 150px;
            background-color: rgb(255, 255, 255);
            border: none;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175);
            text-align: center;
        }
    </style>
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
                            <a class="nav-link active " href="dashboard.php#chart">Dashboard</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="topics-listing.php#section_1">List Sumber Air</a>
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

                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>

                        <h2 class="text-white">Dashboard Statistik Sumber Air</h2>
                    </div>

                </div>
            </div>
        </header>
        <div class="container" id="chart">
            <br>
            <br>
        </div>

        <!-- CHART -->
        <div class="container py-5 center">
            <div class="col-lg-12 col-12 text-center">
                <h3 class="mb-4">Statistik Sumber Air</h3>
            </div>
            <a type="button" class="btn btn-secondary btn-sm" href="dashboard.php#chart">Keseluruhan</a>
            <a type="button" class="btn btn-primary btn-sm" href="#chart">Kategori per Provinsi</a>
            <!-- <a type="button" class="btn btn-secondary btn-sm" href="#chart">Peta</a> -->
            <br><br><br>
            <div class="row mb-3">
                <!-- Dropdown Provinsi -->
                <div class="col-md-6">
                    <label for="province">Pilih Provinsi:</label>
                    <select id="province" class="form-control">
                        <option value="" disabled selected>Loading...</option>
                    </select>
                </div>

                <!-- Dropdown Statistik -->
                <div class="col-md-6">
                    <label for="statistik">Pilih Statistik:</label>
                    <select id="statistik" class="form-control">
                        <option value="" disabled selected>Pilih Statistik</option>
                        <option value="kondisi">Jumlah Berdasarkan Kondisi</option>
                        <option value="kelayakan">Jumlah Berdasarkan Kelayakan</option>
                        <option value="warna">Jumlah Berdasarkan Warna</option>
                        <option value="jenis_sumber_air">Jumlah Berdasarkan Jenis Sumber Air</option>
                        <option value="ph">Rerata pH per Kabupaten</option>
                        <option value="suhu">Rerata Suhu per Kabupaten</option>
                    </select>
                </div>
            </div>

            <!-- Chart -->
            <div id="chart-container">
                <canvas id="chartstat"></canvas>
            </div>
        </div>


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

                    <p class="copyright-text mt-lg-5 mt-4">Copyright © 2023 HydroCulus. <br> All rights reserved.

                </div>

            </div>
        </div>
    </footer>

    
    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            const provinceDropdown = $('#province');
            const statistikDropdown = $('#statistik');
            const chartContainer = $('#chart-container');
            let chart;
            

            // Load daftar provinsi
            $.ajax({
                url: 'http://127.0.0.1:5000/api/provinsi',
                method: 'GET',
                success: function(response) {
                    provinceDropdown.empty();
                    response.forEach(province => {
                        provinceDropdown.append(`<option value="${province.id_province}">${province.name}</option>`);
                    });
                    provinceDropdown.prepend('<option value="" disabled selected>Pilih Provinsi</option>');
                },
                error: function(error) {
                    console.error('Gagal memuat daftar provinsi:', error);
                    alert('Gagal memuat daftar provinsi. Coba lagi nanti.');
                }
            });

            // Event listener untuk memuat data statistik
            function loadStatistik() {
                const provinceId = provinceDropdown.val();
                const statistikType = statistikDropdown.val();

                if (!provinceId || !statistikType) return;

                $.ajax({
                    url: `http://127.0.0.1:5000/api/statistik?province_id=${provinceId}&type=${statistikType}`,
                    method: 'GET',
                    success: function(response) {
                        const labels = response.labels;
                        const data = response.data;

                        // Reset chart jika sudah ada
                        if (chart) chart.destroy();

                        // Buat chart baru
                        const ctx = document.getElementById('chartstat').getContext('2d');
                        chart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Data Statistik',
                                    data: data,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    },
                    error: function(error) {
                        console.error('Gagal memuat data statistik:', error);
                        alert('Gagal memuat data statistik. Coba lagi nanti.');
                    }
                });
            }

            // Trigger load statistik saat dropdown berubah
            provinceDropdown.change(loadStatistik);
            statistikDropdown.change(loadStatistik);
        });
    </script>



</body>

</html>