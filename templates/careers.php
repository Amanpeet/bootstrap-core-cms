<?php /*
* Template: Careers Page
*/
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
?>

<div class="titlemon py-4">
  <div class="container text-center pt-4">
    <h1 class="text-dark"><strong> Careers </strong></h1>
    <div class="back-btn"><a href="../index.php"> <strong> <i class="fa fa-arrow-left"></i> BACK TO HOME</strong></a> </div>
    <span class="line"></span>
  </div>
</div>

<section class="site-section py-5">
  <div class="container">
    <div class="row">

      <div class="col-lg-12 mx-auto">
        <div class="page-content">
          <?php echo $post['page_content']; ?>
        </div>
      </div>

    </div>
  </div>
</section>

<section class="site-section bg-light py-0">
  <div class="container text-center">
    <?php
      if (isset($_POST['refer_submit'])) {

        //check captchu
        $captchu = strip_tags( $_POST['captchu'] );
        $captchu_user = strip_tags( $_POST['captchu_user'] );
        if ( $captchu == $captchu_user ) {
          //send mail code

          $name       = strip_tags( $_POST['name'] );
          $experience = strip_tags( $_POST['experience'] );
          $country    = strip_tags( $_POST['country'] );
          $email      = strip_tags( $_POST['email'] );
          $phone      = strip_tags( $_POST['phone'] );
          $msg        = strip_tags( $_POST['message'] );

          $to = "amanpreet@intiger.in";
          // $to = "aspnetusername@gmail.com";
          $from = "noreply@intiger.co.in";
          $subject = "Careers Form Registration on Website";

          $htmlMessage = "<html><head><title>Careers Form Registration</title></head><body>";
          $htmlMessage .= '<table rules="all" style="border:1px solid #ccc;" cellpadding="10">';
          $htmlMessage .= "<tr> <td>Name</td> <td>".$name."</td> </tr>";
          $htmlMessage .= "<tr> <td>Email</td> <td>".$email."</td> </tr>";
          $htmlMessage .= "<tr> <td>Phone</td> <td>".$phone."</td> </tr>";
          $htmlMessage .= "<tr> <td>Country</td> <td>".$country."</td> </tr>";
          $htmlMessage .= "<tr> <td>Experience</td> <td>".$experience."</td> </tr>";
          $htmlMessage .= "<tr> <td>Additional Details</td> <td>".$msg."</td> </tr>";
          $htmlMessage .= "</table>";
          $htmlMessage .= "</body></html>";

          // Always set content-type when sending HTML email
          $headers = "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          $headers .= 'From: <'.$from.'>' . "\r\n";
          $headers .= 'Reply-To: <'.$from.'>' . "\r\n";
          // $headers .= "CC: susan@example.com\r\n";

          // send email with attachments if found
          $path = $_FILES['attachment']['tmp_name'];
          if (file($path)) { //path of file after moving

            $maxTotalAttachments = 2097152; //Maximum of 2 MB total attachments, in bytes
            $boundary_text = "anyRandomStringOfCharactersThatIsUnlikelyToAppearInEmail";
            $boundary = "--".$boundary_text."\r\n";
            $boundary_last = "--".$boundary_text."--\r\n";
            $emailAttachments = "";
            $totalAttachmentSize = 0;

            foreach ($_FILES as $file) {
              //In case some file inputs are left blank - ignore them
              if ($file['error'] == 0 && $file['size'] > 0) {
                $fileContents = file_get_contents($file['tmp_name']);
                $totalAttachmentSize += $file['size']; //size in bytes
                $emailAttachments .= "Content-Type: "
                  . $file['type'] . "; name=\"" . basename($file['name']) . "\"\r\n"
                  . "Content-Transfer-Encoding: base64\r\n"
                  . "Content-disposition: attachment; filename=\""
                  . basename($file['name']) . "\"\r\n"
                  . "\r\n"
                  . chunk_split(base64_encode($fileContents))
                  . $boundary;
              }
            }

            if ($totalAttachmentSize == 0) {
              // echo "<strong> Mail Attachment Failed. </strong> ";
            } else {
              // Always set content-type when sending HTML email
              $headers = "MIME-Version: 1.0" . "\r\n";
              $headers .= 'From: <'.$from.'>' . "\r\n";
              $headers .= 'Reply-To: <'.$from.'>' . "\r\n";
              $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary_text\"" . "\r\n";
              $final_message .= "If you can see this, your email client " ."doesn't accept MIME types!\r\n" .$boundary;
              $final_message .= $emailAttachments;
              $final_message .= "Content-Type: text/html; charset=\"iso-8859-1\"\r\n" ."Content-Transfer-Encoding: 7bit\r\n\r\n" .$htmlMessage . "\r\n" .$boundary_last;
              // echo "<strong> Mail Attachment Attached. </strong> ";
            }

          } else {
            echo "<strong> Mail Simply. </strong> ";
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: <'.$from.'>' . "\r\n";
            $headers .= 'Reply-To: <'.$from.'>' . "\r\n";
            // $headers .= "CC: susan@example.com\r\n";
            $final_message = $htmlMessage;
          }

          // send email
          if (mail($to, $subject, $final_message, $headers)) {
            // echo "Mail Sent";
            ?>
              <div class="alert alert-success" role="alert">
                <h3> Thank you for registering. </h3>
                <h5> We will get in touch with you soon.</h5>
              </div>
            <?php
          } else {
            // echo "Mail Failed";
            ?>
              <div class="alert alert-danger" role="alert">
                <h3> Error in sending message. </h3>
                <h5> Please try again later or Contact us manually.</h5>
              </div>
            <?php
          }

        } else {
          ?>
            <div class="alert alert-danger" role="alert">
              <h3> Error in Security Code. </h3>
              <h5> Please Calculate again and Input Right Code. </h5>
            </div>
          <?php
        }

      }
    ?>
  </div>
</section>

<section class="site-section bg-light pt-0">
  <div class="container">

    <div class="card card-body">
      <div class="row">
        <div class="col-lg-8 mx-auto py-4">

          <h4 class="text-center">Fill up the form below & Get Enrolled with us!</h4>
          <p class="text-center"></p>

          <form action="" method="POST" enctype="multipart/form-data">

            <div class="row mb-3">
              <div class="col-md-12">
                <label class="text-black">Name</label>
                <input type="text" name="name" class="form-control" placeholder="your full name" required>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                <label class="text-black">Email</label>
                <input type="email" name="email" class="form-control" placeholder="example@mail.com" required>
              </div>
              <div class="col-md-6">
                <label class="text-black">Phone</label>
                <input type="subject" name="phone" class="form-control" placeholder="phone number" required>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                <label class="text-black">Experience</label>
                <input type="text" name="experience" class="form-control" placeholder="fresher or experienced">
              </div>
              <div class="col-md-6">
                <label class="text-black">Country</label>
                <input type="subject" name="country" class="form-control" placeholder="your country" required>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-12">
                <label class="text-black">Additional Information</label>
                <textarea name="message" name="message" rows="2" class="form-control" placeholder="Why should we hire you?"></textarea>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-12">
                <label for="attachment" class="form-label">Upload Resume/CV</label>
                <input class="form-control" type="file" id="attachment" name="attachment" accept=".doc,.docx,.pdf">
                <small class="text-muted">* Max Size 3MB, Only PDF and DOCX files are allowed.</small>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-3">
                <label class="text-black">Security Code</label>
                <?php $num1 = rand(1, 9); $num2 = rand(1, 9); $sum = $num1 + $num2; ?>
                <input type="text" class="form-control text-center" value="<?php echo $num1." + ".$num2." = ";  ?>" disabled>
                <input type="hidden" name="captchu" value="<?php echo $sum; ?>" required>
              </div>
              <div class="col-md-6">
                <label class="text-black">Input Security Code</label>
                <input type="subject" name="captchu_user" class="form-control" placeholder="calculate" required>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-12 text-center">
                <input type="submit" name="refer_submit" value="Submit" class="btn btn-dark py-3 px-5 text-white">
              </div>
            </div>

          </form>
        </div>
      </div>

    </div>


  </div>
</section>

<!-- footer -->
<?php include('footer.php'); ?>



