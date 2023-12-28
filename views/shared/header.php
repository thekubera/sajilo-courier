<?php
  // URL Root

  define('URLROOT', 'http://localhost/sajilo-courier')
?>
<head>
  <title>Sajilo Courier</title>
  <base href="/sajilo-courier/">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

  <!-- Bootstrap Linking -->
  <link rel="stylesheet" type="text/css" href="<?= URLROOT;?>/libraries/bootstrap/css/bootstrap.min.css">

  <!-- fontawesome for icons -->
  <link rel="stylesheet" type="text/css" href="<?= URLROOT;?>/libraries/fontawesome/css/all.min.css">

  <!-- Custom Style Sheet -->
  <link rel="stylesheet" type="text/css" href="<?= URLROOT;?>/libraries/css/style.css">

  <link rel="stylesheet" type="text/css" href="<?= URLROOT;?>/libraries/css/searchbox.css">


  <!-- Data Table CSS -->
  <link rel="stylesheet" type="text/css" href="<?= URLROOT;?>/libraries/dataTables/css/dataTables.bootstrap4.min.css">

</head>
<body> 

<!--Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><img class="img-fluid rounded-circle mr-2" src="<?= URLROOT;?>/img/brand.png">Sajilo Courier</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    	<span class="navbar-toggler-icon"></span>
  	</button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav mr-auto ml-auto">
        <a href="<?= URLROOT; ?>/HomePage/Display" class="nav-link">Home <span class="sr-only">(current)</span></a>
          <a class="nav-link" href="<?= URLROOT; ?>/Branch/Index">Branches</a>
          <a class="nav-link" href="<?= URLROOT; ?>/User/Login">Login</a>
          <a class="nav-link" href="<?= URLROOT; ?>/About/Index">About</a>
      </div>
    </div>
</nav>