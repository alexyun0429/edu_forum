<html>

<head>
    <title>INFS3202 Demo</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
</head>

<body>
    <script>
        // Show select image using file input.
        function readURL(input) {
            $('#default_img').show();
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#select')
                        .attr('src', e.target.result)
                        .width(300)
                        .height(200);

                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        
    <!-- LOGO -->
        <?php if (session()->get('email')) { ?>
            <a class="navbar-brand" href="<?php echo base_url(); ?>dashboard">UniTalk</a>
        <?php } else { ?>
            <a class="navbar-brand" href="<?php echo base_url(); ?>login">UniTalk</a>
        <?php } ?>
       
        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">asdf</span>
        </button> -->
        
        <!-- Home Button -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <?php if (session()->get('email')) { ?>
                        <a href="<?php echo base_url(); ?>dashboard"> Home </a>
                    <?php } else { ?>
                        <a href="<?php echo base_url(); ?>login"> Home </a>
                    <?php } ?>
                </li>
            </ul>
            <ul class="navbar-nav my-lg-0">
        </div>

        <!-- <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form> -->

        <!-- Join or Create course -->
        <?php if (session()->get('email')) { ?>
            <?php if ((session()->get('role'))=='student') {?>
                <a class="mx-4" href="<?php echo base_url(); ?>join_course"> Join new course </a>
            <?php } else { ?>  
                <a class="mx-4" href="<?php echo base_url(); ?>create_course"> Create new course </a>
            <?php } ?>
        <?php } ?>

       <!-- Profile Image -->
       <?php if (session()->get('email')): ?>
            <div class="dropdown">
                <?php if ($profilePicture != NULL): ?>
                    <img src="<?= $profilePicture ?>" class="dropdown-toggle rounded-circle" data-toggle="dropdown" height="50px">
                <?php else: ?>
                    <img src="<?= base_url('../../assets/img/defaultImage.png') ?>" class="dropdown-toggle rounded-circle" data-toggle="dropdown" height="40px">
                <?php endif; ?>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url(); ?>profile">Profile</a></li>
                    <li><a href="<?php echo base_url(); ?>login/logout">Logout</a></li>
                </ul>
            </div>
        <?php endif; ?>

        <!-- login or logout -->
        <?php if (session()->get('email')) { ?>
            <a class="mx-4" href="<?php echo base_url(); ?>login/logout"></a>
        <?php } else { ?>
            <a class="mx-4" href="<?php echo base_url(); ?>login"> Login </a>
        <?php } ?>

        <!-- Registration -->
        <?php if (! session()->get('email')) { ?>
            <a class="mx-4" href="<?php echo base_url(); ?>register"> Join </a>
        <?php } ?>
    </nav>
    <div class="container">

<!-- <nav class="navbar navbar-dark bg-dark navbar-expand-sm">
  <a class="navbar-brand" href="#">
    <img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/logo_white.png" width="30" height="30" alt="logo">
    BootstrapBay
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list-4" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbar-list-4">
    <ul class="navbar-nav">
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg" width="40" height="40" class="rounded-circle">
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Dashboard</a>
          <a class="dropdown-item" href="#">Edit Profile</a>
          <a class="dropdown-item" href="#">Log Out</a>
        </div>
      </li>   
    </ul>
  </div>
</nav> -->