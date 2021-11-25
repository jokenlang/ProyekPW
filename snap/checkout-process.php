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
$total = $_SESSION['total'];
echo $total;
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
$enable_payments = array('bca_va', 'cimb_clicks', 'mandiri_clickpay', 'echannel');

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
var_dump($item_details);
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

echo "snapToken = " . $snap_token;

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

<body>
    <h1>Do you really want to checkout?</h1>
    <button id="pay-button">Pay Now</button>
    <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre>

    <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey; ?>"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('<?php echo $snap_token ?>', {
                // Optional
                onSuccess: function(result) {
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 1);

                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
    </script>
</body>

</html>