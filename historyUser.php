<?php
require_once('connection.php');
$idxUser = $_SESSION['idxUser'];
$htrans = $conn->query("SELECT * From htrans where kode_user = '$idxUser'")->fetch_all(MYSQLI_ASSOC);

if (isset($_POST['detailOrder'])) {
    $_SESSION['order_id'] = $_POST['detailOrder'];
    header('Location:detailHistoryUser.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>

<body>
    <?php include('header.php'); ?>
    <div class="container">
        <div class="text-dark my-3 font-weight-bold" style="font-size: 2em;">History Transaction</div>
    </div>
    <form action="" method="post">
        <div class="container">
            <?php foreach ($htrans as $key => $value) { ?>
                <div class="card my-2" style="border-radius: 20px;">
                    <?php if (strtoUpper($value['transaction_status']) == "PENDING") { ?>
                        <div class="card-header bg-danger text-light">
                        <?php } else { ?>
                            <div class="card-header bg-success text-light">
                            <?php } ?>
                            Order ID : <?= $value['order_id'] ?>
                            </div>
                            <div class="card-body">
                                <?php
                                $order_id = $value['order_id'];
                                $dtrans = $conn->query("SELECT * From dtrans where order_id = '$order_id'")->fetch_all(MYSQLI_ASSOC);
                                $total = count($dtrans);
                                ?>
                                <h5 class="card-title">Total Items : <?= $total ?></h5>
                                <p class="card-text">Time : <?= $value['transaction_time'] ?></p>
                                <p class="card-text">Status : <?= strtoUpper($value['transaction_status']) ?></p>
                                <p class="card-text">Subtotal : <b> Rp. <?= $value['gross_amount'] ?></b></p>
                                <button name="detailOrder" value="<?= $value['order_id'] ?>" class="btn float-right text-dark" style="color: white;">Detail >> </button>
                            </div>
                        </div>
                    <?php } ?>
                </div>
        </div>
    </form>

    <?php include('footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>

</html>