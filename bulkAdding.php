<?php
require_once('connection.php');

$row = 1;
if (($handle = fopen($_FILES['bulkFile']['tmp_name'], "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $num = count($data);
    echo "<p> $num fields in line $row: <br /></p>\n";
    $row++;
    // echo $data[0] . "<br />\n";
    $stmt = $conn->prepare("INSERT INTO `produk` (`nama_produk`, `desc_produk`, `harga_produk`, `stok_produk`, `kode_jenis`,`url_gambar`) VALUES (?,?,?,?,?,?)");
    $stmt->bind_param("ssiiis", $data[0], $data[1], $data[2], $data[3], $data[4], $data[5]);
    $result = $stmt->execute();
    // if ($result) {
    //   // alert('Product added');
    // } else {
    //   alert('Product failed');
    // }
  }
  fclose($handle);
}
?>