<?php
require_once 'C:/xampp/htdocs/food website backend/vendor/autoload.php'; // Sesuaikan dengan path ke SDK Midtrans

include 'components/connect.php';
\Midtrans\Config::$serverKey = 'SB-Mid-server-DysXp3GPCqVPbKeXJ4tw_8vz';
\Midtrans\Config::$clientKey = 'SB-Mid-client-LI0Fijq4xllaX8bA';
\Midtrans\Config::$isProduction = false; // Set ke true jika Anda ingin menggunakan mode produksi

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:home.php');
}
;

if (isset($_POST['submit'])) {

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = $_POST['address'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];

   $check_cart = $connect->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);

   if ($check_cart->rowCount() > 0) {

      if ($address == '') {
         $message[] = 'Silahkan masukkan alamat Anda!';
      } else {

         if ($method == 'cod') {
            $insert_order = $connect->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
            $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

            $delete_cart = $connect->prepare("DELETE FROM `cart` WHERE user_id = ?");
            $delete_cart->execute([$user_id]);
            // Tangani pembayaran metode "cash on delivery" di sini
            $message[] = 'Pesanan Anda berhasil diproses dengan metode "Bayar di Tempat"!';

         } elseif ($method == 'transfer') {

            // Buat transaksi dengan informasi yang diperlukan

            $orderID = $user_id . '-' . time(); // Menggunakan ID pengguna dan timestamp
            $get_total_price = $connect->prepare("SELECT SUM(price * quantity) AS grand_total FROM `cart` WHERE user_id = ?");
            $get_total_price->execute([$user_id]);
            $grand_total = $get_total_price->fetch(PDO::FETCH_ASSOC)['grand_total'];

            $transactionDetails = [

               'order_id' => $orderID,
               // Ganti dengan ID pesanan Anda
               'gross_amount' => (float) $grand_total,

               // Total harga
            ];

            // Buat item pembayaran (opsional)
            $itemDetails = [
               [
                  'id' => 'item-1',
                  'price' => $grand_total,
                  'quantity' => 1,
                  'name' => $name,
               ],
            ];

            // Konfigurasi pembayaran
            $transactionData = [
               'transaction_details' => $transactionDetails,
               'item_details' => $itemDetails,
            ];

            // Buat transaksi menggunakan kunci server
            try {
               $snap = \Midtrans\Snap::createTransaction($transactionData);
               $redirectURL = $snap->redirect_url; // URL pembayaran dari Midtrans

               // Redirect pengguna ke halaman pembayaran Midtrans
               header("Location: $redirectURL");
               $insert_order = $connect->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
               $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

               $delete_cart = $connect->prepare("DELETE FROM `cart` WHERE user_id = ?");
               $delete_cart->execute([$user_id]);
               // Tangani pembayaran metode "cash on delivery" di sini
               $message[] = 'Pesanan Anda berhasil diproses dengan metode "Transfer"!';
               exit;
            } catch (\Exception $e) {
               // Tangani kesalahan jika ada
               echo "Error: " . $e->getMessage();
            }
         }

      }

   } else {
      $message[] = 'keranjangmu kosong!';
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">


</head>

<body>

   <!-- header section starts  -->
   <?php include 'components/user_header.php'; ?>
   <!-- header section ends -->

   <div class="heading">
      <h3>checkout</h3>
      <p><a href="home.php">Beranda</a> <span> / Pembayaran</span></p>
   </div>

   <section class="checkout">

      <h1 class="title">Belanjaan</h1>

      <form action="" method="post">

         <div class="cart-items">
            <h3>Barang di Keranjang</h3>
            <?php
            $grand_total = 0;
            $cart_items[] = '';
            $select_cart = $connect->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $select_cart->execute([$user_id]);
            if ($select_cart->rowCount() > 0) {
               while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                  $cart_items[] = $fetch_cart['name'] . ' (' . $fetch_cart['price'] . ' x ' . $fetch_cart['quantity'] . ') - ';
                  $total_products = implode($cart_items);
                  $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
                  ?>
                  <p><span class="name">
                        <?= $fetch_cart['name']; ?>
                     </span><span class="price">Rp
                        <?= $fetch_cart['price']; ?> x
                        <?= $fetch_cart['quantity']; ?>
                     </span></p>
                  <?php
               }
            } else {
               echo '<p class="empty">Keranjangmu Kosong!</p>';
            }
            ?>
            <p class="grand-total"><span class="name">Total Keseluruhan :</span><span class="price">Rp
                  <?= $grand_total; ?>
               </span></p>

            <a href="cart.php" class="btn">Lihat Keranjang</a>
         </div>

         <input type="hidden" name="total_products" value="<?= $total_products; ?>">
         <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
         <input type="hidden" name="name" value="<?= $fetch_profile['name'] ?>">
         <input type="hidden" name="number" value="<?= $fetch_profile['number'] ?>">
         <input type="hidden" name="email" value="<?= $fetch_profile['email'] ?>">
         <input type="hidden" name="address" value="<?= $fetch_profile['address'] ?>">

         <div class="user-info">
            <h3>Informasi Akun Anda</h3>
            <p><i class="fas fa-user"></i><span>
                  <?= $fetch_profile['name'] ?>
               </span></p>
            <p><i class="fas fa-phone"></i><span>
                  <?= $fetch_profile['number'] ?>
               </span></p>
            <p><i class="fas fa-envelope"></i><span>
                  <?= $fetch_profile['email'] ?>
               </span></p>
            <a href="update_profile.php" class="btn">Perbaharui Info</a>
            <h3>Alamat Pengiriman</h3>
            <p><i class="fas fa-map-marker-alt"></i><span>
                  <?php if ($fetch_profile['address'] == '') {
                     echo 'Tolong masukkan alamat kamu';
                  } else {
                     echo $fetch_profile['address'];
                  } ?>
               </span></p>
            <a href="update_address.php" class="btn">Perbaharui Alamat</a>

            <p><strong>Pilih Metode Pembayaran:</strong></p>
            <select name="method" class="box" required>
               <option value="" disabled selected>-- Pilih --</option>
               <option value="cod">Bayar di Tempat</option>
               <option value="transfer">Transfer</option>
            </select>

            <input type="submit" class="btn mt-2" style="width:100%; background:var(--red); color:var(--white);"
               name="submit">
            <div id="paypal-button-container" class="mt-2"></div>

         </div>

      </form>

   </section>




   <!-- footer section starts  -->
   <?php include 'components/footer.php'; ?>
   <!-- footer section ends -->




   <!-- custom js file link  -->
   <script src="js/script.js"></script>

   <!--Replace "test" with your own sandbox business account app client ID-->
   <script
      src="https://www.paypal.com/sdk/js?client-id=AQj9DGUIknrS0kI9rNv_kIrmBKdO7sGJ_ElKztV2-IOZO240RDHesGNumG3LWyjbCuKlvRIjHQfGeXk7&currency=USD"></script>

   <script>
      paypal.Buttons({
         //Sets up the transaction when a payment button is clicked
         createOrder: (data, actions) => {
            return actions.order.create({
               purchase_units: [{
                  amount: {
                     // value: '<?= $grand_total; ?>'
                     value: '0.01'
                  }
               }]
            });
         },
         //Finalize the transaction after payer approval
         onApprove: (data, actions) => {
            return actions.order.capture().then(function (orderData) {
               //successful capture! for dev/demo purposes:
               console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
               const transaction = orderData.purchase_units[0].payments.captures[0];
               alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
               // When ready to go live, remove the alert and show a success message within this page. For example:
               // const element = document.getElementById('paypal-button-container');
               // element.innerHTML = '<h3>Thank you for your payment!</h3>';
               // Or go to another URL:  window.location.href = 'thank_you.html';

               // Perform additional actions after successful payment
               // For example, insert order into the database and display a success message
               $.post('process_order.php', {
                  total_price: <?= $grand_total; ?>,
                  // ... other data you want to pass ...
               }, function (response) {
                  if (response === 'success') {
                     // Redirect or display a success message here
                     alert('Thank you for your payment! Your order has been successfully processed.');
                  } else {
                     alert('There was an error processing your order.');
                  }

               });
            });
         }
      }).render('#paypal-button-container');
   </script>
</body>

</html>