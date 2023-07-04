<?php include("logincheck.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Core PHP CMS Admin Panel</title>
  <link rel="shortcut icon" type="image/png" href="img/favicon.png">
  <meta name="author" content="Amanz Galzor">
  <meta name="description" content="Core PHP CMS Admin by Amanz Galzor. Visit galzor.com for more information.">

  <!-- disable cache -->
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">

  <!-- core CSS-->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style-admin.css" rel="stylesheet">
  <link href="css/jquery-ui.min.css" rel="stylesheet">
  <link href="css/trumbowyg.min.css" rel="stylesheet">

  <!-- fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;600;700;800&display=swap" rel="stylesheet">

  <!-- core style -->
  <style>
    body, button, input, select, optgroup, textarea {
      font-family: 'Roboto', var(--bs-body-font-family), sans-serif;
      font-size: 0.9rem;
    }

    #wrapper {
      overflow-x: hidden;
      display: flex;
    }

    #site-sidebar {
      min-height: 100vh;
      margin-left: -200px;
      width: 200px;
      min-width: 200px;
      transition: margin 0.25s ease-out;
    }

    #site-content {
      width: 100vw;
      min-width: 100vw;
    }

    body.site-sidebar-toggled #wrapper #site-sidebar {
      margin-left: 0;
    }

    @media (min-width: 768px) {
      #site-sidebar {
        margin-left: 0;
      }

      #site-content {
        min-width: 0;
        width: 100%;
      }

      body.site-sidebar-toggled #wrapper #site-sidebar {
        margin-left: -200px;
      }
    }
  </style>

  <!-- core scripts, else in footer-->
  <script src="js/jquery.min.js"></script>
  <script>
    window.addEventListener('DOMContentLoaded', event => {

      // Toggle the side navigation
      const sidebarToggle = document.body.querySelector('#sidebarToggle');
      if (sidebarToggle) {+
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('site-sidebar-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
          event.preventDefault();
          document.body.classList.toggle('site-sidebar-toggled');
          localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('site-sidebar-toggled'));
        });
      }

    });
  </script>
</head>

<body class="bg-light" id="site">

  <!-- header -->
  <div class="site-header">
    <nav class="navbar navbar-expand navbar-dark bg-dark border-bottom border-secondary">
      <div class="container-fluid">
        <button id="sidebarToggle" class="navbar-toggler d-inline-block p-1" title="Menu"><span class="navbar-toggler-icon"></span></button>
        <a class="navbar-brand ms-3 p-0" href="#"> <i class="fa fa-earth-americas text-warning"></i> <strong> Fundermax Admin Panel</strong> </a>
        <!-- <a class="btn btn-warning btn-sm ms-auto" href="../index.php" target="_blank"> <i class="fa fa-home"></i> Visit Site</a> -->
        <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button> -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto">
            <!-- <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li> -->
            <!-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"> Dropdown </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another</a></li>
              </ul>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" title="Logout" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal"> <i class="fa fa-fw fa-sign-out-alt"></i> <span class="d-none d-lg-inline">Logout</span> </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" title="Visit Site" href="../index.php" target="_blank"> <i class="fa fa-home"></i> <span class="d-none d-lg-inline">Visit Site</span> </a>
            </li>

          </ul>
        </div>

      </div>
    </nav>
  </div>

  <div id="wrapper">

    <!-- Sidebar-->
    <div id="site-sidebar" class="bg-dark border-end text-light">
      <?php include("sidebar.php"); ?>
    </div>

    <!-- Page content wrapper-->
    <div id="site-content" class="content-main bg-light p-4 pe-lg-5">

