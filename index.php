<?php
include_once("backend/inc/connection.php");

// get essentials
$page_sql = "SELECT * FROM templates WHERE `pid` = '1' LIMIT 1 ";
$page_query = mysqli_query($conn, $page_sql);
$post = mysqli_fetch_assoc($page_query);

if( !empty($post) ){
  // echo $post['page_media'];
  $title       = $post['page_title'];
  $description = $post['page_description'];
  $keywords    = $post['page_keywords'];
  // $image       = $site_url ."/uploads/pages/". $post['page_image'];
} else {
  // echo "post not found";
  $title = "Page not Found";
  $description = "Page not found";
  $keywords    = "Page not found";
  // $image       = "";
  echo "Template Data not Found. ";
  exit;
}

// header
include('header.php');
?>

<div class="site-section hero-slider p-0">
  <div class="container-fluidxx">

    <div id="carouselHeroSlider" class="carousel slide carousel-dark carousel-fadexx" data-bs-ride="false">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselHeroSlider" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselHeroSlider" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselHeroSlider" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="img/slide1.jpg" class="d-block w-100" alt="">
          <div class="carousel-caption">
            <div class="container">
              <h4>Organization</h4>
              <h2>Ideas</h2>
              <p>Whether it is a matter of furniture, facades or interior fittings, Organization is always to be found.</p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <img src="img/slide2.jpg" class="d-block w-100" alt="">
          <div class="carousel-caption">
            <div class="container">
              <h4>Organization</h4>
              <h2>Ideas</h2>
              <p>Whether it is a matter of furniture, facades or interior fittings, Organization is always to be found.</p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <img src="img/slide3.jpg" class="d-block w-100" alt="">
          <div class="carousel-caption">
            <div class="container">
              <h4>Organization</h4>
              <h2>Ideas</h2>
              <p>Whether it is a matter of furniture, facades or interior fittings, Organization is always to be found.</p>
            </div>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselHeroSlider" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselHeroSlider" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

  </div>
</div>

<div class="site-section big-banner bg-white border-top pb-0">
  <div class="container">
    <div class="row g-0">
      <div class="col-lg-6">
        <h1 class="ultra-title mt-lg-5"> The Algorithm </h1>
        <p class="lead me-lg-5"> Once upon a time, in a small tech startup, there was an ambitious team of programmers working tirelessly to develop a groundbreaking artificial intelligence algorithm. Their creation, known as "AI-13," was designed to revolutionize the way data analysis was performed. However, little did they know that they were about to unleash a technological nightmare. </p>
      </div>

      <div class="col-lg">
        <div class="card dark-card alt">
          <a href="#" target="_blank">
            <img src="img/img1.jpg" class="d-block" alt="">
            <div class="card-img-overlay px-4 pt-4">
              <h3 class="card-title text-white">Heading One</h3>
            </div>
          </a>
        </div>
      </div>

      <div class="col-lg">
        <div class="card dark-card">
          <a href="#" target="_blank">
            <img src="img/img2.jpg" class="d-block" alt="">
            <div class="card-img-overlay px-4 pt-5">
              <h3 class="card-title text-white">Heading Two</h3>
            </div>
          </a>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="site-section bg-black text-white py-5 margin-minusx">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-5 me-auto">
        <h3 class="text-white"><strong>Ready to get started?</strong></h3>
        <p>With us, you can select the right solution for your problems and needs in no time at all.</p>
        <a href="<?php echo $site_url; ?>/contact-us.php" class="btn btn-light">Get in Touch</a>
      </div>
      <div class="col-lg-5 ms-auto">
        <!-- <form action="response.phpxx" method="post" class="form-subscribe d-flex">
          <input type="email" class="form-control me-2" name="sub_email" placeholder="youremail@mail.com" required>
          <input type="submit" class="btn btn-light" name="sub_submit" value="SUBMIT">
        </form> -->
      </div>
    </div>
  </div>
</div>

<div class="site-section bg-light border-top">
  <div class="container">
    <div class="section-title text-center pb-4">
      <h2 class="h1"><strong>Services</strong></h2>
      <p class="lead">Delighting customers through its esteemed partners with Exceptional Services. </p>
    </div>
    <div class="row g-5">

      <div class="col-lg-4">
        <div class="card card-body shadow-card">
          <div class="card-icon mb-4">
            <span> <i class="fa fa-star fa-3x"></i> </span>
          </div>
          <div class="card-content">
            <h4> Service One </h4>
            <p class="text-muted"> Web resources may be any type of downloadable media. Web pages are documents interconnected by hypertext links formatted in Hypertext Markup Language. The HTML syntax displays embedded hyperlinks with URLs, which permits users to navigate.  </p>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card card-body shadow-card">
          <div class="card-icon mb-4">
            <span> <i class="fa fa-home fa-3x"></i> </span>
          </div>
          <div class="card-content">
            <h4> Service Two </h4>
            <p class="text-muted">In addition to text, web pages may contain references to images, video, audio, and software components, which are either displayed or internally executed in the user's web browser to render pages or streams of multimedia content. </p>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card card-body shadow-card">
          <div class="card-icon mb-4">
            <span> <i class="fa fa-car fa-3x"></i> </span>
          </div>
          <div class="card-content">
            <h4> Service Three </h4>
            <p class="text-muted">Web resources may be any type of downloadable media. Web pages are documents interconnected by hypertext links formatted in Hypertext Markup Language. The HTML syntax displays embedded hyperlinks with URLs, which permits users to navigate.  </p>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="site-section bg-white border-top">
  <div class="container">
    <div class="text-center pb-4">
      <h2 class="h1 font-strong">Gallery</h2>
      <p class="lead">Check our featured images </p>
    </div>
    <div class="row g-4">

      <?php
        //Get latest gallery images
        $gal_sql = "SELECT * FROM `gallery` WHERE gal_featured = '1' ORDER BY `gid` DESC LIMIT 4";
        $gal_query = mysqli_query($conn, $gal_sql);
        if ($gal_query){
          while($gal_row = mysqli_fetch_array($gal_query)) {
            $post_img = (!empty($gal_row['gal_image'])) ? $gal_row['gal_image'] : 'default.jpg';
            ?>
            <div class="col-md-4 col-lg-3">
              <a class="gallery-item" href="<?php echo $site_url."/uploads/gallery/". $post_img ?>" data-fancybox="gallery">
                <img class="img-thumbnail cover-img" src="<?php echo $site_url."/uploads/gallery/". $post_img ?>" alt="<?php echo $gal_row['gal_tags']; ?>">
              </a>
              <!-- <small><strong><?php echo $gal_row['gal_caption']; ?></strong></small> -->
            </div>
            <?php
          }
        } else {
          echo "No Posts Found!";
        }
      ?>

    </div>
    <div class="text-center mt-4">
      <a href="<?php echo $site_url; ?>/gallery.php" class="btn btn-dark">View More</a>
    </div>
  </div>
</div>

<div class="site-section bg-black border-topx">
  <div class="container">
    <div class="section-title text-white text-center pb-4">
      <h2 class="h1"><strong> Haunted Code </strong></h2>
      <!-- <p class="lead">Delighting customers through its esteemed partners with Exceptional Services. </p> -->
    </div>
    <div class="row">

      <div class="col-lg-12">
        <div class="bigp text-white">
          <?php echo $post['page_data_one']; ?> <br><br>
          <?php echo $post['page_data_two']; ?> <br><br>
          <?php echo $post['page_data_three']; ?> <br><br>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="site-section bg-white border-top">
  <div class="container">
    <div class="row">

      <div class="col-lg-4 pe-lg-5">
        <!-- <img src="img/default.jpg" class="img-thumbnail" alt=""> -->
        <?php if(!empty($post['page_sideimg'])){ ?>
          <div class="side-image mb-4">
            <img class="w-100" src="<?php echo $site_url; ?>/uploads/pages/<?php echo $post['page_sideimg']; ?>" alt="">
          </div>
        <?php } ?>
      </div>

      <div class="col-lg">
        <!-- <div class="section-title">
          <h2 class="h1 font-strong"> About us </h2>
        </div> -->
        <div class="bigp mb-4">
          <?php echo $post['page_content']; ?>
        </div>
        <a href="<?php echo $site_url; ?>/about-us/" class="btn btn-dark">Know More</a>
      </div>

    </div>
  </div>
</div>

<div class="site-section bg-light border-top">
  <div class="container">
    <div class="text-center pb-4">
      <h2 class="h1"><strong>Blog</strong></h2>
      <p class="lead">Recent News &amp; Events </p>
    </div>
    <div class="row g-5">

      <?php
        //Get latest blogs
        $items_per_page = 3;
        $blog_sql = "SELECT * FROM `blog` ORDER BY `bid` DESC LIMIT $items_per_page";
        $blog_query = mysqli_query($conn, $blog_sql);
        if ($blog_query){
          while($blog_row = mysqli_fetch_array($blog_query)) {
            $post_img = (!empty($blog_row['blog_image'])) ? $blog_row['blog_image'] : 'default.jpg';
            ?>
            <div class="col-md-6 col-lg-4 mb-4">
              <div class="card shadow-card blog-item">
                <a href="blog-single.php?post=<?php echo $blog_row['bid']; ?>" class="img-link">
                  <img class="card-img-top" src="uploads/blog/<?php echo $post_img; ?>" alt="<?php echo $blog_row['blog_title']; ?>" loading="lazy">
                </a>
                <div class="card-body">
                  <h5 class="card-title"> <a class="link" href="blog-single.php?post=<?php echo $blog_row['bid']; ?>"><?php echo $blog_row['blog_title']; ?></a> </h5>
                  <div class="card-text text-muted"> <?php echo strip_tags( substr( $blog_row['blog_content'], 0, 60 ) ) . '...'; ?> </div>
                </div>
              </div>
            </div>
            <?php
          }
        } else {
          echo "No Posts Found!";
        }
      ?>
      <!-- <div class="col-md-6 mb-4 mb-lg-0 col-lg-4">
        <div class="blog-entry">
          <a href="#" class="img-link">
            <img src="img/default.jpg" alt="" class="img-fluid">
          </a>
          <div class="blog-entry-contents">
            <h3><a href="#">Top Companies That Are Best In Pharmaceutical Business</a></h3>
            <div class="meta"> Lorem, ipsum dolor sit amet consectetur adipisicing elit. </div>
          </div>
        </div>
      </div> -->

    </div>
    <div class="text-center mt-4">
      <a href="<?php echo $site_url; ?>/blog.php" class="btn btn-dark">View More</a>
    </div>
  </div>
</div>

<div class="site-section bg-black text-white py-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-5 me-auto">
        <h3 class="text-white"><strong>Get in Touch</strong></h3>
        <p>Just leave us your email here & we will get back to you as soon as possible. </p>
      </div>
      <div class="col-lg-5 ms-auto">
        <form action="contact-us.php" method="get" class="form-subscribe d-flex">
          <input type="email" class="form-control me-2" name="sub_email" placeholder="youremail@mail.com" required>
          <input type="submit" class="btn btn-light" name="sub_submit" value="SUBMIT">
        </form>
      </div>
    </div>
  </div>
</div>

<!-- footer -->
<?php include('footer.php'); ?>
