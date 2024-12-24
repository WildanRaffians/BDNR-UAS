<?php
    include('config.php');

    function readSumberAir(){
        global $conn;
        

        $query = 
            "SELECT * FROM sumber_air 
            JOIN regencies ON sumber_air.id_kabupaten = regencies.id
            JOIN provinces ON regencies.province_id = provinces.id
            JOIN jenis_sumber_air ON sumber_air.id_jenis_sumber_air = jenis_sumber_air.id_jenis_sumber_air
            ORDER BY id_sumber_air
            LIMIT 5
            ";
        $eksekusi = mysqli_query($conn, $query);

        return $eksekusi;
    }

    function readSumberAirLimit($start, $limit){
        global $conn;
        

        $query = 
            "SELECT * FROM sumber_air 
            JOIN regencies ON sumber_air.id_kabupaten = regencies.id
            JOIN provinces ON regencies.province_id = provinces.id
            JOIN jenis_sumber_air ON sumber_air.id_jenis_sumber_air = jenis_sumber_air.id_jenis_sumber_air
            ORDER BY id_sumber_air
            LIMIT $start, $limit
            ";

        


        $eksekusi = mysqli_query($conn, $query);

        return $eksekusi;
    }

 
    function readOneSumberAir($id){
        global $conn;

        $query = 
"SELECT * FROM sumber_air 
JOIN regencies ON sumber_air.id_kabupaten = regencies.id
JOIN provinces ON regencies.province_id = provinces.id
JOIN jenis_sumber_air ON sumber_air.id_jenis_sumber_air = jenis_sumber_air.id_jenis_sumber_air
WHERE sumber_air.id_sumber_air = " . $id;

        $eksekusi = mysqli_query($conn, $query);

        return $eksekusi;   
    }

    
    function readUpayaSumberAir($find){
        global $conn;
        $query = 
"SELECT *
FROM sumber_air_upaya_peningkatan 
JOIN upaya_peningkatan_ketersediaan_air ON sumber_air_upaya_peningkatan.id_upaya_peningkatan_ketersediaan_air = upaya_peningkatan_ketersediaan_air.id_upaya_ketersediaan_air 
WHERE sumber_air_upaya_peningkatan.id_sumber_air =" . $find;
$result = mysqli_query($conn, $query);
return $result;
    }

    function readCheckedUpaya($id) {
        global $conn;

        $query = 
"SELECT *
FROM
sumber_air_upaya_peningkatan
WHERE
id_sumber_air =" . $id;

        $eksekusi = mysqli_query($conn, $query);

        return $eksekusi;
    }


    function readTable($table){
        global $conn;
        
        $query = 
        "SELECT * FROM ".$table;
        $result = mysqli_query($conn, $query);


        return $result;
    };

    // function readTableWilayah($table){
    //     global $conn;
    //     $query = "SELECT * FROM ".$table;
    //     $result = mysqli_query($conn, $query);


    //     return $result;
    // };
    

function addWater($data, $file, $listUpaya){

    global $conn;
    $foto = $file['image']['name'];
    $tempNamaFoto = $file['image']['tmp_name'];
    $direktori = 'images/foto_sumber_air/' . $foto;
    $isMoved = move_uploaded_file($tempNamaFoto, $direktori);

    if(!$isMoved) $foto = 'default.png';

       
    $namaSumberAir = $data['nama_sumber_air'];
    // $provinsi = $_POST['provinsi'];
    $kabupaten = $_POST['kabupaten'];
    // $wilayah = $data['wilayah'];
    $jenis = $data['jenis_sumber_air'];
    $kondisi = $data['kondisi'];
    $suhu = $data['suhu'] / 10.0;
    $pH = $data['pH'] / 10.0;
    $warna = $data['warna'];
    $kelayakan = $data['layak_minum'];

    // $query_str = "SELECT name FROM provinces WHERE id='$provinsi'";
    // $data = $mysqli->query($query_str);
    // $provinsi_str = $data->fetch_array();
    
    // $query_str = "SELECT name FROM regencies WHERE id='$kabupaten'";
    // $data = $mysqli->query($query_str);
    // $kabupaten_str = $data->fetch_array();

    // $wilayah = $kabupaten_str[0] . ', ' . $provinsi_str[0];


    $query = "INSERT INTO sumber_air VALUES(
        '',
        '$namaSumberAir',
        '$kondisi',
        '$suhu',
        '$warna',
        '$pH',
        '$kelayakan',
        '$jenis',
        '$kabupaten',
        '$foto'
    )";

    $result = mysqli_query($conn, $query);

    $isSucceed = mysqli_affected_rows($conn);
    if($isSucceed > 0) {
        $query = "SELECT id_sumber_air FROM sumber_air WHERE nama_sumber_air LIKE '$namaSumberAir'";
        $result = mysqli_query($conn, $query);
        while($data = mysqli_fetch_assoc($result)) {
            $id = $data['id_sumber_air'];
        }
        foreach ($listUpaya as $upaya) {
            $query = "INSERT INTO sumber_air_upaya_peningkatan VALUES(
                '',
                '$id',
                '$upaya'
            )";
            $result = mysqli_query($conn, $query);
        }
    }
    
    //mengembalikan nilai sukses
    return $isSucceed;
}

function updateWater($data, $file, $listUpaya)
{

    global $conn;
    $id = $data['id_sumber_air'];   
    $namaSumberAir = $data['nama_sumber_air'];
    // $provinsi = $_POST['provinsi'];
    $kabupaten = $_POST['kabupaten'];
    // $wilayah = $data['wilayah'];
    $jenis = $data['jenis_sumber_air'];
    $kondisi = $data['kondisi'];
    $suhu = $data['suhu'] / 10.0;
    $pH = $data['pH'] / 10.0;
    $warna = $data['warna'];
    $kelayakan = $data['layak_minum'];
    $foto = $file['image']['name'];

    $sumberUpaya = readUpayaSumberAir($id);

    // $query_str = "SELECT name FROM provinces WHERE id='$provinsi'";
    // $data = mysqli_query($mysqli, $query_str);
    // $provinsi_str = mysqli_fetch_array($data);

    // $query_str = "SELECT name FROM regencies WHERE id='$kabupaten'";
    // $data = mysqli_query($mysqli, $query_str);
    // $kabupaten_str = mysqli_fetch_array($data);

    // $wilayah = $kabupaten_str[0] . ', ' . $provinsi_str[0];



    if ($foto != "") {

        $tempNamaFoto = $file['image']['tmp_name'];
        $direktori = 'images/foto_sumber_air/' . $foto;
        move_uploaded_file($tempNamaFoto, $direktori);
        $query = "UPDATE sumber_air 
        SET 
        nama_sumber_air = '$namaSumberAir', 
        foto_sumber_air = '$foto', 
        id_kabupaten = '$kabupaten', 
        id_jenis_sumber_air = '$jenis',
        kondisi_sumber_air = '$kondisi', 
        suhu = '$suhu',
        pH = '$pH',
        warna = '$warna',
        layak_minum = '$kelayakan'
        WHERE id_sumber_air = $id";
        //return $query;
        $result = mysqli_query($conn, $query);
    } else {
        $query = "UPDATE sumber_air SET 
        nama_sumber_air = '$namaSumberAir', 
        id_kabupaten = '$kabupaten', 
        id_jenis_sumber_air = '$jenis',
        kondisi_sumber_air = '$kondisi',  
        suhu = '$suhu',
        pH = '$pH',
        warna = '$warna',
        layak_minum = '$kelayakan'
        WHERE id_sumber_air = $id";
        //return $query;
        $result = mysqli_query($conn, $query);
    }

    
    foreach ($sumberUpaya as $upaya) {
        $query = "DELETE FROM sumber_air_upaya_peningkatan WHERE id_sumber_air_upaya_peningkatan = " . $upaya['id_sumber_air_upaya_peningkatan'];
        $result = mysqli_query($conn, $query);
    }
    foreach ($listUpaya as $upaya) {
        $query = "INSERT INTO sumber_air_upaya_peningkatan VALUES('','$id', '$upaya')";
        $result = mysqli_query($conn, $query);
    }
    
    $isSucceed = mysqli_affected_rows($conn);
    
    //mengembalikan nilai sukses
    return $isSucceed;
}

function deleteWater($id){
    global $conn;

    $sumberUpaya = readUpayaSumberAir($id);
    while ($listUpaya = mysqli_fetch_assoc($sumberUpaya)) {
        $query = "DELETE FROM sumber_air_upaya_peningkatan WHERE id_sumber_air_upaya_peningkatan = ".$listUpaya['id_sumber_air_upaya_peningkatan'];
        $result = mysqli_query($conn, $query);
    }
    $query = "DELETE FROM sumber_air WHERE id_sumber_air = $id";
    $result = mysqli_query($conn, $query);


    $isSucceed = mysqli_affected_rows($conn);


    // mengembalikan nilai sukses
    return $isSucceed;
}

function register($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));

    $password = mysqli_real_escape_string($conn, $data["password"]);
    $confirm = mysqli_real_escape_string($conn, $data["confirm"]);

    $result = mysqli_query($conn, "SELECT username FROM admins WHERE username = '$username'");

    if(mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('Username is taken!');
            </script>";
        return false;
    }

    if($password !== $confirm) {
        echo     "<script>
                    alert('Password and Confirmation does not match');
                </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_ARGON2I);

    // var_dump($password); die; 
    $query = "INSERT INTO admins VALUES('', '$username', '$password')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
 
function readSumberAirKondisi(){
    global $conn;

    $query = "SELECT * FROM sumber_air
    -- JOIN wilayah ON sumber_air.id_wilayah = wilayah.id_wilayah
    JOIN jenis_sumber_air ON sumber_air.id_jenis_sumber_air = jenis_sumber_air.id_jenis_sumber_air
    WHERE kondisi_sumber_air = 'Baik'
    ORDER BY 'nama_sumber_air' ASC";

    $eksekusi = mysqli_query($conn, $query);

    return $eksekusi;
}

function readSumberAirSuhu(){
    global $conn;

    $query = "SELECT * FROM sumber_air
    -- JOIN wilayah ON sumber_air.id_wilayah = wilayah.id_wilayah
    JOIN jenis_sumber_air ON sumber_air.id_jenis_sumber_air = jenis_sumber_air.id_jenis_sumber_air
    WHERE suhu >= 10 && suhu <= 25
    ORDER BY 'nama_sumber_air' ASC";

    $eksekusi = mysqli_query($conn, $query);

    return $eksekusi;
}

function readSumberAirWarna(){
    global $conn;

    $query = "SELECT * FROM sumber_air
    -- JOIN wilayah ON sumber_air.id_wilayah = wilayah.id_wilayah
    JOIN jenis_sumber_air ON sumber_air.id_jenis_sumber_air = jenis_sumber_air.id_jenis_sumber_air
    WHERE warna = 'Bening'
    ORDER BY 'nama_sumber_air' ASC";

    $eksekusi = mysqli_query($conn, $query);

    return $eksekusi;
}

function readSumberAirpH(){
    global $conn;

    $query = "SELECT * FROM sumber_air
    -- JOIN wilayah ON sumber_air.id_wilayah = wilayah.id_wilayah
    JOIN jenis_sumber_air ON sumber_air.id_jenis_sumber_air = jenis_sumber_air.id_jenis_sumber_air
    WHERE pH >= 7 && ph <= 8
    ORDER BY 'nama_sumber_air' ASC";

    $eksekusi = mysqli_query($conn, $query);

    return $eksekusi;
}

function readSumberAirLayakMinum(){
    global $conn;

    $query = "SELECT * FROM sumber_air
    -- JOIN wilayah ON sumber_air.id_wilayah = wilayah.id_wilayah
    JOIN jenis_sumber_air ON sumber_air.id_jenis_sumber_air = jenis_sumber_air.id_jenis_sumber_air
    WHERE layak_minum = 'Layak'
    ORDER BY 'nama_sumber_air' ASC";

    $eksekusi = mysqli_query($conn, $query);

    return $eksekusi;
}

function readUpaya(){
    global $conn;

    $query = "SELECT * FROM upaya_peningkatan_ketersediaan_air";


    $eksekusi = mysqli_query($conn, $query);

    return $eksekusi;
}

function readSumberAirUpaya(){
    global $conn;

    $query = "SELECT * FROM sumber_air_upaya_peningkatan
    JOIN sumber_air ON sumber_air.id_sumber_air = sumber_air_upaya_peningkatan.id_sumber_air";


    $eksekusi = mysqli_query($conn, $query);

    return $eksekusi;
}

function addUpaya($data, $file){

    global $conn;
    $namaUpaya = $data['nama_upaya'];

    $query = "INSERT INTO upaya_peningkatan_ketersediaan_air VALUES('', '$namaUpaya' )";

    $result = mysqli_query($conn, $query);

    $isSucceed = mysqli_affected_rows($conn);
    if($isSucceed > 0) {
        $query = "SELECT id_upaya_ketersediaan_air FROM upaya_peningkatan_ketersediaan_air WHERE nama_upaya LIKE '$namaUpaya'";
        $result = mysqli_query($conn, $query);
        while($data = mysqli_fetch_assoc($result)) {
            $id = $data['id_upaya_ketersediaan_air'];
        }
    }
    
    //mengembalikan nilai sukses
    return $isSucceed;
}


function readQuery($table, $id, $find){
    global $conn;
    $query = "SELECT * FROM ".$table." WHERE ".$id."=".$find;
    $result = mysqli_query($conn, $query);

    return $result;
}

function updateUpaya($data, $file){
       
    global $conn;
    $id = $data['id'];
    $namaUpaya = $data['nama_upaya'];

   
    $query = "UPDATE upaya_peningkatan_ketersediaan_air SET nama_upaya = '$namaUpaya' WHERE id_upaya_ketersediaan_air = $id";
    $result = mysqli_query($conn, $query);


    $isSucceed = mysqli_affected_rows($conn);
    
    // mengembalikan nilai sukses
    return $isSucceed;
}

function readListSumberAirUpaya($id){
    global $conn;

    $query = "SELECT * FROM sumber_air_upaya_peningkatan
    JOIN sumber_air ON sumber_air.id_sumber_air = sumber_air_upaya_peningkatan.id_sumber_air
    JOIN upaya_peningkatan_ketersediaan_air ON sumber_air_upaya_peningkatan.id_upaya_peningkatan_ketersediaan_air =  upaya_peningkatan_ketersediaan_air.id_upaya_ketersediaan_air
    WHERE id_upaya_peningkatan_ketersediaan_air = $id";


    $eksekusi = mysqli_query($conn, $query);

    return $eksekusi;
}

function deleteUpaya($id){
    global $conn;

    $sumberUpaya = readListSumberAirUpaya($id);
    while ($listUpaya = mysqli_fetch_assoc($sumberUpaya)) {
        $query = "DELETE FROM sumber_air_upaya_peningkatan WHERE id_sumber_air_upaya_peningkatan = ".$listUpaya['id_sumber_air_upaya_peningkatan'];
        $result = mysqli_query($conn, $query);
    }
    $query = "DELETE FROM upaya_peningkatan_ketersediaan_air WHERE id_upaya_ketersediaan_air = $id";
    $result = mysqli_query($conn, $query);


    $isSucceed = mysqli_affected_rows($conn);


    // mengembalikan nilai sukses
    return $isSucceed;
}

?>
