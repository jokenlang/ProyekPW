<?php
require_once('../connection.php');
$action = $_POST['action'];
if ($action == "kirimOrder") {
    $order = json_decode($_POST['order'], true);
    echo "<pre>";
    var_dump($order);
    echo "</pre>";
    $kode_user = $_SESSION['idxUser'];
    $va_number = json_encode($order['va_numbers']);
    $transaction_time = $order['transaction_time'];
    $transaction_id = $order['transaction_id'];
    $transaction_status = $order['transaction_status'];
    $status_code = $order['status_code'];
    $order_id = $order['order_id'];
    $gross_amount = $order['gross_amount'];
    $stmt = $conn->prepare("INSERT INTO `htrans` (`va_number`, `transaction_time`, `transaction_status`, `transaction_id`, `status_code`, `order_id`, `gross_amount`, `kode_user`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssii", $va_number, $transaction_time, $transaction_id, $transaction_status, $status_code, $order_id, $gross_amount, $kode_user);
    $result = $stmt->execute();
    $cart = $_SESSION['cart'];
    foreach ($cart as $key => $value) {
        $kode_produk = $value['kode_produk'];
        $qty = $value['qty'];
        $stmt = $conn->prepare("INSERT INTO `dtrans` (`order_id`, `kode_produk`,`qty`) VALUES (?, ?,?)");
        $stmt->bind_param("ssi", $order_id, $kode_produk, $qty);
        $result = $stmt->execute();
    }
}
