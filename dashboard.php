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
            <a type="button" class="btn btn-primary btn-sm" href="#chart">Keseluruhan</a>
            <a type="button" class="btn btn-secondary btn-sm" href="dashboard2.php#chart">Kategori per Provinsi</a>
            <!-- <a type="button" class="btn btn-secondary btn-sm" href="#chart">Peta</a> -->
            <br><br><br>
            <!-- Baris 1: Ringkasan -->
            <div class="row ringkasan mb-4" style="justify-content: center;">
                <div class="col-md-2">
                    <div class="card">
                        <h5>Jumlah Sumber Air</h5>
                        <h2 id="jumlahSumberAir">0</h2>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <h5>Jumlah Wilayah</h5>
                        <h2 id="jumlahKabupaten">0</h2>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <h5>Rata-rata Suhu</h5>
                        <h2 id="rataSuhu">0</h2>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <h5>Rata-rata pH</h5>
                        <h2 id="rataPH">0</h2>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <h5>Jumlah Upaya</h5>
                        <h2 id="jumlahUpaya">0</h2>
                    </div>
                </div>
            </div>

            <!-- Baris 2: Bar Chart dan Pie Chart -->
            <div class="row charts mb-4" style="justify-content: center;">
                <div class="col-md-4" style="width: 60%;">
                    <div class="card chart-container">
                        <canvas id="kondisiChart"></canvas>
                    </div>
                </div>
                <div class="col-md-4" style="width: 30%;">
                    <div class="card chart-container">
                        <canvas id="kelayakanChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Baris 3: Pie Chart Warna -->
            <div class="row charts" style="justify-content: center;">
                <div class="col-md-4" style="width: 60%;">
                    <div class="card chart-container">
                        <canvas id="jenisChart"></canvas>
                    </div>
                </div>
                <div class="col-md-4" style="width: 30%;">
                    <div class="card chart-container">
                        <canvas id="warnaChart"></canvas>
                    </div>
                </div>
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
    <script>
        // Ambil data dari API
        fetch('http://127.0.0.1:5000/api/sumber_air_lookup')
            .then(response => response.json())
            .then(data => {
                // Jumlah Sumber Air
                const jumlahSumberAir = data.length;

                // Hitung jumlah kabupaten unik
                const kabupatenSet = new Set(data.map(item => item.kabupaten.name));
                const jumlahKabupaten = kabupatenSet.size;

                // Hitung rata-rata suhu
                const totalSuhu = data.reduce((sum, item) => sum + item.suhu, 0);
                const rataSuhu = (totalSuhu / jumlahSumberAir).toFixed(2);

                // Hitung rata-rata pH
                const totalPH = data.reduce((sum, item) => sum + item.ph, 0);
                const rataPH = (totalPH / jumlahSumberAir).toFixed(2);

                // Perbarui elemen HTML dengan hasil
                document.getElementById('jumlahSumberAir').textContent = jumlahSumberAir;
                document.getElementById('jumlahKabupaten').textContent = jumlahKabupaten;
                document.getElementById('rataSuhu').textContent = rataSuhu + '°C';
                document.getElementById('rataPH').textContent = rataPH;
            })
            .catch(error => console.error('Error fetching data:', error));

        // Ambil data dari API
        fetch('http://127.0.0.1:5000/api/upaya')
            .then(response => response.json())
            .then(data => {
                // Hitung jumlah sumber air
                const jumlahUpaya = data.length;

                // Tampilkan jumlah di elemen HTML
                document.getElementById('jumlahUpaya').textContent = jumlahUpaya;
            })
            .catch(error => console.error('Error fetching data:', error));

        // Fungsi untuk mengambil data dari Flask
        async function fetchData() {
            const response = await fetch('http://127.0.0.1:5000/api/sumber_air_lookup');
            return await response.json();
        }

        // Render Grafik
        fetchData().then(data => {
            // Kondisi Sumber Air
            const kondisiCounts = {};
            data.forEach(item => {
                kondisiCounts[item.kondisi_sumber_air] = (kondisiCounts[item.kondisi_sumber_air] || 0) + 1;
            });

            const kondisiLabels = Object.keys(kondisiCounts);
            const kondisiValues = Object.values(kondisiCounts);

            new Chart(document.getElementById('kondisiChart'), {
                type: 'bar',
                data: {
                    labels: kondisiLabels,
                    datasets: [{
                        label: 'Jumlah Sumber Air',
                        data: kondisiValues,
                        backgroundColor: 'rgba(75, 192, 192, 0.67)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true
                        },
                        title: {
                            display: true,
                            text: 'Kondisi Sumber Air'
                        }
                    }
                }
            });

            // Bar Jenis
            const jenisCounts = {};

            // Iterasi melalui data untuk menghitung jumlah setiap jenis sumber air
            data.forEach(item => {
                const jenisNama = item.jenis_sumber_air.nama_jenis_sumber_air; // Ambil nama jenis sumber air
                jenisCounts[jenisNama] = (jenisCounts[jenisNama] || 0) + 1; // Tambahkan jumlahnya
            });

            // Ekstraksi label dan nilai untuk grafik
            const jenisLabels = Object.keys(jenisCounts); // Nama jenis sumber air
            const jenisValues = Object.values(jenisCounts); // Jumlah sumber air untuk setiap jenis

            // Membuat chart bar dengan Chart.js
            new Chart(document.getElementById('jenisChart'), {
                type: 'bar',
                data: {
                    labels: jenisLabels,
                    datasets: [{
                        label: 'Jumlah Sumber Air',
                        data: jenisValues,
                        backgroundColor: 'rgba(75, 122, 192, 0.63)',
                        borderColor: 'rgb(75, 116, 192)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true
                        },
                        title: {
                            display: true,
                            text: 'Jenis Sumber Air'
                        }
                    }
                }
            });


            // Kelayakan Sumber Air
            const kelayakanCounts = {
                "Layak": data.filter(item => item.kelayakan === "Layak").length,
                "Tidak Layak": data.filter(item => item.kelayakan === "Tidak").length
            };

            new Chart(document.getElementById('kelayakanChart'), {
                type: 'pie',
                data: {
                    labels: Object.keys(kelayakanCounts),
                    datasets: [{
                        data: Object.values(kelayakanCounts),
                        backgroundColor: ['rgba(54, 235, 166, 0.63)', 'rgba(255, 99, 177, 0.68)'],
                        borderColor: ['rgb(54, 235, 117)', 'rgba(255, 99, 132, 1)'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true
                        },
                        title: {
                            display: true,
                            text: 'Kelayakan Minum Sumber Air'
                        }
                    }
                }
            });

            // Warna Sumber Air
            const warnaCounts = {
                "bening": data.filter(item => item.warna === "Bening").length,
                "keruh": data.filter(item => item.warna === "Keruh").length,
            };

            new Chart(document.getElementById('warnaChart'), {
                type: 'pie',
                data: {
                    labels: Object.keys(warnaCounts),
                    datasets: [{
                        data: Object.values(warnaCounts),
                        backgroundColor: ['rgba(54, 163, 235, 0.65)', 'rgba(255, 180, 99, 0.67)'],
                        borderColor: ['rgba(54, 162, 235, 1)', 'rgb(255, 161, 99)'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true
                        },
                        title: {
                            display: true,
                            text: 'Warna Sumber Air'
                        }
                    }
                }
            });
        });
    </script>

    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</body>

</html>