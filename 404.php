<?php include('header.php'); ?>
<!-- header end -->

<div class="titlemon pt-4 pb-2">
  <div class="container text-center pt-4">
    <h1 class="text-dark"><strong> 404 </strong></h1>
    <div><a href="index.php"> <small> <i class="fa fa-arrow-left"></i> BACK TO HOME</small></a> </div>
    <span class="line"></span>
  </div>
</div>

<section class="page-section py-5">
  <div class="container">
    <div class="card card-body text-center py-4">

      <!-- <h2> <strong>404</strong>, Page not found!</h2> -->
      <h2> Page not Found! </h2>
      <div class="text-center">
        <p>This website is currently under construction and content is being created. Please check back later.</p>
        <a class="btn btn-dark d-inline-block" href="<?php echo $site_url; ?>">Back to Home</a> <br>
        <?php echo getcwd(); ?> <br>
      </div>

    </div>
  </div>
</section>

<!-- footer -->
<?php include('footer.php'); ?>
