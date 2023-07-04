<?php include('inc/header.php'); ?>

<!-- page title -->
<div class="p-3 border-bottom">
  <h3> <strong>Welcome <?php echo $login_role; ?> </strong> </h3>
  <p>Click on <strong>Links</strong> in left sidebar to perform actions.</p>
</div>

<div class="m-3">
  <div class="row g-4 text-center">

    <div class="col-md-3">
      <div class="card bg-light mb-3 h-100">
        <div class="card-body">
          <a href="templates.php?edit=1"><h5 class="card-title mt-4"> <i class="fa fa-fw fa-home"></i> Home Page </h5></a>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card bg-light mb-3 h-100">
        <div class="card-body">
          <a href="pages.php"><h5 class="card-title mt-4"> <i class="fa fa-fw fa-file-alt"></i> Edit Pages </h5></a>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card bg-light mb-3 h-100">
        <div class="card-body">
          <a href="documents.php"><h5 class="card-title mt-4"> <i class="fa fa-fw fa-upload"></i> Documents </h5></a>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card bg-light mb-3 h-100">
        <div class="card-body">
          <a href="blog.php"><h5 class="card-title mt-4"> <i class="fa fa-fw fa-newspaper"></i> Blog </h5></a>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card bg-light mb-3 h-100">
        <div class="card-body">
          <a href="gallery.php"><h5 class="card-title mt-4"> <i class="fa fa-fw fa-image"></i> Gallery </h5></a>
        </div>
      </div>
    </div>

  </div>

  <h4 class="mt-5 d-none">Users</h4>
  <div class="row g-4 text-center d-none">

    <div class="col-md-3">
      <div class="card bg-light mb-3 h-100">
        <div class="card-body">
          <a href="admins.php"><h5 class="card-title mt-4"> <i class="fa fa-fw fa-user-shield"></i> Admins </h5></a>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card bg-light mb-3 h-100">
        <div class="card-body">
          <a href="editors.php"><h5 class="card-title mt-4"> <i class="fa fa-fw fa-user-tie"></i> Editors </h5></a>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card bg-light mb-3 h-100">
        <div class="card-body">
          <a href="users.php"><h5 class="card-title mt-4"> <i class="fa fa-fw fa-users"></i> Users </h5></a>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- include header -->
<?php include('inc/footer.php'); ?>