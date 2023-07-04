<?php include('inc/header.php'); ?>

<?php
/* IF DELETE MEMBER */
if( isset($_REQUEST['del']) ) {
  $id = $_REQUEST['del'];
  $del_user = '';
  ?>
    <div class="p-2 border-bottom">
      <h3> <strong>Delete User</strong> </h3>
      <p>Confirm deletion of Specific User.</p>
    </div>
    <div class="form-box p-2">
      <form id="id_card_form" name="id_card_form" action="" method="post">
        <?php
          $select = "SELECT * FROM users WHERE uid = '$id' AND username != 'admin' "; //save admin
          $que = mysqli_query($conn, $select);
          $fet = mysqli_fetch_array($que);
          $del_user = $fet['username'];
        ?>
        <h5>Do you really want to delete id:<strong><?php echo $fet['uid']; ?> (Name: <?php echo $del_user; ?>) </strong>from database? </h5>
        <p> Note: This action cannot be undone. </p>
        <div class="text-left">
          <input type="submit" class="btn btn-danger" name="deletemon" value="Delete">
          <a class="btn btn-dark" href="users.php">Cancel</a>
          <br><br>
        </div>
      </form>
    </div>

    <div id="response" class="h5 pt-3 text-danger">
      <?php
      if(isset($_POST['deletemon'])){
        $delete1 = "DELETE FROM users WHERE `uid` = '$id' AND `username` != 'admin' ";
        $delete2 = "DELETE FROM userdata WHERE `username` = '$del_user' AND `username` != 'admin' ";
        $quer1 = mysqli_query($conn, $delete1);
        $quer2 = mysqli_query($conn, $delete2);
        if( $quer1 && $quer2 ){
          userlog('user_delete', "Deleted user with id: $id"); //record keeping
          echo "<strong>SUCCESS: User Deleted. Redirecting back...";
          echo '<script>window.location="users.php";</script>';
        } else{
          echo "<strong>ERROR: User not deleted. Please try again later.</strong>";
        }
      }
      ?>
    </div>
    <?php

/* IF ADD MEMBER */
} elseif( isset($_REQUEST['add']) ) {
  $id = $_REQUEST['add'];
  ?>
  <div class="p-2 border-bottom">
    <h3> <strong>Add User</strong> </h3>
    <p>Write Details and Hit <strong>Add User</strong> on bottom. Some fields can't be changed later.</p>
  </div>

  <!-- Operation updatemon -->
  <div id="response" class="h5 pt-3 text-danger">
    <?php
    if(isset($_POST['addmon'])) {

      // Required field names
      $required_fields = array(
        'username',
        'password',
        'email',
        'fullname',
        'status',
      );

      // Loop over fields, check if unset or empty
      $error = false;
      foreach($required_fields as $field) {
        if ( !isset( $_POST[$field] ) || empty( $_POST[$field] ) ) {
          $error = true;
          echo "<strong> ERROR: Required fields Empty or Invalid. </strong>".$_POST[$field];
        } else {
          $trim_val = mysqli_real_escape_string($conn, $_POST[$field]);
          if ( trim($trim_val) == '' ){
            $error = true;
            echo "<strong> ERROR: Required fields cant be just spaces. </strong>";
          }
        }
      }
      if( !$error ){
        // get values
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $email    = mysqli_real_escape_string($conn, $_POST['email']);
        $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
        $status   = mysqli_real_escape_string($conn, $_POST['status']);

        $role = 'user'; //fill role if active

        //get old values
        $ex_sql = "SELECT username FROM admins WHERE (username = '$username' OR email = '$email') UNION ALL SELECT username FROM users WHERE(username = '$username' OR email = '$email') ";
        $ex_query = mysqli_query($conn, $ex_sql);
        $ex_row   = mysqli_fetch_array($ex_query);
        if( mysqli_num_rows($ex_query) > 0 ){
          echo "<strong>ERROR: Username or Email already Exists. Please try again.</strong>";
        } elseif( !preg_match('/^[a-z0-9]{4,20}$/', $username) ){ //validate username
          echo "<strong>ERROR: Username seems invalid. Please try again.</strong>";
        } else {

          // add to db
          // $insert_sql = "INSERT INTO users(`username`, `password`, `email`, `role`, `fullname`, `status` ) VALUES( '$username', MD5('$password'), '$email', '$role', '$fullname', '$status' ) ";
          $insert_sql = "INSERT INTO users(`username`, `password`, `email`, `role`, `fullname`, `status` ) VALUES( '$username', SHA2('$password',256), '$email', '$role', '$fullname', '$status' ) ";

          $insert_sql2 = "INSERT INTO userdata(`username`, `email`, `form_type`, `fullname`) VALUES( '$username', '$email', '$role', '$fullname' ) ";

          $quer = mysqli_prepare($conn, $insert_sql);
          $quer2 = mysqli_prepare($conn, $insert_sql2);

          if( $quer && $quer2 ){
            $querx = mysqli_stmt_execute($quer);
            $quer2x = mysqli_stmt_execute($quer2);

            $last = mysqli_insert_id($conn);

            userlog('user_add', "Added new user with id: $last"); //record keeping
            echo "<strong class='text-success'>SUCCESS: New User Added Successfully.</strong>";
            // echo '<script>window.location="users-single.php?view='.$last.'&added=1";</script>';
          } else {
            echo "<strong>ERROR: New User not Added. Please try again later.</strong>";
          }

        }
      }
    }
    ?>
  </div>

  <!-- add form -->
  <div class="form-box p-2">
    <form id="id_card_form" name="id_card_form" action="" method="post" enctype="multipart/form-data">
      <div class="py-2">
        <small> All fields are required. Additional fields are available in frontend. </small>
      </div>
      <table class="table table-bordered table-responsive-md">
        <tbody>
          <tr>
            <td style="width: 20%;"> <strong>Username</strong> </td>
            <td style="width: 60%;">
              <input type="text" class="form-control" name="username" required>
            </td>
            <td style="width: 20%;">
            </td>
          </tr>
          <tr>
            <td> <strong>Password</strong> </td>
            <td> <input type="text" class="form-control" name="password" required> </td>
          </tr>
          <tr>
            <td> <strong>Email</strong> </td>
            <td> <input type="email" class="form-control" name="email" required> </td>
          </tr>
          <tr>
            <td> Full Name </td>
            <td> <input type="text" class="form-control" name="fullname" required> </td>
          </tr>
          <tr>
            <td> Status </td>
            <td>
              <select name="status" class="form-control w-50" required>
                <option value="">Set Status</option>
                <option value="pending">pending</option>
                <option value="active">active</option>
              </select>
            </td>
          </tr>
        </tbody>
      </table>

      <div class="my-4">
        <input type="submit" class="btn btn-primary" name="addmon" value="ADD USER">
        <a href="users.php" class="btn btn-dark">Cancel</a> <br><br>
      </div>

    </form>
  </div>
  <?php

/* IF UPDATE MEMBER */
} elseif( isset($_REQUEST['edit']) ) {
  $id = $_REQUEST['edit'];
  ?>

  <div class="p-2 border-bottom">
    <h3> <strong>Edit User</strong> </h3>
    <p>Edit Fields and Hit <strong>UPDATE</strong> on bottom. Some fields can't be changed. Once values are updated, they cannot be reversed.</strong> </p>
  </div>

  <!-- Operation updatemon -->
  <div id="response" class="h5">
    <?php
    if(isset($_POST['updatemon'])) {

      //set field vars
      $username  = mysqli_real_escape_string($conn, $_POST['username']);
      $email     = mysqli_real_escape_string($conn, $_POST['email']);
      $pass1     = mysqli_real_escape_string($conn, $_POST['password']);
      $pass2     = mysqli_real_escape_string($conn, $_POST['password2']);

      //grab existing files
      $select1 = "SELECT * FROM users WHERE `uid` = '$id'";
      $que1 = mysqli_query($conn, $select1);
      $fet1 = mysqli_fetch_array($que1);
      $username = $fet1['username'];
      $password = $fet1['password'];
      // Confirm Password
      if( !empty($pass1) && !empty($pass2) && ($pass1 === $pass2) ) {
        //$password = md5($pass1); //deprecated
        $password = $pass1;
      }

      // $status = "active";
      $status     = mysqli_real_escape_string($conn, $_POST['status']);
      $fullname   = mysqli_real_escape_string($conn, $_POST['fullname']);
      $phone      = mysqli_real_escape_string($conn, $_POST['phone']);
      $phone2     = mysqli_real_escape_string($conn, $_POST['phone2']);
      $address    = mysqli_real_escape_string($conn, $_POST['address']);
      $pincode    = mysqli_real_escape_string($conn, $_POST['pincode']);
      $dob        = mysqli_real_escape_string($conn, $_POST['dob']);
      $gender     = mysqli_real_escape_string($conn, $_POST['gender']);
      $gender     = mysqli_real_escape_string($conn, $_POST['gender']);
      $education  = mysqli_real_escape_string($conn, $_POST['education']);
      $experience = mysqli_real_escape_string($conn, $_POST['experience']);
      $skills     = mysqli_real_escape_string($conn, $_POST['skills']);
      $website    = mysqli_real_escape_string($conn, $_POST['website']);
      $details    = mysqli_real_escape_string($conn, $_POST['details']);

      $accepted_ext = array("pdf", "docx", "doc", "PDF", "DOCX", "DOC", "jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
      $accepted_img = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");

      //grab existing files
      $select = "SELECT * FROM userdata WHERE username = '$username'";
      $que = mysqli_query($conn, $select);
      $fet = mysqli_fetch_array($que);
      $file_resume = $fet['file_resume'];
      $file_profile_pic = $fet['file_profile_pic'];
      // $file_identification = $fet['file_identification'];
      // $uniqd = $username . round(microtime(true));
      $uniqd = $username;

      //file1
      // $file_resume = '';
      $fileserr2 = false;
      if( empty($_FILES['file_resume']) ){
        // $file_resume = '';
        $fileserr2 = false;
      } elseif( ($_FILES['file_resume']['size'] == 0) ){
        // $file_resume = '';
        $fileserr2 = false;
      } else if( $_FILES['file_resume']['size'] > (1*1024*1024) ) { //1MB
        $fileserr2 = true;
      } else {
        $temp = explode(".", $_FILES["file_resume"]["name"]);
        $ext  = end($temp);
        if( in_array($ext, $accepted_ext ) == false ){
          $fileserr2 = true;
        } else {
          $newfilename = $uniqd . '_resume' . '.' . end($temp);
          $imagetmp    = trim($_FILES['file_resume']['tmp_name']);
          $path        = "../uploads/userdata/".$newfilename;
          move_uploaded_file($imagetmp, $path);
          $file_resume = $newfilename;
          $fileserr2 = false;
        }
      }

      //file2
      // $file_profile_pic = '';
      $fileserr1 = false;
      if( empty($_FILES['file_profile_pic']) ){
        // $file_profile_pic = '';
        $fileserr1 = false;
      } elseif( ($_FILES['file_profile_pic']['size'] == 0) ){
        // $file_profile_pic = '';
        $fileserr1 = false;
      } elseif( $_FILES['file_profile_pic']['size'] > (1*1024*1024) ) { //1MB
        $fileserr1 = true;
      } else {
        $temp = explode(".", $_FILES["file_profile_pic"]["name"]);
        $ext  = end($temp);
        if( in_array($ext, $accepted_img ) == false ){
          $fileserr1 = true;
        } else {
          $newfilename = $uniqd . '_pic' . '.' . end($temp);
          $imagetmp    = trim($_FILES['file_profile_pic']['tmp_name']);
          $path        = "../uploads/userdata/".$newfilename;
          move_uploaded_file($imagetmp, $path);
          $file_profile_pic = $newfilename;
          $fileserr1 = false;
        }
      }

      //no files error
      if( $fileserr1 || $fileserr2 ){
        echo "<strong class='text-danger'>ERROR: Uploaded Files are Invalid or Over allowed size of 1MB. Try again with Valid files.</strong>";
      } else {

        $main_sql = "UPDATE users SET `email` = '$email', `password` = '$password', `fullname` = '$fullname', `status` = '$status' WHERE username = '$username' ";
        $main_que = mysqli_prepare($conn, $main_sql);

        if( $main_que ){
          mysqli_stmt_execute($main_que);
          echo "<strong class='text-success'>SUCCESS: User Updated. </strong>";

          $data_sql = "UPDATE userdata SET `email` = '$email', `phone` = '$phone', `phone2` = '$phone2', `fullname` = '$fullname', `address` = '$address',  `pincode` = '$pincode', `dob` = '$dob', `gender` = '$gender', `education` = '$education', `experience` = '$experience', `skills` = '$skills', `website` = '$website', `file_resume` = '$file_resume', `file_profile_pic` = '$file_profile_pic', `details` = '$details' WHERE username = '$username' ";
          $data_que = mysqli_prepare($conn, $data_sql);
          if( $data_que ){
            mysqli_stmt_execute($data_que);
            echo "<strong class='text-success'> Userdata also Updated.</strong>";
          } else {
            echo "<strong class='text-danger'> Userdata Updation failed. </strong>";
          }

        } else {
          echo "<strong class='text-danger'> ERROR: User Updation failed. </strong>";
        }

      }

    }
    ?>
  </div>

  <!-- update form -->
  <div class="form-box p-2">
    <form id="updatemon_form" name="updatemon_form" action="" method="post" enctype="multipart/form-data">

      <?php
        $select = "SELECT * FROM users WHERE `uid` = '$id' AND username != 'admin'";
        $que = mysqli_query($conn, $select);
        $fet = mysqli_fetch_array($que);
        $datef = date('d M, Y', strtotime($fet['dated']));
        $get_user = $fet['username'];
      ?>
      <div class="row border-bottom mb-3">
        <div class="col-md-8">
          <div class="pt-2 pb-3">
            <!-- <h4><?php echo $id; ?></h4> -->
            <small class="text-muted"> Created on <?php echo $datef; ?></small><br>
            <a class="btn btn-primary" href="users-single.php?view=<?php echo $fet['uid']; ?>">View</a>
            <a class="btn btn-danger" href="users-single.php?del=<?php echo $fet['uid']; ?>">Delete</a>
          </div>
        </div>
      </div>

      <!-- form 1 table -->
      <h5><strong>Login Details</strong></h5>
      <table class="table table-bordered table-striped table-sm table-responsive-md">
        <tbody>
          <tr>
            <td style="width: 20%;"> <strong>Username</strong> </td>
            <td style="width: 60%;">
              <?php echo $fet['username']; ?>
              <input type="hidden" name="username" value="<?php echo $fet['username']; ?>">
            </td>
            <td style="width: 20%;"> </td>
          </tr>
          <tr>
            <td> New Password </td>
            <td> <input type="text" class="form-control" name="password" placeholder="set new password"> </td>
          </tr>
          <tr>
            <td> Confirm Password </td>
            <td> <input type="text" class="form-control" name="password2" placeholder="confirm password"> </td>
          </tr>
          <tr>
            <td> <strong>Email</strong> </td>
            <td> <input type="email" class="form-control" name="email" value="<?php echo $fet['email']; ?>"> </td>
          </tr>
          <tr>
            <td> Full Name </td>
            <td> <input type="tel" class="form-control" name="fullname" value="<?php echo $fet['fullname']; ?>"> </td>
          </tr>
          <tr>
            <td> Account Status </td>
            <td>
              <select name="status" class="form-select">
                <option value="<?php echo $fet['status']; ?>">Set Status</option>
                <option value="pending">pending</option>
                <option value="active">active</option>
              </select>
              <small>Current Status: <strong><?php echo $fet['status']; ?></strong></small>
            </td>
          </tr>
        </tbody>
      </table>

      <?php
        $select2 = "SELECT * FROM userdata WHERE `username` = '$get_user'";
        $que2 = mysqli_query($conn, $select2);
        $fet2 = mysqli_fetch_array($que2);
      ?>
      <h5><strong>Personal Details</strong></h5>
      <table class="table table-bordered table-striped table-sm table-responsive-md">
        <tbody>
          <tr>
            <td style="width: 20%;"> Profile Photo </td>
            <td style="width: 60%;">
              <input type="file" class="form-control" name="file_profile_pic" accept="image/*" />
              <small class="text-muted">Uploading new file will replace old file. <?php echo (!empty($fet2['file_profile_pic'])) ? ' <a href="../uploads/'.$fet2["file_profile_pic"].'" target="_blank" /> View Current File </a> ' : ''; ?> </small>
            </td>
            <td style="width: 20%;" rowspan="6" class="table-light">
              <?php echo (!empty($fet2['file_profile_pic'])) ? ' <img src="../uploads/'.$fet2["file_profile_pic"].'" alt="" />  ' : ''; ?>
            </td>
          </tr>
          <tr>
            <td> Resume / CV </td>
            <td>
              <input type="file" class="form-control" name="file_resume" accept="image/*, .pdf, .docx, .doc" />
              <small class="text-muted">Uploading new file will replace old file. <?php echo (!empty($fet2['file_resume'])) ? ' <a href="../uploads/'.$fet2["file_resume"].'" target="_blank" /> View Current File </a> ' : ''; ?> </small>
            </td>
          </tr>
          <tr>
            <td> <strong>Phone</strong> </td>
            <td> <input type="text" class="form-control" name="phone" value="<?php echo $fet2['phone']; ?>"> </td>
          </tr>
          <tr>
            <td> Phone 2 </td>
            <td> <input type="text" class="form-control" name="phone2" value="<?php echo $fet2['phone2']; ?>"> </td>
          </tr>
          <tr>
            <td> Address </td>
            <td> <input type="text" class="form-control" name="address" value="<?php echo $fet2['address']; ?>"> </td>
          </tr>
          <tr>
            <td> Pincode </td>
            <td> <input type="text" class="form-control" name="pincode" value="<?php echo $fet2['pincode']; ?>"> </td>
          </tr>
          <tr>
            <td> DOB </td>
            <td> <input type="text" class="form-control" name="dob" value="<?php echo $fet2['dob']; ?>"> </td>
          </tr>
          <tr>
            <td> Gender </td>
            <td> <input type="text" class="form-control" name="gender" value="<?php echo $fet2['gender']; ?>"> </td>
          </tr>
          <tr>
            <td> Skills </td>
            <td> <input type="text" class="form-control" name="skills" value="<?php echo $fet2['skills']; ?>"> </td>
          </tr>
          <tr>
            <td> Education </td>
            <td> <input type="text" class="form-control" name="education" value="<?php echo $fet2['education']; ?>"> </td>
          </tr>
          <tr>
            <td> Experience </td>
            <td> <input type="text" class="form-control" name="experience" value="<?php echo $fet2['experience']; ?>"> </td>
          </tr>
          <tr>
            <td> Website </td>
            <td> <input type="text" class="form-control" name="website" value="<?php echo $fet2['website']; ?>"> </td>
          </tr>
        </tbody>
      </table>

      <!-- Admin Notes -->
      <h5 class="border-top pt-4 mt-4"><strong>Details</strong> </h5>
      <table class="table table-bordered table-striped table-sm">
        <tbody>
          <tr>
            <!-- <td> </td> -->
            <td> <textarea class="form-control" name="details"><?php echo $fet2['details']; ?></textarea> <small>Extra notes or information</small> </td>
          </tr>
        </tbody>
      </table>

      <div class="my-4">
        <input type="submit" class="btn btn-primary btn-lg" name="updatemon" value="UPDATE">
        <a href="users.php" class="btn btn-dark">Cancel</a> <br><br>
      </div>

    </form>
  </div>

  <?php

/* IF VIEW MEMBER */
} elseif( isset($_REQUEST['view']) ) {
  $id = $_REQUEST['view'];
  ?>
      <!-- SHOW ALL ITEMS HERE -->
      <div class="p-2 border-bottom">
        <h3> <strong>View User</strong> </h3>
        <p>Viewing individual User details. Click <strong>Edit</strong> on right to modify details.</p>
      </div>

      <!-- response for updatemon -->
      <div class="pt-2 pl-2 h5 text-success">
        <?php
        if( isset($_REQUEST['updated']) ) {
          echo "<strong>SUCCESS: User Details Updated Successfully.</strong>";
        } elseif( isset($_REQUEST['added']) ) {
          echo "<strong>SUCCESS: New User Added Successfully.</strong>";
        }
        ?>
      </div>

      <?php
        $select = "SELECT * FROM users WHERE `uid` = '$id' AND username != 'admin'";
        $que = mysqli_query($conn, $select);
        $fet = mysqli_fetch_array($que);
        $datef = date('d M, Y', strtotime($fet['dated']));
        $get_user = $fet['username'];
      ?>
      <div class="row border-bottom mb-3">
        <div class="col-md-8">
          <div class="pt-2 pb-3">
            <small class="text-muted"> Created on <?php echo $datef; ?></small><br>
            <a class="btn btn-primary" href="users-single.php?edit=<?php echo $fet['uid']; ?>">Edit this</a>
            <a class="btn btn-danger" href="users-single.php?del=<?php echo $fet['uid']; ?>">Delete</a>
          </div>
        </div>
      </div>

      <!-- form 1 table -->
      <h5><strong>Login Details</strong></h5>
      <table class="table table-bordered table-striped table-sm table-responsive-md">
        <tbody>
          <tr>
            <td style="width: 20%;"> <strong>Username</strong> </td>
            <td style="width: 60%;"> <?php echo $fet['username']; ?> </td>
            <td style="width: 20%;"> </td>
          </tr>
          <tr>
            <td> <strong>Email</strong> </td>
            <td> <?php echo $fet['email']; ?> </td>
          </tr>
          <tr>
            <td> <strong>Full Name</strong> </td>
            <td> <?php echo $fet['fullname']; ?> </td>
          </tr>
          <tr>
            <td> Account Status </td>
            <td> <?php echo $fet['status']; ?> </td>
          </tr>
        </tbody>
      </table>

      <?php
        $select2 = "SELECT * FROM userdata WHERE `username` = '$get_user'";
        $que2 = mysqli_query($conn, $select2);
        $fet2 = mysqli_fetch_array($que2);
      ?>
      <h5><strong>Personal Details</strong></h5>
      <table class="table table-bordered table-striped table-sm table-responsive-md">
        <tbody>
          <tr>
            <td style="width: 20%;"> Profile Photo </td>
            <td style="width: 60%;">
              <?php echo (!empty($fet2['file_profile_pic'])) ? ' <a href="../uploads/'.$fet2["file_profile_pic"].'" target="_blank" /> View Photo </a> ' : ''; ?>
            </td>
            <td style="width: 20%;" rowspan="6" class="table-light">
              <?php echo (!empty($fet2['file_profile_pic'])) ? ' <img src="../uploads/'.$fet2["file_profile_pic"].'" alt="" />  ' : ''; ?>
            </td>
          </tr>
          <tr>
            <td> Resume / CV </td>
            <td>
              <?php echo (!empty($fet2['file_resume'])) ? ' <a href="../uploads/'.$fet2["file_resume"].'" target="_blank" /> View File </a> ' : ''; ?>
            </td>
          </tr>
          <tr>
            <td> Phone </td>
            <td> <?php echo $fet2['phone']; ?> </td>
          </tr>
          <tr>
            <td> Phone 2 </td>
            <td> <?php echo $fet2['phone2']; ?> </td>
          </tr>
          <tr>
            <td> Address </td>
            <td> <?php echo $fet2['address']; ?> </td>
          </tr>
          <tr>
            <td> Pincode </td>
            <td> <?php echo $fet2['pincode']; ?> </td>
          </tr>
          <tr>
            <td> DOB </td>
            <td> <?php echo $fet2['dob']; ?> </td>
          </tr>
          <tr>
            <td> Gender </td>
            <td> <?php echo $fet2['gender']; ?> </td>
          </tr>
          <tr>
            <td style="width: 20%;"> Skills </td>
            <td style="width: 60%;"> <?php echo $fet2['skills']; ?> </td>
            <td style="width: 20%;"> </td>
          </tr>
          <tr>
            <td> <strong>Education</strong> </td>
            <td> <?php echo $fet2['education']; ?> </td>
          </tr>
          <tr>
            <td> <strong>Experience</strong> </td>
            <td> <?php echo $fet2['experience']; ?> </td>
          </tr>
          <tr>
            <td> Website </td>
            <td> <a href="<?php echo $fet2['website']; ?>" target="_blank"><?php echo $fet2['website']; ?></a> </td>
          </tr>
          <tr>
            <td> Details </td>
            <td>  <?php echo $fet2['details']; ?> </td>
          </tr>
        </tbody>
      </table>

      <!-- Admin Notes -->
      <h5 class="mt-4"><strong>Details</strong> </h5>
      <table class="table table-bordered table-striped table-sm">
        <tbody>
          <tr>
            <td style="width: 20%;"> <strong>Activity</strong> </td>
            <td style="width: 80%;"> <strong>Count</strong> </td>
          </tr>
          <?php
          $activity_sql = "SELECT COUNT(*) as `count`, `action_term` FROM userlog WHERE `user_name` = '$get_user' GROUP BY action_term ";
          $activity_res = mysqli_query($conn, $activity_sql);
          while($activity_row = mysqli_fetch_array($activity_res)){
            $datef = date('d M, Y', strtotime($fet['dated']));
            ?>
            <tr>
              <td> <?php echo $activity_row['action_term']; ?> </td>
              <td> <?php echo $activity_row['count']; ?> </td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>

  <?php

/* ELSE SHOW ERROR */
} else {
  ?>
  <div class="p-3 border-bottom">
    <h3> <strong>Data not found</strong> </h3>
    <p>No Data found via given id. Please go back and try again.</p>
  </div>
  <?php
} //if else end
?>

<!-- include header -->
<?php include('inc/footer.php'); ?>