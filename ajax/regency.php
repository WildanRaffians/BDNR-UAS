<?php
    
    // Menyiapkan URL API untuk mendapatkan kabupaten berdasarkan provinsi
    $url = "http://localhost:5000/api/kabupaten?provinsi=" . urlencode($provinsi);

    // Menggunakan cURL untuk mengambil data dari API
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    
    // Decode data JSON yang didapatkan dari API
    $r_regencies = json_decode($response, true);

    // Debugging query
    echo "<script>console.log('$url')</script>";
?>

<div id="regency" class="col-12 col-sm-2">
    <select id="filter-regency" name="regency_sumber_air" class="form-select mt-2" style="padding-top: 0px;padding-bottom: 0px;margin-bottom: 30px;" aria-label="Default select example">
        <option value="" selected disabled>Kota / Kabupaten</option>
        <option value="">All</option>
        <?php
            if (is_array($r_regencies) && count($r_regencies) > 0) {
                foreach($r_regencies as $regency) {
        ?>
                    <option value="<?=$regency['id']?>"> <?=$regency['id']?> - <?=$regency['name']?></option>
        <?php  
                }
            } else {
                echo "<option value='' disabled>No data found</option>";
            }
        ?>
    </select>   
</div>

<script src="js/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        let regency = '';
        $('#filter-regency').on('change reset', function () {
            regency = this.value;
            console.log(regency);
        });
    });
</script>
