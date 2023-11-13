<?php

require_once 'vendor/midtrans/autoload.php'; // Sesuaikan dengan path ke SDK Midtrans

include 'components/connect.php';
\Midtrans\Config::$serverKey = 'SB-Mid-server-DysXp3GPCqVPbKeXJ4tw_8vz';
\Midtrans\Config::$clientKey = 'SB-Mid-client-LI0Fijq4xllaX8bA';
\Midtrans\Config::$isProduction = false; // Set ke true jika Anda ingin menggunakan mode produksi

// Membuat objek pesanan
$transaction = new \Midtrans\Transaction();

// Membuat item-item dalam pesanan
$items = [
    [
        'id' => 'item1',
        'price' => $grand_total,
        'quantity' => 1,
        'name' => 'Nama Item 1',
    ],
];

// Mengisi detail pembayaran
$transaction_details = [
    'order_id' => 'ORDER-' . time(),
    // Ganti dengan ID pesanan yang sesuai
    'gross_amount' => $grand_total,
    // Total jumlah pembayaran
];

// Membuat objek pembayaran
$transaction_data = [
    'transaction_details' => $transaction_details,
    'item_details' => $items,
];

// Membuat permintaan pembayaran ke Midtrans
try {
    $snapToken = $transaction->createSnapToken($transaction_data);
} catch (\Exception $e) {
    // Tangani kesalahan pembuatan Snap Token di sini
    echo 'Error creating Snap Token: ' . $e->getMessage();
}

// Setelah mendapatkan Snap Token, Anda dapat menggunakannya untuk mengarahkan pengguna ke halaman pembayaran Midtrans



?>