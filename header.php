<?php include("include/fg-softcheck.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?php echo empty($title) ? "Core PHP CMS" : @$title; ?></title>
  <meta name="keywords" content="<?php echo @$keywords; ?>">
  <meta name="description" content="<?php echo @$description; ?>">
  <link rel="icon" type="image/png" href="<?php echo $site_url; ?>/img/favicon.png">

  <!-- disable cache -->
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">

  <!-- core CSS-->
  <link href="<?php echo $site_url; ?>/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo $site_url; ?>/css/fancybox.css" rel="stylesheet">
  <link href="<?php echo $site_url; ?>/css/fonts.css" rel="stylesheet">
  <link href="<?php echo $site_url; ?>/css/style.css" rel="stylesheet">

  <!-- scripts -->
  <script src="<?php echo $site_url; ?>/js/jquery.min.js"></script>
  <script src="<?php echo $site_url; ?>/js/bootstrap.bundle.min.js"></script>

</head>
<body>
  <?php
    //check if homepage
    $this_url_clean = str_replace('/','', trim("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"));
    $base_url_clean = str_replace('/','', $site_url);
  ?>
  <div id="site" class="site <?php echo ($base_url_clean==$this_url_clean)?"frontpage":"otherpage"; ?>">
    <div id="site-header" class="site-header bg-white">

      <div class="header-top border-bottom">
        <div class="container py-1">
          <div class="row">

            <div class="col-8 col-lg-6">
              <a class="me-4" href="mailto:info@example.com"> <small><i class="fa fa-envelope"></i> info@example.com</small> </a>
              <a class="me-2" href="tel:919611399211"> <small><i class="fa fa-phone"></i> Call us +91 1234567890</small> </a>
            </div>

            <div class="col-4 col-lg-6">
              <div class="social-top text-end">
                <a class="social-icon" href="#" target="_blank" rel="noopener noreferrer"> <i class="fab fa-facebook"></i> </a>
                <a class="social-icon" href="#" target="_blank" rel="noopener noreferrer"> <i class="fab fa-instagram"></i> </a>
                <a class="social-icon" href="#" target="_blank" rel="noopener noreferrer"> <i class="fab fa-twitter"></i> </a>
                <a class="social-icon" href="#" target="_blank" rel="noopener noreferrer"> <i class="fab fa-linkedin"></i> </a>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="header-main border-bottom">
        <div class="container py-2">
          <div class="row">

            <div class="col-12 col-lg-2">
              <a class="header-logo" href="<?php echo SITE_URL; ?>">
                <img src="<?php echo $site_url; ?>/img/logo.png" alt="" width="240">
              </a>
            </div>

            <div class="col-12 col-lg">
              <div class="header-nav">
                <nav class="navbar navbar-expand-lg navbar navbar-light bg-white">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo $site_url; ?>/index.php">Home </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo $site_url; ?>/about-us/">About</a>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"> Products </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="<?php echo $site_url; ?>/exterior-products/">Exterior</a></li>
                          <li><a class="dropdown-item" href="<?php echo $site_url; ?>/interior-products/">Interior</a></li>
                        </ul>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"> References </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="<?php echo $site_url; ?>/references.php?cat=certificates">Certificates</a></li>
                          <li><a class="dropdown-item" href="<?php echo $site_url; ?>/references.php?cat=technical-information">Technical Information</a></li>
                          <li><a class="dropdown-item" href="<?php echo $site_url; ?>/references.php?cat=success-stories">Success Stories</a></li>
                          <!-- <li><a class="dropdown-item" href="<?php echo $site_url; ?>/references.php?cat=knowledge-corner">Knowledge Corner</a></li> -->
                          <li><a class="dropdown-item" href="<?php echo $site_url; ?>/references.php?cat=in-the-news">In the News</a></li>
                        </ul>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo $site_url; ?>/gallery.php">Gallery</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo $site_url; ?>/csr">CSR</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo $site_url; ?>/careers/">Careers</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo $site_url; ?>/blog.php">Blog</a>
                      </li>
                      <li class="nav-item ms-lg-3">
                        <a class="nav-link active" href="<?php echo $site_url; ?>/contact-us.php">Contact</a>
                      </li>
                    </ul>
                  </div>
                </nav>
              </div>
            </div>

          </div>
        </div>
      </div>


    </div>

    <!-- site-content -->
    <div id="site-content" class="site-content bg-light">
