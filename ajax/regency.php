<?php
    include('../function.php');
    global $conn;
    $provinsi = $_GET['provinsi'];
    $query = "SELECT * from regencies";
    if($provinsi != '') $query .= " where province_id = $provinsi";
    $r_regencies = mysqli_query($conn, $query);
    // $check = var_dump($r_regencies);
    echo "<script>console.log('$query')</script>"
?>


    <div id="regency" class="col-12 col-sm-2">
        <select id="filter-regency" name="regency_sumber_air" class="form-select mt-2"  style="padding-top: 0px;padding-bottom: 0px;margin-bottom: 30px;" aria-label="Default select example" >
            <option value="" selected disabled>Kota / Kabupaten</option>
            <option value="" >All</option>
                <?php
                    foreach($r_regencies as $regency) {
                ?>
                    <option value="<?=$regency['id']?>"> <?=$regency['id']?> - <?=$regency['name']?></option>
                <?php  
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
