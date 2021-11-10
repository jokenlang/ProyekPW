<?php
require_once('connection.php');
$idxUser = $_SESSION['idxUser'];
$listProduk = $conn->query("SELECT * From produk")->fetch_all(MYSQLI_ASSOC);
$stmt = $conn->query("SELECT * FROM user WHERE kode_user='$idxUser'");
$user = $stmt->fetch_assoc();

if (isset($_POST['searchName'])) {
    $keyword = $_POST['keyword'];
    $query = "SELECT * From produk where nama_produk like'%$keyword%'";
    $hasil = mysqli_query($conn, $query);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <script src="jquery-3.4.1.min.js"></script>
    <style>
        table tr td {
            border: 1px solid black;
        }

        table tr td img {
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body>
    <h1>Welcome, <?= $user['nama_user'] ?></h1>
    <br>

    <!-- <form action="" method="post">
        Search by name : <input type="text" name="keyword" id="keyword" onkeyup="searching();">
        <button value="search" name="searchName">Search by Name</button>
    </form> -->

    <div class="form-group">
        <input type="text" name="search_box" id="search_box" class="form-control" placeholder="Search by Name" />
        <br>
        <input type="text" name="search_min" id="search_min" class="form-control" placeholder="Min" />
        <input type="text" name="search_max" id="search_max" class="form-control" placeholder="Max" />
    </div>

    <!-- <h1>Search by harga</h1>
    <form action="" method="post">
        Min : <input type="text" name="min" id="min">
        Max : <input type="text" name="max" id="max">
        <button value="search" name="searchHarga">Search by Harga</button>
    </form> -->

    <h1>List Product</h1>
    <br>
    <!-- 
    <table>
        <tr>
            <td>Nama</td>
            <td>Jenis</td>
            <td>Stok</td>
            <td>Desc</td>
            <td>Harga</td>
            <td>Gambar</td>
        </tr>
        <?php foreach ($listProduk as $key => $val) { ?>
            <tr>
                <td><?= strtoupper($val['nama_produk']) ?></td>
                <td>
                    <?php
                    $kode_jenis = $val['kode_jenis'];
                    $stmt = $conn->query("SELECT * FROM jenis WHERE kode_jenis='$kode_jenis'");
                    $jenis = $stmt->fetch_assoc();
                    ?>
                    <?= $jenis['nama_jenis'] ?>
                </td>
                <td><?= $val['stok_produk'] ?></td>
                <td><?= $val['desc_produk'] ?></td>
                <td>Rp. <?= number_format($val['harga_produk'], 00, ',', '.') ?></td>
                <td><img src="<?= $val['url_gambar'] ?>" alt=""></td>
            </tr>
        <?php } ?>
    </table> -->

    <div class="table-responsive" id="dynamic_content">

    </div>
    <script>
        $(document).ready(function() {

            load_data(1);

            function load_data(page, query = '', min = '', max = '') {
                $.ajax({
                    url: "fetch.php",
                    method: "POST",
                    data: {
                        page: page,
                        query: query,
                        min: min,
                        max: max
                    },
                    success: function(data) {
                        $('#dynamic_content').html(data);
                    }
                });
            }

            $(document).on('click', '.page-link', function() {
                var page = $(this).data('page_number');
                var query = $('#search_box').val();
                var min = $('#search_min').val();
                var max = $('#search_max').val();
                load_data(page, query, min, max);
            });

            $('#search_box').keyup(function() {
                var query = $('#search_box').val();
                var min = $('#search_min').val();
                var max = $('#search_max').val();
                load_data(1, query, min, max);;
            });


            $('#search_min').keyup(function() {
                var query = $('#search_box').val();
                var min = $('#search_min').val();
                var max = $('#search_max').val();
                load_data(1, query, min, max);
            });

            $('#search_max').keyup(function() {
                var query = $('#search_box').val();
                var min = $('#search_min').val();
                var max = $('#search_max').val();
                load_data(1, query, min, max);;
            });

        });
    </script>

</body>

</html>