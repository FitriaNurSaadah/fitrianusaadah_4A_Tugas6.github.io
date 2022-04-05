<?php
$bandara_asal = [
    "Soekarno-Hatta" => 65000,
    "Husein Sastranegara" => 50000,
    "Abdul Rahman Saleh" => 40000,
    "Juanda" => 30000
];
ksort ($bandara_asal);

$bandara_tujuan = [
    "Ngurah Rai" => 85000,
    "Hasanuddin" => 70000,
    "Inanwantan" => 90000,
    "Sultan Iskandar Muda" => 60000
];
ksort ($bandara_tujuan);

function pajak_asal ($bandara_asal, $asal){
    $harga_pajak = $bandara_asal[$asal];
    return $harga_pajak;
}

function pajak_tujuan ($bandara_tujuan, $tujuan){
    $harga_pajak = $bandara_tujuan[$tujuan];
    return $harga_pajak;
}

function hitung_total_pajak ($bandara_asal, $asal, $bandara_tujuan, $tujuan){
    $harga_pajak_asal = pajak_asal ($bandara_asal, $asal);
    $harga_pajak_tujuan = pajak_tujuan ($bandara_tujuan, $tujuan);
    $total_pajak = $harga_pajak_asal + $harga_pajak_tujuan;
    return $total_pajak;
}

function hitung_total_harga_tiket ($harga_tiket, $total_pajak){
    $total_harga_tiket = $harga_tiket + $total_pajak;
    return $total_harga_tiket;
}

function rupiah ($angka){
    $hasil = "Rp " . number_format($angka,0,',','.');
    return $hasil;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>daftar Rute Penerbangan</title>
    <link rel="stylesheet" href="bismillah.css">
</head>
<body>
<nav class="navbar navbar-expand-lg avbar-dark bg-dark shadow-lg fixed-top">
  <div class="container-fluid">
  <a class="navbar-brand" href="#">MAU KEMANA?</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse text-right" id="navbarText">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#pesan">Pesan Tiket</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#layanan">Layanan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#hubungi">Hubungi Kami</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container-fluid banner">
    </div>

<!--Daftar-->
<div class="container-fluid pt-5 pb-5 bg-light">
<h1 id="pesan">Pendaftaran Rute Penerbangan</h1>
    <div class="container">
        <form class="box" action="" method="POST">
            <input type="hidden" name="tanggal" value="<?php echo date ("d-m-Y"); ?>">
            <label for="nama_maskapai"><strong>Nama Maskapai</strong></label>
            <input type="text" name="nama_maskapai" id="nama_maskapai">
            <label for="bandara_asal"><strong>Bandara Asal</strong></label>
            <select name="bandara_asal" id="bandara_asal">
                <?php
                foreach ($bandara_asal as $asal => $pajak_asal){
                    ?>
                    <option value="<?= $asal; ?>"><?= $asal; ?></option>
                    <?php
                }
                ?>
            </select>
            <label for="bandara_tujuan"><strong>Bandara Tujuan</strong>
            <select name="bandara_tujuan" id="bandara_tujuan">
                <?php
                foreach ($bandara_tujuan as $tujuan => $pajak_tujuan){
                    ?>
                    <option value="<?= $tujuan; ?>"><?= $tujuan; ?></option>
                    <?php
                }
                array_multisort($bandara_tujuan, SORT_ASC, $tujuan);
                ?>
            </select>
            <label for="harga_tiket"><strong>Harga Tiket</strong></label>
            <input type="number" name="harga_tiket" id="harga_tiket">
            <input type="submit" value="Daftar" name="daftar">
        </form>
    </div>
    </div>

    <div class="container-fluid pt-5 pb-5 bg-light">
    <div class="container1">
        <table width="400px" height="363px">
            <?php
            if (isset($_POST['daftar'])){
                $tanggal            = $_POST['tanggal'];
                $maskapai           = $_POST['nama_maskapai'];
                $asal               = $_POST['bandara_asal'];
                $tujuan             = $_POST['bandara_tujuan'];
                $harga_tiket        = $_POST['harga_tiket'];
                $pajak              = hitung_total_pajak($bandara_asal, $asal, $bandara_tujuan, $tujuan);
                $total_harga_tiket  = hitung_total_harga_tiket($_POST['harga_tiket'], $pajak);
            }
            ?>
            <tr>
                <td><strong><?php echo "Tanggal"?></strong></td>
                <td>:</td>
                <?php if(!empty($tanggal)){?>
                <td><?php echo "$tanggal"?></td>
                <?php }?>
            </tr>

            <tr>
                <td><strong><?php echo "Nama Maskapai"?></strong></td>
                <td>:</td>
                <?php if(!empty($tanggal)){?>
                <td><?php echo "$maskapai"?></td>
                <?php }?>
            </tr>

            <tr>
                <td><strong><?php echo "Asal Penerbangan"?></strong></td>
                <td>:</td>
                <?php if(!empty($tanggal)){?>
                <td><?php echo "$asal"?></td>
                <?php }?>
            </tr>

            <tr>
                <td><strong><?php echo "Tujuan Penerbangan"?></strong></td>
                <td>:</td>
                <?php if(!empty($tanggal)){?>
                <td><?php echo "$tujuan"?></td>
                <?php }?>
            </tr>

            <tr>
                <td><strong><?php echo "Harga Tiket"?></strong></td>
                <td>:</td>
                <?php if(!empty($tanggal)){?>
                <td><?php echo "".rupiah($harga_tiket) ?></td>
                <?php }?>
            </tr>

            <tr>
                <td><strong><?php echo "Pajak"?></strong></td>
                <td>:</td>
                <?php if(!empty($tanggal)){?>
                <td><?php echo "".rupiah($pajak) ?></td>
                <?php }?>
            </tr>

            <tr>
                <td><strong><?php echo "Total Harga Tiket"?></strong></td>
                <td>:</td>
                <?php if(!empty($tanggal)){?>
                <td><?php echo "".rupiah($total_harga_tiket) ?></td>
                <?php }?>
            </tr>
        </table>
    </div>
    </div>
        <!--layanan--> 
        <div class="container-fluid pt-5 pb-5 layanan">
      <div class="container2 text-center">
      <h4 class="display-3" id="layanan" style="font-family:'Segoe UI'">
              Memenuhi Layanan :</h4>
            <div class="row pt-4">
                <div class="col-md-4">
                  <img src="bayar.jpg" width="100" height="100" />
                    <h3 class="mt-3" style="font-family:Tahoma;">Pilihan Pembayaran</h3>
                    <p style="font-family: Cambria; ">
                      Pembelian tiket menjadi semakin fleksibel dengan berbagai pilihan pembayaran
                    </p>
                </div>
                <div class="col-md-4">
                  <img src="amin.jpg" width="100" height="100" />
                    <h3 class="mt-3" style="font-family:Tahoma;">Jaminan Aman</h3>
                    <p style="font-family: Cambria; ">
                      Transaksi Online menjamin privasi dan keamanan transaksi online Anda.
                    </p>
                </div>
                <div class="col-md-4">
                  <img src="hy.png" width="100" height="100" />
                    <h3 class="mt-3" style="font-family:Tahoma;">Pencarian Terlengkap</h3>
                    <p style="font-family: Cambria; ">
                      Dapatkan promo tiket pesawat seluruh Indonesia
                    </p>
                </div>
            </div>
      </div>
      </div>

       <!-- kontak -->
       <div class="container-fluid pt-5 pb-5 kontak">
        <div class="container3">
        <h2 class="display-3 text-center" id="hubungi" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">
          Kontak Kami</h2>
        <div class="row pb-2">
          <div class="col-md-6">
            <input class="form-control form-control-lg mb-3"
            type="text"
            placeholder="Nama"
            />
            <input class="form-control form-control-lg mb-3"
            type="text"
            placeholder="Email"
            />
            <input class="form-control form-control-lg mb-3 "
            type="text"
            placeholder="No.Phone"
            />
          </div>
            <div class="col-md-6">
              <textarea class="form-control form-control-lg" rows="5" placeholder="Pesan"></textarea>
            </div>
        </div>
        <div class="col-md-3 mx-auto text-center">
          <button type="button" class="btn btn-danger btn-lg">Kirim Pesan</button>
        </div>
        </div>
      </div>
      <div class="container4 text-center pt-2 pb-2">
        © 2022 Travel. All rights reserved.
      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>