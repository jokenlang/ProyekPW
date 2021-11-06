<?php
require_once('connection.php');
$kategori = $conn->query("SELECT * From kategori")->fetch_all(MYSQLI_ASSOC);


if (isset($_POST['tambahKategori'])) {
    $nama = $_POST['namaKategori'];
    $stmt = $conn->prepare("INSERT INTO `kategori` (`kode_kategori`, `nama_kategori`) VALUES ('', ?)");
    $stmt->bind_param("s", $nama);
    $result = $stmt->execute();
    if ($result) {
        alert('Berhasil Tambah Kategori');
    } else {
        alert('Gagal Tambah Kategori');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Welcome, Admin</h1>

    <h2>Tambah Kategori Produk</h2>

    <form action="" method="post">
        Nama : <input type="text" name="namaKategori" id="">
        <input type="submit" value="tambah" name="tambahKategori">
    </form>

    <br>
    <Select name="kategori">
        <?php if ($kategori != null) { ?>
            <?php foreach ($kategori as $key => $val) { ?>
                <option value="<?= $val['kode_kategori'] ?>"><?= $val['nama_kategori'] ?></option>
            <?php } ?>
        <?php } ?>
    </Select>

</body>

</html>