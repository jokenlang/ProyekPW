<?php
require_once('connection.php');
if (isset($_POST['kategori'])) {
    $kategori = $_POST["kategori"];

    $sql = "select * from jenis where kode_kategori=$kategori";
    $hasil = mysqli_query($conn, $sql);
    while ($data = mysqli_fetch_array($hasil)) {
?>
        <option value="<?php echo  $data['kode_jenis']; ?>"><?php echo $data['nama_jenis']; ?></option>
<?php
    }
}
?>