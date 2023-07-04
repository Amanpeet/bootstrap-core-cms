<?php include('header.php'); ?>
<!-- header end -->

<div class="titlemon pt-4 pb-3">
  <div class="container text-center pt-4">
    <h1 class="text-dark"><strong> Contact us </strong></h1>
    <div><a href="index.php"> <strong> <small><i class="fa fa-arrow-left"></i> BACK TO HOME </small></strong></a> </div>
    <span class="line"></span>
  </div>
</div>

<div class="response-section p-0">
  <div class="container text-center">
        <?php
      if (isset($_POST['mail_submit'])) {

        //check captchu
        $captchu = strip_tags( $_POST['captchu'] );
        $captchu_user = strip_tags( $_POST['captchu_user'] );
        if ( $captchu == $captchu_user ) {
          //send mail code

          $name    = strip_tags( $_POST['name'] );
          $company = strip_tags( $_POST['company'] );
          $email   = strip_tags( $_POST['email'] );
          $phone   = strip_tags( $_POST['phone'] );
          $msg     = strip_tags( $_POST['message'] );

          $to = "amanpreet@intiger.in";
          $from = "noreply@intiger.co.in";
          $subject = "Contact Form Query on Website";

          $message = "<html><head><title>Contact Form Query</title></head><body>";
          $message .= '<table rules="all" style="border:1px solid #ccc;" cellpadding="10">';
          $message .= "<tr> <td>Name</td> <td>".$name."</td> </tr>";
          $message .= "<tr> <td>Company</td> <td>".$company."</td> </tr>";
          $message .= "<tr> <td>Email</td> <td>".$email."</td> </tr>";
          $message .= "<tr> <td>Phone</td> <td>".$phone."</td> </tr>";
          $message .= "<tr> <td>Message</td> <td>".$msg."</td> </tr>";
          $message .= "</table>";
          $message .= "</body></html>";

          // Always set content-type when sending HTML email
          $headers = "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: <'.$from.'>' . "\r\n";
          $headers .= 'Reply-To: <'.$from.'>' . "\r\n";
          // $headers .= "CC: susan@example.com\r\n";

          $mail_check = mail($to, $subject, $message, $headers);
          if( $mail_check ){
            // echo "Mail Sent";
            ?>
              <div class="alert alert-success mt-4" role="alert">
                <h3> Thank you for contacting us.</h3>
                <h5> We will get back to you shortly.</h5>
              </div>
            <?php
          } else {
            // echo "Mail Failed";
            ?>
              <div class="alert alert-danger mt-4" role="alert">
                <h3> Error in sending message.</h3>
                <h5> Please try again later or Contact us manually.</h5>
              </div>
            <?php
          }

        } else {
          ?>
            <div class="alert alert-danger mt-4" role="alert">
              <h3> Error in Security Code. </h3>
              <h5> Please Calculate again and Input Right Code. </h5>
            </div>
          <?php
        }

      }
    ?>
  </div>
</div>

<section class="page-section pt-5 pb-4">
  <div class="container">

    <div class="row">
      <div class="col-md-7 mb-4">
        <div class="card card-body h-100">
          <h4 class="mb-0">Looking for solutions?</h4>
          <p class="text-muted">Fill this form and we will get in touch with you. </p>

          <form id="contact_form" action="" method="POST">
            <div class="row mb-3">
              <div class="col-md-12">
                <label class="text-black">Name</label>
                <input type="text" name="name" class="form-control" placeholder="your name" required>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-12">
                <label class="text-black">Company Name</label>
                <input type="text" name="company" class="form-control" placeholder="company name" required>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <?php
                  $sub_email = '';
                  if( isset($_GET['sub_email']) && !empty($_GET['sub_email']) ){
                    $sub_email = $_GET['sub_email'];
                  }
                ?>
                <label class="text-black">Email</label>
                <input type="email" name="email" class="form-control" placeholder="example@mail.com" value="<?php echo $sub_email; ?>" required>
              </div>
              <div class="col-md-6">
                <label class="text-black">Phone</label>
                <input type="subject" name="phone" class="form-control" placeholder="phone number" required>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-12">
                <label class="text-black">Message</label>
                <textarea name="message" name="message" rows="3" class="form-control" placeholder="Write questions here..." required></textarea>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-3">
                <label class="text-black">Security Code</label>
                <?php $num1 = rand(1, 9); $num2 = rand(1, 9); $sum = $num1 + $num2; ?>
                <input type="text" class="form-control text-center" value="<?php echo $num1." + ".$num2." = ";  ?>" disabled>
                <input type="hidden" name="captchu" value="<?php echo $sum; ?>" required>
              </div>
              <div class="col-md-4">
                <label class="text-black">Input Security Code</label>
                <input type="subject" name="captchu_user" class="form-control" placeholder="calculate" required>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-12">
                <input type="submit" name="mail_submit" value="Send Message" class="btn btn-dark py-2 px-4 text-white">
              </div>
            </div>
          </form>


        </div>
      </div>

      <div class="col-md-5 mb-4">
        <div class="card card-body h-100">
          <h4 class="mb-4">Contact Information</h4>
          <p class="mb-0"> <i class="fa fa-map-marker"></i> <strong>Address</strong></p>
          <p class="mb-4"> Fundermax India Pvt Ltd <br>
          Sy No.7, Honnenahalli <br>
          Bangalore - Doddballapur Highway Road, <br>
          Yelahanka Hobli, <br>
          Bangalore – 560064 <br>
          India   </p>

          <p class="mb-0"> <i class="fa fa-envelope"></i> <strong>Email</strong></p>
          <p class="mb-3"> Nivedita.Vibhaw@fundermax.biz </p>

          <p class="mb-4"> For careers, please write to us on <br> ashwani.khanna@fundermax.biz </p>

          <p class="mb-0"> <i class="fa fa-phone"></i> <strong>Phone</strong></p>
          <p class="mb-4"> +91-9611 399 211 </p>
        </div>
      </div>

    </div>
  </div>
</section>

<section class="page-section pt-0 pb-5">
  <div class="container pb-lg-5">
    <div class="card card-body text-center p-0">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3885.0036226974444!2d77.56376201482406!3d13.16217129073105!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae15c84991e4bb%3A0x474e650ae67d884a!2sFunderMax%20India%20Private%20Limited!5e0!3m2!1sen!2sin!4v1662223287465!5m2!1sen!2sin" frameborder="0" style="border:none; width:100%; height:400px;" allowfullscreen></iframe>
    </div>
  </div>
</section>

<!-- footer -->
<?php include('footer.php'); ?>
