
    </div><!-- ./page-actual -->

    <!-- footer -->
    <div class="footer site-footer border-top">
      <div class="container pt-5">
        <div class="row">
          <div class="col-lg-5 pe-lg-5">
            <a href="<?php echo $site_url; ?>" class="d-block mb-4"><img src="<?php echo $site_url; ?>/img/logo.png" alt="" width="140"></a>
            <p>We are a leader in architectural products for interior and exterior applications without losing out on the aspect of sustainability of the complete system. </p>
            <div class="social-top text-start">
              <a class="social-icon" href="#" target="_blank"> <i class="fab fa-facebook"></i> </a>
              <a class="social-icon" href="#" target="_blank"> <i class="fab fa-instagram"></i> </a>
              <a class="social-icon" href="#" target="_blank"> <i class="fab fa-twitter"></i> </a>
              <a class="social-icon" href="#" target="_blank"> <i class="fab fa-linkedin"></i> </a>
            </div>
          </div>
          <div class="col-lg ps-lg-5">
            <h5 class="mt-3">Browse</h5>
            <ul class="list-unstyled mt-4">
              <li><a class="nav-link" href="<?php echo $site_url; ?>/index.php">Home</a></li>
              <li><a class="nav-link" href="<?php echo $site_url; ?>/about-us/">About us</a></li>
              <li><a class="nav-link" href="<?php echo $site_url; ?>/interior-products/">Interior Products</a></li>
              <li><a class="nav-link" href="<?php echo $site_url; ?>/exterior-products/">Exterior Products</a></li>
            </ul>
          </div>
          <div class="col-lg">
            <h5 class="mt-3 d-none d-lg-block">&nbsp;</h5>
            <ul class="list-unstyled mt-4">
              <li><a class="nav-link" href="<?php echo $site_url; ?>/gallery.php">Gallery</a></li>
              <li><a class="nav-link" href="<?php echo $site_url; ?>/blog.php">Blog</a></li>
              <li><a class="nav-link" href="<?php echo $site_url; ?>/contact-us.php">Contact us</a></li>
            </ul>
          </div>
          <div class="col-lg">
            <h5 class="mt-3">Useful Links</h5>
            <ul class="list-unstyled mt-4">
              <li><a class="nav-link" href="<?php echo $site_url; ?>/legal/">Legal</a></li>
              <li><a class="nav-link" href="<?php echo $site_url; ?>/data-protection/">Data Protection</a></li>
              <li><a class="nav-link" href="<?php echo $site_url; ?>/privacy-policy/">Privacy Policy</a></li>
            </ul>
          </div>
        </div>

        <div class="row border-top mt-5 py-4">
          <div class="col-12">
            <div class="copyright text-center text-muted">
              <p class="my-2"> &copy; Organization - 2023. &nbsp; Designed by <a class="text-muted" href="https://galzor.com/" target="_blank">Amanz</a>. </p>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- .site-wrap -->

  <!-- scripts -->
  <!-- main scripts in header -->
  <!-- <script src="js/main.js"></script> -->
  <script src="<?php echo $site_url; ?>/js/fancybox.umd.js"></script>
  <script src="<?php echo $site_url; ?>/js/fontawesome.all.min.js" async></script>

  <script>
    $(document).ready(function() {
      console.log("footer jquery initilized.");
      // $('#popup').modal('show');


    });
  </script>

</body>
</html>
