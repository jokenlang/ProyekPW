<?php

namespace Midtrans;

require_once('../connection.php');
require_once dirname(__FILE__) . '/../Midtrans.php';
Config::$isProduction = false;
Config::$serverKey = 'SB-Mid-server-xC91-kxK1hlB1UzFglD4McG4';
// Config::$serverKey = 'SB-Mid-server-gHZXLWEWjUFrJg7UcvqEbqjd';
$notif = new \Midtrans\Notification();

$transaction = $notif->transaction_status;
$type = $notif->payment_type;
$order_id = $notif->order_id;
$fraud = $notif->fraud_status;
$settlement_time = $notif->settlement_time;

if ($transaction == 'capture') {
  // For credit card transaction, we need to check whether transaction is challenge by FDS or not
  if ($type == 'credit_card') {
    if ($fraud == 'challenge') {
      // TODO set payment status in merchant's database to 'Challenge by FDS'
      // TODO merchant should decide whether this transaction is authorized or not in MAP
      echo "Transaction order_id: " . $order_id . " is challenged by FDS";
    } else {
      // TODO set payment status in merchant's database to 'Success'
      echo "Transaction order_id: " . $order_id . " successfully captured using " . $type;
    }
  }
} else if ($transaction == 'settlement') {
  // TODO set payment status in merchant's database to 'Settlement'
  //echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
  // $stmt = $conn->prepare("UPDATE `htrans` SET `transaction_status` = ?,`settlement_time` = ? WHERE `htrans`.`order_id` = ?");
  // $stmt->bind_param("sss", $transaction, $settlement_time, $order_id);
  // $result = $stmt->execute();
  $stmt = $conn->prepare("UPDATE `htrans` SET `transaction_status` = ? WHERE `htrans`.`order_id` = ?");
  $stmt->bind_param("ss", $transaction, $order_id);
  $result = $stmt->execute();
} else if ($transaction == 'pending') {
  // TODO set payment status in merchant's database to 'Pending'
  // echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
  $stmt = $conn->prepare("UPDATE `htrans` SET `transaction_status` = ? WHERE `htrans`.`order_id` = ?");
  $stmt->bind_param("ss", $transaction, $order_id);
  $result = $stmt->execute();
} else if ($transaction == 'deny') {
  // TODO set payment status in merchant's database to 'Denied'
  // echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
  $stmt = $conn->prepare("UPDATE `htrans` SET `transaction_status` = ? WHERE `htrans`.`order_id` = ?");
  $stmt->bind_param("ss", $transaction, $order_id);
  $result = $stmt->execute();
} else if ($transaction == 'expire') {
  // TODO set payment status in merchant's database to 'expire'
  // echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
  $stmt = $conn->prepare("UPDATE `htrans` SET `transaction_status` = ? WHERE `htrans`.`order_id` = ?");
  $stmt->bind_param("ss", $transaction, $order_id);
  $result = $stmt->execute();
} else if ($transaction == 'cancel') {
  // TODO set payment status in merchant's database to 'Denied'
  // echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
  $stmt = $conn->prepare("UPDATE `htrans` SET `transaction_status` = ? WHERE `htrans`.`order_id` = ?");
  $stmt->bind_param("ss", $transaction, $order_id);
  $result = $stmt->execute();
}
