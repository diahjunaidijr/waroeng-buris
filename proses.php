<?php
// Load file koneksi.php
include "components/connect.php";

$nama = $_GET['name'];
$alamat = $_GET['address'];
$email = $_GET['email'];
$biaya = $_GET['total_price'];
$order_id = $_GET['id'];

// Prepare the query
$query = $connect->prepare("SELECT * FROM orders");

// Execute the query
$query->execute();

// Fetch the result
$orderData = $query->fetch(PDO::FETCH_ASSOC);

// Debugging with echo
echo "Debugging with echo:<br>";
echo "Order Data: ";
print_r($orderData);
echo "<br>";

// Debugging with var_dump
echo "Debugging with var_dump:<br>";
var_dump($orderData);
echo "<br>";

if ($orderData) {
    // ...
    // Your existing code here
    // ...

    // Redirect to the desired location
    header("location:./midtrans/examples/snap/simple-checkout.php?order_id=$order_id");
} else {
    echo "No order data found.";
}
?>
