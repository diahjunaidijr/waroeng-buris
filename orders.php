<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:home.php');
}
;

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

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
      <h3>Pesanan</h3>
      <p><a href="html.php">Beranda</a> <span> / Pesanan</span></p>
   </div>

   <section class="orders">

      <h1 class="title">Riwayat Pesanan Anda</h1>

      <div class="box-container">

         <?php
         if ($user_id == '') {
            echo '<p class="empty">Silahkan Login Untuk Melihat Riwayat Pesanan Anda!</p>';
         } else {
            $select_orders = $connect->prepare("SELECT * FROM `orders` WHERE user_id = ?");
            $select_orders->execute([$user_id]);
            if ($select_orders->rowCount() > 0) {
               while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <div class="box">
                     <p>No Pesanan : <span>
                           <?= $fetch_orders['id']; ?>
                        </span></p>
                     <p>Waktu Pemesanan : <span>
                           <?= $fetch_orders['placed_on']; ?>
                        </span></p>
                     <p>Nama : <span>
                           <?= $fetch_orders['name']; ?>
                        </span></p>
                     <p>Email : <span>
                           <?= $fetch_orders['email']; ?>
                        </span></p>
                     <p>Nomor Telp : <span>
                           <?= $fetch_orders['number']; ?>
                        </span></p>
                     <p>Alamat : <span>
                           <?= $fetch_orders['address']; ?>
                        </span></p>
                     <p>Metode Pembayaran : <span>
                           <?= $fetch_orders['method']; ?>
                        </span></p>
                     <p>Total Pesanan : <span>
                           <?= $fetch_orders['total_products']; ?>
                        </span></p>
                     <p>Total Harga : <span>Rp
                           <?= $fetch_orders['total_price']; ?>,-
                        </span></p>
                     <p>Status Pesanan : <span style="color:<?php if ($fetch_orders['payment_status'] == 'pending') {
                        echo 'red';
                     } else {
                        echo 'green';
                     }
                     ; ?>">
                           <?= $fetch_orders['payment_status']; ?>
                        </span></p>

                     <?php
                     if ($fetch_orders['payment_status'] != 'completed') {
                        // Hanya tampilkan tombol chat jika payment_status bukan 'completed'
                        ?>
                        <a href="https://api.whatsapp.com/send?phone=6285173318412&text=Halo,%20saya%20ingin%20bertanya%20mengenai%20pesanan%20saya%20dengan nomor pesanan<?= $fetch_orders['id']; ?>.%0A%0AEmail: <?= $fetch_orders['email']; ?>%0ANomor Telepon: <?= $fetch_orders['number']; ?>%0AAlamat: <?= $fetch_orders['address']; ?>%0AProduk: <?= $fetch_orders['total_products']; ?>%0AMetode Pembayaran: <?= $fetch_orders['method']; ?>%0ATotal Harga: Rp<?= $fetch_orders['total_price']; ?>,-"
                           class="btn">Chat WhatsApp</a>
                        <p>*Klik kembali continue chat dan open whatsapp jika rincian pesan belum tersedia!</p>

                        <?php
                     }
                     ?>

                  </div>


                  <?php

               }
            } else {
               echo '<p class="empty">no orders placed yet!</p>';
            }
         }
         ?>

      </div>

   </section>










   <!-- footer section starts  -->
   <?php include 'components/footer.php'; ?>
   <!-- footer section ends -->






   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>