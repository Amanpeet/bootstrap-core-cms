<?php
if (isset($_POST['mail_submit'])) {

  $name    = strip_tags( $_POST['name'] );
  $email   = strip_tags( $_POST['email'] );
  $phone   = strip_tags( $_POST['phone'] );
  // $subject = strip_tags( $_POST['subject'] );
  $msg = strip_tags( $_POST['message'] );

  $to = "sales@example.com , aspnetusername@gmail.com";
  $from = "website@example.com";
  $subject = "Quote Form Query on Website";

  $message = "<html><head><title>Product Quote Form</title></head><body>";
  $message .= '<table rules="all" style="border:1px solid #ccc;" cellpadding="10">';
  $message .= "<tr> <td>Name</td> <td>".$name."</td> </tr>";
  $message .= "<tr> <td>Email</td> <td>".$email."</td> </tr>";
  $message .= "<tr> <td>Subject</td> <td>".$subject."</td> </tr>";
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
    echo "<h2 style='text-align: center; margin-top: 100px;'>Thank you for contacting us.</h2> <h4 style='text-align: center;'> We will get back to you shortly.</h4> <h4 style='text-align: center;'><a href='index.html'>Back to Home</a></h4>";
  } else {
    // echo "Mail Failed";
    echo "<h2 style='text-align: center; margin-top: 100px;'>Error in sending message.</h2> <h4 style='text-align: center;'> Please try again later.</h4> <h4 style='text-align: center;'><a href='index.html'>Back to Home</a></h4>";
  }

}
