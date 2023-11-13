<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}
;

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

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
      <h3>about us</h3>
      <p><a href="home.php">Beranda</a> <span> / Tentang Kami</span></p>
   </div>

   <!-- about section starts  -->

   <section class="about">

      <div class="row">

         <div class="image">
            <img src="images/bu-ristanti.png" alt="">
         </div>

         <div class="content">
            <h3>Mengapa Harus Pesan di Waroeng_Buris?</h3>
            <p>
               <strong>Kami adalah destinasi utama untuk pencinta kue dan camilan <span style="color:red">preorder
                     kilat!</span></strong>
               🎉
            </p>
            <p>
               Dari kue-kue lezat hingga camilan kustom yang menggoda, kami punya semua yang Anda butuhkan untuk
               memuaskan selera manis Anda.<br>
               🧁 Aneka Kue Lezat<br>
               🍪 Custom Snack<br>
               📦Preorder<br>
            </p>
            <p>
               📷Jangan lupa untuk mengikuti kami untuk mendapatkan tampilan eksklusif dari kreasi kami. Tag kami
               dengan #waroengburis #momenbarengburis saat Anda menikmati produk kami untuk peluang tampil di halaman
               kami dan
               berkesempatan mendapatkan diskon atau voucher menarik!
            </p>
            </ul>

            <p>
               Terima kasih sudah
               memilih Waroeng_Buris sebagai sumber kue dan camilan favorit Anda! 🍰✨"
            </p>
            <a href="menu.html" class="btn">Menu Kami</a>
         </div>

      </div>

   </section>

   <!-- about section ends -->

   <!-- steps section starts  -->

   <section class="steps">

      <h1 class="title">Cara Melakukan Pesanan</h1>

      <div class="box-container">

         <div class="box">
            <img src="images/step-1.png" alt="">
            <h3>Pilih Menu</h3>
            <p>Silahkan pilih menu. Anda juga bisa lihat berdasarkan kategori.</p>
         </div>

         <div class="box">
            <img src="images/step-2.png" alt="">
            <h3>Konfirmasi Pesanan</h3>
            <p>Melakukan pembayaran dengan metode pembayaran yang
               beragam. Anda juga bisa melakukan konfirmasi pesanan disini.</p>
         </div>

         <div class="box">
            <img src="images/step-3.png" alt="">
            <h3>Tunggu Pesanan</h3>
            <p>Setelah pesanan di verifikasi oleh admin kami. Makanan siap diantarkan.</p>
         </div>

      </div>

   </section>

   <!-- steps section ends -->

   <!-- reviews section starts  -->

   <section class="reviews">

      <h1 class="title">Apa Kata Pelanggan Kami?</h1>

      <div class="swiper reviews-slider">

         <div class="swiper-wrapper">

            <div class="swiper-slide slide">
               <img src="images/pic-1.png" alt="">
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptate eligendi laborum molestias ut
                  earum nulla sint voluptatum labore nemo.</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
               <h3>A - Tj. Priok, Guru SDN 1 Jakut</h3>
            </div>

            <div class="swiper-slide slide">
               <img src="images/pic-2.png" alt="">
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptate eligendi laborum molestias ut
                  earum nulla sint voluptatum labore nemo.</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
               <h3>B - Koja, Pegawai Swasta</h3>
            </div>

            <div class="swiper-slide slide">
               <img src="images/pic-3.png" alt="">
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptate eligendi laborum molestias ut
                  earum nulla sint voluptatum labore nemo.</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
               <h3>C - Kota Tua, Pelajar SMA</h3>
            </div>

            <div class="swiper-slide slide">
               <img src="images/pic-4.png" alt="">
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptate eligendi laborum molestias ut
                  earum nulla sint voluptatum labore nemo.</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
               <h3>D - Pelumpang, Pegawai Swasta</h3>
            </div>

            <div class="swiper-slide slide">
               <img src="images/pic-5.png" alt="">
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptate eligendi laborum molestias ut
                  earum nulla sint voluptatum labore nemo.</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
               <h3>E - Taman Sari, Mahasiswa</h3>
            </div>

            <div class="swiper-slide slide">
               <img src="images/pic-6.png" alt="">
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptate eligendi laborum molestias ut
                  earum nulla sint voluptatum labore nemo.</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
               <h3>F - Matraman, Ibu Rumah Tangga</h3>
            </div>
            <div class="swiper-slide slide">
               <img src="images/pic-6.png" alt="">
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptate eligendi laborum molestias ut
                  earum nulla sint voluptatum labore nemo.</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
               <h3>G - Bekasi Selatan, Ibu Rumah Tangga</h3>
            </div>
         </div>

         <div class="swiper-pagination"></div>

      </div>

   </section>

   <!-- reviews section ends -->



















   <!-- footer section starts  -->
   <?php include 'components/footer.php'; ?>
   <!-- footer section ends -->=






   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

   <script>

      var swiper = new Swiper(".reviews-slider", {
         loop: true,
         grabCursor: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
         breakpoints: {
            0: {
               slidesPerView: 1,
            },
            700: {
               slidesPerView: 2,
            },
            1024: {
               slidesPerView: 3,
            },
         },
      });

   </script>

</body>

</html>