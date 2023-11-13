<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulir Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>

    <div class="container ">
      <br>
      <br>
       <div class="card"> 
  <div class="card-body">
  <div class="row">
    <div class="col">
      <br>
      <br>
      <br>
      <h1>FORMULIR PEMBAYARAN</h1>
    <form action="proses.php" method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nama Lengkap Peserta</label>
    <input type="text" name="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text"></div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Email</label>
    <input type="email" name="email" class="form-control" id="exampleInputPassword1">
  </div>
 <div class="form-floating">
  <textarea class="form-control" name="alamat" placeholder="Alamat Anda" id="floatingTextarea"></textarea>
  <label for="floatingTextarea">Alamat</label>
</div>
<br>
  <button type="submit" class="btn btn-primary">PAYMENT REGISTER</button>
</form>
<br><br>
    </div>
    </div>
 </div>
</div>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>