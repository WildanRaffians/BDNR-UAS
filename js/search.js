// cara ajax polos

// var keyword = document.getElementById('keyword');
// var searchButton = document.getElementById('button-cari');
// var containerSearch = document.getElementById('active-search');

// keyword.addEventListener('keyup', function() {
//     var xhr = new XMLHttpRequest();
//     xhr.onreadystatechange = function () {
//         if(xhr.readyState == 4 && xhr.status == 200) {
//             containerSearch.innerHTML = xhr.responseText;
//         }
//     }

//     xhr.open('GET', 'ajax/search.php?keyword=' + keyword.value, true);
//     xhr.send();
// });


// jquery

$(document).ready(function(){
    let slideCount = $('#slideCount').val();
    let slideIndex = 0;
    $('div[data-index="0"]').addClass('show');

    $('#prev-button').on('click', function() {
        console.log(slideIndex);
        if(slideIndex > 0) {
            $('div[data-index]').removeClass('show');
            slideIndex--;
            setTimeout(function () {
                //your code to be executed after 1 second
                $('div[data-index=\"' + slideIndex + '\"]').addClass('show');
            }, 250);
        }
        console.log(slideIndex);

        // alert('clicked');
    })

    $('#next-button').on('click', function () {
        console.log(slideIndex);
        if (slideIndex < slideCount - 1) {
            $('div[data-index]').removeClass('show');
            slideIndex++;
            setTimeout(function () {
                //your code to be executed after 1 second
                $('div[data-index=\"' + slideIndex + '\"]').addClass('show');
            }, 250);
        }
        console.log(slideIndex);
        // alert('next');
    })

    // default values
    let jenis = '';
    let kondisi = '';
    var provinsi = '';
    var regency = '';
    let sort = 'id_sumber_air';
    let order = 'ASC';
    let keyword = '';
    // pengambilan value dari input
    $('#filter-sort').on('change reset', function () { sort = this.value;});
    $('#filter-order').on('change reset', function () { order = this.value; });
    // pengambilan value id provinsi
    $('#filter-provinsi').on('change reset', function () {
        provinsi = this.value;
        // pembuatan filter regency sesuai dengan provinsi nya
        var url = 'get_kabupaten.php?id_prov=' + provinsi;  
        $("#kabupaten").html('');
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function (result) {
                $("#regency-title").remove();
                $("#filter-regency").append('<option value="" selected disabled>Pilih</option>');
                $("#filter-regency").append('<option value="" >All</option>');
                for (var i = 0; i < result.length; i++) {
                    // apa yang akan dilakukan pada data json yang sudah digenerate
                    $("#filter-regency").append('<option value="' + result[i].id_kab + '">' + result[i].nama + '</option>');
                }
            }
        });

    });
    // pengambilan value filter
    $('#filter-regency').on('change reset', function () { regency = this.value; });
    $('#filter-jenis').on('change reset', function () { jenis = this.value; });
    $('#filter-kondisi').on('change reset', function () { kondisi = this.value; });

    
    
    $('#keyword').on('keyup', function() {
        keyword = this.value;   // pengambilan value keyword
        // live load result
        $.get('ajax/search.php?keyword=' + keyword + '&sort=' + sort + '&order=' + order + '&provinsi=' + provinsi + '&regency=' + regency + '&jenis=' + jenis + '&kondisi=' + kondisi, function (data) {
            $('#active-search').html(data);
        });
        $('div[data-index="0"]').addClass('show');
        slideIndex = 0;
    });

    $('#filter-reset').on('click', function () {
        jenis = '';
        kondisi = '';
        provinsi = '';
        regency = '';
        sort = 'id_sumber_air';
        order = 'ASC';
        // $.get('ajax/regency.php?&provinsi=' + provinsi, function (data) {
        //     $('#regency').html(data);
        // });
        

    });

    $('#filter-apply').on('click', function () {
        // $('div[data-index=]').removeClass('show');
        
        
        $.get('ajax/search.php?keyword=' + keyword + '&sort=' + sort + '&order=' + order + '&provinsi=' + provinsi + '&regency=' + regency + '&jenis=' + jenis + '&kondisi=' + kondisi, function (data) {
            $('#active-search').html(data);
        });
        $('div[data-index="0"]').addClass('show');
        slideIndex = 0;

    });

    // $('div[data-index="0"]').addClass('show');
});





