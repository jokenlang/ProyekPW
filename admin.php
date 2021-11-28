<?php
require_once('ahihi.php');
require_once('connection.php');
$kategori = $conn->query("SELECT * From kategori")->fetch_all(MYSQLI_ASSOC);

//pagination
$jumlahDataperHal = 12;
$res = mysqli_query($conn, "select * from produk");
$jumlahData = mysqli_num_rows($res);
$jumlahHal = ceil($jumlahData / $jumlahDataperHal);
if (isset($_GET['hal'])) {
    $halAktif = $_GET['hal'];
} else {
    $halAktif = 1;
}
$awalData = ($jumlahDataperHal * $halAktif) - $jumlahDataperHal;
$produk = $conn->query("SELECT * From produk LIMIT $awalData,$jumlahDataperHal")->fetch_all(MYSQLI_ASSOC);

if (isset($_POST['addProduct'])) {
    $nama = $_POST['nama'];
    $kode_jenis = $_POST['jenis'];
    $strHarga = $_POST['harga'];
    $desc = $_POST['desc'];
    $strStok = $_POST['stok'];
    $url = $_POST['url'];
    if ($nama == "" || $kode_jenis == "" || $strHarga == "" || $strStok == "" || $url == "") {
        alert('Semua field harus diisi');
    } else {
        $harga = (int) $strHarga;
        $stok = (int) $strStok;

        if ($harga < 1000) {
            alert('Harga min 1000');
        } else if ($stok < 0) {
            alert('Stoknya harus ada');
        } else {
            $stmt = $conn->prepare("INSERT INTO `produk` (`nama_produk`, `desc_produk`, `harga_produk`, `stok_produk`, `kode_jenis`,`url_gambar`) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param("ssiiis", $nama, $desc, $harga, $stok, $kode_jenis, $url);
            $result = $stmt->execute();
            if ($result) {
                alert('Product added');
            } else {
                alert('Product failed');
            }
        }
    }
}

if (isset($_POST['logout'])) {
    header('Location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>Admin</title>
    <script src="jquery-3.4.1.min.js"></script>
    <style>
        /* table tr td {
            border: 1px solid black;
        } */

        table tr td img {
            width: 100px;
            height: 100px;
        }

        span {
            margin: 20px;
        }
    </style>
</head>

<body>
    <?php include('headerAdmin.php') ?>
    <div class="container">
        <h1 class="my-4">Welcome, Admin</h1>
        <hr>
        <h2 class="my-4">Add Product</h2>
        <form action="" method="POST" class="my-4">
            Name : <input type="text" name="nama" id="nama" class="form-control">
            <br>
            Kategori :
            <select name="kategori" id="kategori" class="form-control">
                <option value="">Select Kategori</option>
                <?php
                $sql = "select * from kategori";
                $hasil = mysqli_query($conn, $sql);
                while ($data = mysqli_fetch_array($hasil)) {
                ?>
                    <option value="<?php echo $data['kode_kategori']; ?>"><?php echo $data['nama_kategori']; ?></option>
                <?php } ?>
            </select>
            <br>
            Jenis :
            <select name="jenis" id="jenis" class="form-control"></select>
            <br>
            Harga :
            <input type="text" name="harga" id="" class="form-control">
            <br>
            Desc:
            <textarea name="desc" id="" cols="30" rows="10" class="form-control"></textarea>
            <br>
            Stok :
            <input type="text" name="stok" id="" class="form-control">
            <br>
            Url Gambar :
            <input type="text" name="url" id="" class="form-control">
            <br>
            <button name="addProduct" value="tambah" class="btn btn-info">Add Product</button>
        </form>

        <hr>
        <form action="bulkAdding.php" method="post" enctype="multipart/form-data" class="my-4">
            <h2>Add by Bulk</h2>
            <input type="file" name="bulkFile" id="" class="form-control my-4">
            <button name="bulkAdd" class="btn btn-info my-4">Bulk Add</button>
        </form>
        <hr>
        <h1>List Product</h1>

        <br>
        <table class="table">
            <tr>
                <td>Nama</td>
                <td>Jenis</td>
                <td>Stok</td>
                <td>Desc</td>
                <td>Harga</td>
                <td>Gambar</td>
            </tr>
            <?php foreach ($produk as $key => $val) { ?>
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
        </table>

        <!-- Navigasi -->
        <?php for ($i = 1; $i <= $jumlahHal; $i++) { ?>
            <span>
                <?php if ($i == $halAktif) { ?>
                    <a href="?hal=<?= $i ?>" class="text-danger"><u><?= $i ?></u></a>
                <?php } else { ?>
                    <a href="?hal=<?= $i ?>"><?= $i ?></a>
                <?php } ?>
            </span>
        <?php } ?>
    </div>


    <script>
        $("#kategori").change(function() {
            var kode_kategori = $("#kategori").val();

            $.ajax({
                type: "POST",
                dataType: "html",
                url: "ambil-data.php",
                data: "kategori=" + kode_kategori,
                success: function(data) {
                    $("#jenis").html(data);
                }
            });
        });
    </script>
    <br>
    <form action="" method="post">
        <!-- <button name="logout">logout</button> -->
    </form>
    <br><br>
    <?php include('footer.php'); ?>
</body>

</html>