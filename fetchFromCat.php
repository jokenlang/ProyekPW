<?php

$connect = new PDO("mysql:host=localhost; dbname=furniture_website", "root", "");
// $connect = new PDO("mysql:host=localhost; dbname=tstingp_furniture_website", "tstingp_zie", "2207kenzie");
session_start();

$limit = '6';
$page = 1;
if ($_POST['page'] > 1) {
  $start = (($_POST['page'] - 1) * $limit);
  $page = $_POST['page'];
} else {
  $start = 0;
}

$idxKategori = $_SESSION['idxKategori'];
$query = "
SELECT * FROM produk p,jenis j,kategori k WHERE j.kode_kategori = k.kode_kategori AND j.kode_jenis = p.kode_jenis AND k.kode_kategori = '$idxKategori'
";

$filter_query = $query . 'LIMIT ' . $start . ', ' . $limit . '';

$statement = $connect->prepare($query);
$result = $statement->execute();

$total_data = $statement->rowCount();

$statement = $connect->prepare($filter_query);
$statement->execute();
$result = $statement->fetchAll();
$total_filter_data = $statement->rowCount();

$output = "<form method='post'><div class='container'><label class='ml-5'>Total Records - $total_data</label>
";
$output .= "<div class='row justify-content-center'>";

if ($total_data > 0) {
  foreach ($result as $value) {
    $url = $value['url_gambar'];
    $nama = strtoUpper($value['nama_produk']);
    $desc = $value['desc_produk'];
    $harga = 'Rp.' . number_format($value["harga_produk"], 0, ',', '.');
    $kode = $value['kode_produk'];
    $output .= "
    <div class='card col-12 col-md-3 m-1 m-md-4'>
                    <img class='card-img-top' src='$url' alt='Card image cap'>
                    <div class='card-body'>
                        <h5 class='card-title'>$nama</h5>
                        <p class='card-text'>$desc</p>
                        <p class='card-text font-weight-bold'>$harga</p>
                        <form method='post' class='row'>
                        <button href='#' class='btn btn-dark col-12 mb-2' value='$kode' name='detail'>Detail</button>
                        <button href='#' class='btn btn-success col-12' value='$kode' name='add'>Add to Cart</button>
                        </form>
                        </div>
    </div>
    ";
  }
} else {
  $output .= '
  <tr>
    <td colspan="2" align="center">No Data Found</td>
  </tr>
  ';
}

$output .= "
</div>
</div>
</form>
<br />
<div align='right'>
  <div class='container'>
  <ul class='pagination justify-content-center'>
";

$total_links = ceil($total_data / $limit);
$previous_link = '';
$next_link = '';
$page_link = '';

//echo $total_links;

if ($total_links > 5) {
  if ($page < 5) {
    //untuk page yang jumlahnya 5
    for ($count = 1; $count <= 5; $count++) {
      $page_array[] = $count;
    }
    $page_array[] = '...';
    $page_array[] = $total_links;
  } else {
    $end_limit = $total_links - 5;
    if ($page > $end_limit) {
      //page 5 terakhir
      $page_array[] = 1;
      $page_array[] = '...';
      for ($count = $end_limit; $count <= $total_links; $count++) {
        $page_array[] = $count;
      }
    } else {
      //page tengah"
      $page_array[] = 1;
      $page_array[] = '...';
      for ($count = $page - 1; $count <= $page + 1; $count++) {
        $page_array[] = $count;
      }
      $page_array[] = '...';
      $page_array[] = $total_links;
    }
  }
} else {
  for ($count = 1; $count <= $total_links; $count++) {
    $page_array[] = $count;
  }
}

if ($total_data > 0) {
  for ($count = 0; $count < count($page_array); $count++) {
    if ($page == $page_array[$count]) {
      //kalau aktif
      $page_link .= '
      <li class="page-item active">
        <a class="page-link" href="#">' . $page_array[$count] . ' <span class="sr-only">(current)</span></a>
      </li>
      ';

      $previous_id = $page_array[$count] - 1;
      if ($previous_id > 0) {
        //kalau sdh 0 prev mati
        $previous_link = '<li class="page-item"><a class="page-link" href="#" data-page_number="' . $previous_id . '">Previous</a></li>';
      } else {
        $previous_link = '
        <li class="page-item disabled">
          <a class="page-link" href="#">Previous</a>
        </li>
        ';
      }
      $next_id = $page_array[$count] + 1;
      if ($next_id > $total_links) {
        //kalau sdh page terakhir ga bisa next
        $next_link = '
        <li class="page-item disabled">
          <a class="page-link" href="#">Next</a>
        </li>
          ';
      } else {
        $next_link = '<li class="page-item"><a class="page-link" href="#" data-page_number="' . $next_id . '">Next</a></li>';
      }
    } else {
      // tampilkan ...
      if ($page_array[$count] == '...') {
        $page_link .= '
        <li class="page-item disabled">
            <a class="page-link" href="#">...</a>
        </li>
        ';
      } else {
        //tampilkan angka
        $page_link .= '
        <li class="page-item"><a class="page-link" href="#" data-page_number="' . $page_array[$count] . '">' . $page_array[$count] . '</a></li>
        ';
      }
    }
  }

  $output .= $previous_link . $page_link . $next_link;
  $output .= '  
  </ul>
  </div>
  </div>
  ';
}


echo $output;
