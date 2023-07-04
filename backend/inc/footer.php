
      <footer class="site-footer">
        <div class="container">
          <div class="text-end">
            <!-- <small>Core PHP CMS Admin. Crafted by <a href="http://galzor.com" target="_blank" rel="noopener noreferrer">Amanz</a>.</small> -->
          </div>
        </div>
      </footer>

      <!-- ./site-content -->
    </div>
  </div>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="logoutModalLabel"><strong>Ready to Leave?</strong></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Click <strong>Logout</strong> below if you want to end your current session.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <a class="btn btn-dark" href="inc/logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- others JavaScript-->
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery.form.min.js"></script>
  <script src="js/jquery-ui.min.js"></script>
  <script src="js/custom-admin.js"></script>
  <script src="js/trumbowyg.min.js"></script>
  <script src="js/fontawesome.all.min.js" async></script>

  <!-- datepicker -->
  <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
  <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
  <script>
    $(document).ready(function() {
      console.log("footer jquery initilized.");

      // $('#trum-editor').trumbowyg();

      // $('#trum-editor').trumbowyg({
      //   semantic: {
      //     'div': 'div'
      //   }
      // });

      $('#trum-editor').trumbowyg({
        semantic: false
      });

      $('.datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        // minDate: 0,
      });

    });
  </script>

</body>
</html>
