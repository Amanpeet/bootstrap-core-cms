<div class="sidebar-nav">

  <div class="text-start py-3 ps-3 border-bottom border-secondary">
    <a class="nav-link" href="user-profile.php?user=<?php echo $login_user; ?>"> <i class="fa fa-fw fa-circle-user"></i> <?php echo $login_user; ?> </a>
    <!-- <a class="nav-link" href="inc/logout.php"><small class="text-light"> <i class="fa fa-fw fa-caret-right"></i> Logout</small></a> -->
  </div>

  <ul class="list-unstyled mt-3 ps-3">

    <li class="py-2">
      <a class="nav-link" href="dashboard.php"> <i class="fa fa-fw fa-boxes"></i> Dashboard </a>
    </li>

    <li class="py-2">
      <a class="nav-link" href="templates.php?edit=1"> <i class="fa fa-fw fa-home"></i> Home Page </a>
    </li>

    <?php if ($admin || $editor) { ?>
      <li class="py-2">
        <a class="nav-link" href="pages.php"> <i class="fa fa-fw fa-file-alt"></i> Pages </a>
      </li>

      <li class="py-2">
        <a class="nav-link" href="blog.php"> <i class="fa fa-fw fa-newspaper"></i> Blog </a>
      </li>
    <?php } ?>

    <li class="py-2">
      <a class="nav-link" href="documents.php"> <i class="fa fa-fw fa-upload"></i> Documents </a>
    </li>

    <li class="py-2">
      <a class="nav-link" href="gallery.php"> <i class="fa fa-fw fa-image"></i> Gallery </a>
    </li>

    <hr>

    <?php if ($admin) { ?>
      <!-- <li class="py-2">
        <a class="nav-link" href="users.php"> <i class="fa fa-fw fa-users"></i> Users </a>
      </li> -->

      <!-- <li class="py-2">
        <a class="nav-link" href="editors.php"> <i class="fa fa-fw fa-user-tie"></i> Editors </a>
      </li> -->

      <li class="py-2">
        <a class="nav-link" href="admins.php"> <i class="fa fa-fw fa-user-shield"></i> Admins </a>
      </li>

      <li class="py-2">
        <a class="nav-link" href="activity.php"> <i class="fa fa-fw fa-clock"></i> Activity </a>
      </li>
    <?php } ?>
  </ul>

  <div class="text-start py-3 ps-3 border-top border-secondary">
    <small class="text-light"> Crafted by <a class="link-light" href="http://intiger.com" target="_blank" rel="noopener noreferrer">Intiger Web</a></small>
  </div>

</div>
