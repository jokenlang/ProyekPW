<?php

$connect = new PDO("mysql:host=localhost; dbname=furniture_website", "root", "");

/*function get_total_row($connect)
{
  $query = "
  SELECT * FROM tbl_webslesson_post
  ";
  $statement = $connect->prepare($query);
  $statement->execute();
  return $statement->rowCount();
}

$total_record = get_total_row($connect);*/

$limit = '6';
$page = 1;
if ($_POST['page'] > 1) {
  $start = (($_POST['page'] - 1) * $limit);
  $page = $_POST['page'];
} else {
  $start = 0;
}

$query = "
SELECT * FROM produk 
";
$search = false;
if ($_POST['query'] != '') {
  $query .= '
  WHERE desc_produk LIKE "%' . str_replace(' ', '%', $_POST['query']) . '%"  
  OR nama_produk LIKE "%' . str_replace(' ', '%', $_POST['query']) . '%"  
  ';
  $search = true;
}
/*
if ($_POST['min'] != '') {
  $min = (int) $_POST['min'];
  if ($search) {
    $query .= "
    OR harga_produk >= $min";
  } else {
    $query .= "
    WHERE harga_produk >= $min ";
  }
  $search = true;
}

if ($_POST['max'] != '') {
  $max = (int) $_POST['max'];
  if ($search) {
    $query .= "
    AND harga_produk <= $max";
  } else {
    $query .= "
    WHERE harga_produk <= $max ";
  }
}
*/
// echo $query;

//$query .= 'ORDER BY webslesson_post_id ASC ';

$filter_query = $query . 'LIMIT ' . $start . ', ' . $limit . '';

$statement = $connect->prepare($query);
$result = $statement->execute();

$total_data = $statement->rowCount();

$statement = $connect->prepare($filter_query);
$statement->execute();
$result = $statement->fetchAll();
$total_filter_data = $statement->rowCount();

/*$output = '
<label>Total Records - ' . $total_data . '</label>
<table class="table table-striped table-bordered">
  <tr>
    <th>Merk Produk</th>
    <th>Desc Produk</th>
    <th>Harga Produk</th>
    <th> Gambar Produk </th>
  </tr>
';*/

$output = "<div class='container'><label>Total Records - $total_data</label>
";
$output .= "<div class='row'>";

if ($total_data > 0) {
  foreach ($result as $value) {
    /*$output .= '
    <tr>
      <td>' . $row["nama_produk"] . '</td>
      <td>' . $row["desc_produk"] . '</td>
      <td> Rp.' . number_format($row["harga_produk"], 0, ',', '.') . '</td>
      <td><img src="' . $row["url_gambar"] . '" style="height=100px;width=100px;margin-left=20px"></td>
    </tr>
    ';*/
    $url = $value['url_gambar'];
    $nama = strtoUpper($value['nama_produk']);
    $desc = $value['desc_produk'];
    $harga = 'Rp.' . number_format($value["harga_produk"], 0, ',', '.');
    $kode = $value['kode_produk'];
    $output .= "
    <div class='card col-md-3 m-2'>
                    <img class='card-img-top' src='$url' alt='Card image cap'>
                    <div class='card-body'>
                        <h5 class='card-title'>$nama</h5>
                        <p class='card-text'>$desc</p>
                        <p class='card-text font-weight-bold'>$harga</p>
                        <a href='#' class='btn btn-dark' value='$kode'>Add to Cart</a>
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
<br />
<div align='right'>
  <div class='container'>
  <ul class='pagination' style='float:right'>
";

$total_links = ceil($total_data / $limit);
$previous_link = '';
$next_link = '';
$page_link = '';

//echo $total_links;

if ($total_links > 4) {
  if ($page < 5) {
    for ($count = 1; $count <= 5; $count++) {
      $page_array[] = $count;
    }
    $page_array[] = '...';
    $page_array[] = $total_links;
  } else {
    $end_limit = $total_links - 5;
    if ($page > $end_limit) {
      $page_array[] = 1;
      $page_array[] = '...';
      for ($count = $end_limit; $count <= $total_links; $count++) {
        $page_array[] = $count;
      }
    } else {
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

for ($count = 0; $count < count($page_array); $count++) {
  if ($page == $page_array[$count]) {
    $page_link .= '
    <li class="page-item active">
      <a class="page-link" href="#">' . $page_array[$count] . ' <span class="sr-only">(current)</span></a>
    </li>
    ';

    $previous_id = $page_array[$count] - 1;
    if ($previous_id > 0) {
      $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $previous_id . '">Previous</a></li>';
    } else {
      $previous_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Previous</a>
      </li>
      ';
    }
    $next_id = $page_array[$count] + 1;
    if ($next_id > $total_links) {
      $next_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Next</a>
      </li>
        ';
    } else {
      $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $next_id . '">Next</a></li>';
    }
  } else {
    if ($page_array[$count] == '...') {
      $page_link .= '
      <li class="page-item disabled">
          <a class="page-link" href="#">...</a>
      </li>
      ';
    } else {
      $page_link .= '
      <li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $page_array[$count] . '">' . $page_array[$count] . '</a></li>
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

echo $output;
