<?php
// This is just for very basic implementation reference, in production, you should validate the incoming requests and implement your backend more securely.
// Please refer to this docs for snap popup:
// https://docs.midtrans.com/en/snap/integration-guide?id=integration-steps-overview

namespace Midtrans;

require_once('../connection.php');
require_once dirname(__FILE__) . '/../Midtrans.php';
// Set Your server key
// can find in Merchant Portal -> Settings -> Access keys
Config::$serverKey = 'SB-Mid-server-xC91-kxK1hlB1UzFglD4McG4';
Config::$clientKey = 'SB-Mid-client-UCQsXwfoA3PIjnr3';
// Config::$serverKey = 'SB-Mid-server-gHZXLWEWjUFrJg7UcvqEbqjd';
// Config::$clientKey = 'SB-Mid-client-mbAWbVaBJbhY5Yz1';

// non-relevant function only used for demo/example purpose
printExampleWarningMessage();

// Uncomment for production environment
// Config::$isProduction = true;

// Enable sanitization
Config::$isSanitized = true;

// Enable 3D-Secure
Config::$is3ds = true;

// Uncomment for append and override notification URL
// Config::$appendNotifUrl = "https://example.com";
// Config::$overrideNotifUrl = "https://example.com";

// Required
$total = (int) $_SESSION['total'];
$transaction_details = array(
    'order_id' => rand(),
    'gross_amount' => $total, // no decimal allowed for creditcard
);

// Optional
$item1_details = array(
    'id' => 'a1',
    'price' => 18000,
    'quantity' => 3,
    'name' => "Apple"
);

// Optional
$item2_details = array(
    'id' => 'a2',
    'price' => 20000,
    'quantity' => 2,
    'name' => "Orange"
);

// Optional
//$item_details = array($item1_details, $item2_details);

// Optional
$billing_address = array(
    'first_name'    => "Andri",
    'last_name'     => "Litani",
    'address'       => "Mangga 20",
    'city'          => "Jakarta",
    'postal_code'   => "16602",
    'phone'         => "081122334455",
    'country_code'  => 'IDN'
);

// Optional
$shipping_address = array(
    'first_name'    => "Obet",
    'last_name'     => "Supriadi",
    'address'       => "Manggis 90",
    'city'          => "Jakarta",
    'postal_code'   => "16601",
    'phone'         => "08113366345",
    'country_code'  => 'IDN'
);

// Optional
$customer_details = array(
    'first_name'    => "Andri",
    'last_name'     => "Litani",
    'email'         => "andri@litani.com",
    'phone'         => "081122334455",
    'billing_address'  => $billing_address,
    'shipping_address' => $shipping_address
);

// Optional, remove this to display all available payment methods
$enable_payments = array('bca_va', 'mandiri_clickpay', 'echannel');

// Fill transaction details
$cart = $_SESSION['cart'];

$idxUser = $_SESSION['idxUser'];
$stmt = $conn->query("SELECT * FROM user WHERE kode_user='$idxUser'");
$user = $stmt->fetch_assoc();

$item_details = [];
$customer_details = array(
    'first_name'    => $user['nama_user'],
    'email'         => $user['email_user']
);

foreach ($cart as $key => $value) {
    $item['item'][] = [
        'id' => $value['kode_produk'],
        'name' => strtoUpper($value['nama_produk']),
        'price' => $value['harga_produk'],
        'quantity' => $value['qty']
    ];
}
$item_details = $item['item'];
// var_dump($item_details);
// print_r($_SESSION['cart']);
$transaction = array(
    'enabled_payments' => $enable_payments,
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,
    'customer_detail' => $user,
    'enable_payment' => $enable_payments
);

$snap_token = '';
try {
    $snap_token = Snap::getSnapToken($transaction);
} catch (\Exception $e) {
    echo $e->getMessage();
}

// echo "snapToken = " . $snap_token;

function printExampleWarningMessage()
{
    if (strpos(Config::$serverKey, 'your ') != false) {
        echo "<code>";
        echo "<h4>Please set your server key from sandbox</h4>";
        echo "In file: " . __FILE__;
        echo "<br>";
        echo "<br>";
        echo htmlspecialchars('Config::$serverKey = \'<your server key>\';');
        die();
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>

<body>
    <?php include('headerSnap.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="text-dark my-3 font-weight-bold" style="font-size: 2em;">Confirmation</div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Merk</th>
                            <th scope="col" class="d-none d-md-block">Desc</th>
                            <th scope="col-5">Qty</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        $total_item = 0;
                        ?>
                        <?php if ($cart != null) { ?>
                            <?php foreach ($cart as $key => $value) { ?>
                                <tr>
                                    <td>
                                        <img src="<?= $value['url_gambar'] ?>" alt="" style="width: 50px;height: 50px;">
                                        <?= strtoUpper($value['nama_produk']) ?>
                                    </td>
                                    <td class="d-none d-md-block"><?= $value['desc_produk'] ?></td>
                                    <td><?= $value['qty'] ?></td>
                                    <td>Rp. <?= number_format($value['subtotal'], 0, '.', '.') ?></td>
                                    <?php $total += $value['subtotal']; ?>
                                    <?php $total_item += $value['qty']; ?>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                        <tr>
                            <td colspan="3" class="font-weight-bold text-danger" style="text-align:right">TOTAL</td>
                            <td class="font-weight-bold h5">Rp. <?= number_format($total, 0, ',', '.') ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card my-4" style="background-color: lightgray;">
                    <div class="card-body">
                        <h2 class="card-title font-weight-bold my-2">Order Summary</h2>
                        <hr>
                        <div class="row my-4">
                            <div class="col-6 card-text text-left">Total Items : </div>
                            <div class="col-6 card-text text-right"><?= $total_item ?> Items</div>
                        </div>
                        <div class="row my-4">
                            <div class="col-6 card-text text-left">Subtotal : </div>
                            <div class="col-6 card-text text-right">Rp. <?= number_format($total, 0, '.', '.') ?></div>
                        </div>
                        <a href="./../cart.php" class="btn btn-danger float-right m-2">Cancel</a>
                        <button class="btn btn-info float-right m-2" id="pay-button">Pay Now</button>
                    </div>
                </div>
            </div>
        </div>
        <form action="../typage.html" id="typage" method="post">

        </form>

    </div>

    <?php include('../footer.php') ?>
    <script src="./../jquery-3.4.1.min.js"></script>
    <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey; ?>"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('<?php echo $snap_token ?>', {
                // Optional
                onSuccess: function(result) {
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    // alert("Berhasil");
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    $.ajax({
                        method: "POST",
                        url: "action.php",
                        data: {
                            order: JSON.stringify(result, null, 2),
                            action: "kirimOrder"
                        },
                        success: function(response) {
                            //$(document.body).html("");
                            // $(document.body).html(response);
                            $("#typage").submit();
                        }
                    });
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
    </script>
    <script src="./../jquery-3.4.1.min.js"></script>
</body>

</html>