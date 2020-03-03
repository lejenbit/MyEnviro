<?php
//ipinfo grabs the ip of the person requesting

$getloc = json_decode(file_get_contents("http://ipinfo.io/"));

//echo $getloc->city; //to get city

$coordinates = explode(",", $getloc->loc); // -> '32,-72' becomes'32','-72'
//echo $coordinates[0]; // latitude
//echo $coordinates[1]; // longitude

$longlat = $coordinates[1] . ', ' . $coordinates[0];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">

  <title>

    MyEnviro

  </title>
  <link rel="icon" 
      type="image/x-icon" 
      href="<?= base_url('assets/images/') ?>fav.ico" class="bg-success">
  <link href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic" rel="stylesheet">

  <link href="<?= base_url('assets/app-bs4') ?>/css/toolkit-light.css" rel="stylesheet">


  <link href="<?= base_url('assets/app-bs4') ?>/css/application.css" rel="stylesheet">

  <style>
    /* note: this is a hack for ios iframe for bootstrap themes shopify page */
    /* this chunk of css is not part of the toolkit :) */
    body {
      width: 1px;
      min-width: 100%;
      *width: 100%;
    }
  </style>
</head>


<body class="with-top-navbar">

  <nav class="navbar navbar-toggleable-sm fixed-top navbar-inverse bg-inverse app-navbar">
    <button class="navbar-toggler navbar-toggler-right hidden-md-up" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <a class="navbar-brand " href="#">
      <!-- <span class="icon icon-leaf navbar-brand-icon"></span> -->
      <img src="<?= base_url('assets/images/logo.jpeg') ?>" style="display: inline-block;">
    </a>

    <div class="collapse navbar-collapse mr-auto" id="navbarResponsive">
      <ul class="nav navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#modal-about">Tentang Portal</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('index.php/home/dashboard')?>" > Dashboard</a>
        </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Pautan Lain
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="https://www.doe.gov.my" target="_blank">Jabatan Alam Sekitar</a>
          <a class="dropdown-item" href="http://www.data.gov.my/" target="_blank">Data Terbuka</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
        
      </ul>

      <!-- <form class="form-inline hidden-sm-down ml-auto">
        <input class="form-control" type="text" data-action="grow" placeholder="Search">
      </form> -->
      <span class="navbar-text hidden-sm-down ml-auto">
        <h6>
          <small>
          <!-- <span class="icon icon-cloud navbar-brand-icon"></span>
        IP - <?= $getloc->ip ?><br> -->
        <span class="icon icon-address navbar-brand-icon"></span>
      Bandar - <?= $getloc->city ?><br>
      <span class="icon icon-direction navbar-brand-icon"></span>
      Long/Lat - <?= $longlat ?>
          </small>
        </h6>
      

    </span>
    </div>
  </nav>

  <div class="container-fluid container-fluid-spacious">
  <iframe src="<?= base_url()?>/viewer1" style="border:none; padding-top:40px" width="100%" class="myIframe"></iframe>
  </div>



  <script src="<?= base_url('assets/app-bs4') ?>/js/jquery.min.js"></script>
  <script src="<?= base_url('assets/app-bs4') ?>/js/tether.min.js"></script>
  <script src="<?= base_url('assets/app-bs4') ?>/js/chart.js"></script>
  <script src="<?= base_url('assets/app-bs4') ?>/js/tablesorter.min.js"></script>
  <script src="<?= base_url('assets/app-bs4') ?>/js/toolkit.js"></script>
  <script src="<?= base_url('assets/app-bs4') ?>/js/application.js"></script>
  <script>
    // execute/clear BS loaders for docs
    $(function() {
      while (window.BS && window.BS.loader && window.BS.loader.length) {
        (window.BS.loader.pop())()
      }
    })
    
    $('.myIframe').css('height', $(window).height()+'px');

  </script>
</body>

</html>

<div class="modal" id="modal-about">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><span class="icon icon-leaf navbar-brand-icon"></span> Tentang Portal</h4>
      </div>
      <div class="modal-body modal-body-scroller">
        <p align="justify">Memberi maklumat alam sekitar kepada orang awam. Antara maklumat yang disediakan adalah bacaan indeks pencemaran udara (IPU) dan bacaan kualiti air sungai.
          Sistem juga akan menyediakan pusat pengumpulan sisa elektronik yang berhampiran dengan kawasan pengguna.
          Maklumat berkenaan kewujudan ladang ternakan haiwan berdekatan kawasan pengguna juga akan dipaparkan yang boleh membantu pengguna untuk lebih peka dengan kawasan persekitaran mereka.
          Semua maklumat yang disediakan secara tidak langsung membantu pengguna untuk membuat keputusan dalam pembelian hartanah.
          Portal juga akan memaparkan senarai PBT dalam kawasan carian pengguna yang boleh dihubungi bagi saluran aduan atau maklumat lanjut. </p>
      </div>
    </div>
  </div>
</div>