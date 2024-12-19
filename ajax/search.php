<?php

    include('../function.php');
    global $conn;
    $keyword = $_GET["keyword"];
    $sort = $_GET["sort"];
    $order = $_GET["order"];
    $provinsi = $_GET["provinsi"];
    $regency = $_GET["regency"];    
    $jenis = $_GET["jenis"];
    $kondisi = $_GET["kondisi"];

    // echo "<script>alert('$sort' + ' $order' + ' $jenis')</script>";

$query = 
"SELECT * FROM sumber_air 
JOIN regencies ON sumber_air.id_kabupaten = regencies.id
JOIN provinces ON regencies.province_id = provinces.id
JOIN jenis_sumber_air ON sumber_air.id_jenis_sumber_air = jenis_sumber_air.id_jenis_sumber_air
WHERE 
( nama_sumber_air LIKE '%$keyword%'OR
kondisi_sumber_air LIKE '%$keyword%'OR
suhu LIKE '%$keyword%'OR
warna LIKE '%$keyword%'OR
pH LIKE '%$keyword%'OR
layak_minum LIKE '%$keyword%'OR
name LIKE '%$keyword%'OR
provinces_name LIKE '%$keyword%'OR
nama_jenis_sumber_air LIKE '%$keyword%' ) 
";
if($provinsi != '') {
$query .= "AND regencies.province_id = '$provinsi' ";
}
if($regency != '') {
$query .= "AND sumber_air.id_kabupaten = '$regency' ";
}

if($jenis != '') {
$query .= "AND sumber_air.id_jenis_sumber_air = '$jenis' ";
}
if($kondisi != '') {
$query .= "AND sumber_air.kondisi_sumber_air = '$kondisi' ";
}
    
$query .= " ORDER BY $sort $order";

    $listSumberAir = mysqli_query($conn, $query);

    $dataPerSlide = 3;
    $dataCount = mysqli_num_rows($listSumberAir);
    $slideCount = ceil($dataCount / $dataPerSlide);

    $slideNo = 0;
    // 0 1 2, 1
    // 3 4 5, 2
    // 6 7 8, 3
    //$startSlide = ($dataPerSlide * $activeSlide) - $dataPerSlide;

    function readSumberAirLimitSearch($conn, $query, $start, $limit) {
        
        $query .= " LIMIT $start, $limit";
        $result = mysqli_query($conn, $query);
        return $result;
        
    
    }

    

    $slides = [];
    for($i = 2; $i <= $slideCount + 1; $i++) {
        array_push($slides, readSumberAirLimitSearch($conn, $query, $slideNo, $dataPerSlide));
        $slideNo = ($dataPerSlide * $i) - $dataPerSlide;

    }

?>

<?php
for($i = 0; $i < $slideCount; $i++) {
    // foreach($slides[$i] as $data) {
    //     var_dump($data);
    // }
?>

<div class="tab-pane fade <?php if($i == 0) echo "show"     ?>" id="all-pane" role="tabpanel" aria-labelledby="all" data-index="<?=$i?>" style="position:absolute">
<div class="row">
<?php


$count = 0;
foreach($slides[$i] as $sumberAir) 
{
    ?>
<div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-3" >
    <div class="custom-block bg-white shadow-lg">
        <a href="topics-detail.php?id_sumber_air=<?=$sumberAir['id_sumber_air']?>">
            <div class="d-flex">
                <div>
                    <h5 class="mb-2"><?=$sumberAir['nama_sumber_air']?></h5>
                    <h6 class="mb-1"><?=$sumberAir['name']?>, <?=$sumberAir['provinces_name']?></h6>

                    <p class="mb-0">Kondisi Sumber Air : <?=$sumberAir['kondisi_sumber_air']?></p>
                    <p class="mb-1">Kelayakan Minum : <?=$sumberAir['layak_minum']?></p>
                </div>

                <span class="badge bg-design rounded-pill ms-auto"><?=$sumberAir['id_sumber_air']?></span>
            </div>
            
                <img class="img-fluid " src="images/foto_sumber_air/<?=$sumberAir['foto_sumber_air']?>" class="custom-block-image img-fluid" alt="" style="border-radius: 20px;">
            
        </a>
    </div>
</div>

<?php
$count++;
}
?>


</div>
</div> 
<?php
}
?>