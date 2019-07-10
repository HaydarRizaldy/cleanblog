<?php
  include('config/koneksi.php');

  $id     = $_GET['id'];
  $query  = mysqli_query($con,"SELECT * FROM cleanblog WHERE id='$id'");
  $post   = mysqli_fetch_assoc($query);

  $judul    = $post['judul'];
  $subjudul = "";
  $banner = "assets/img/post-bg.jpg";
  include ('header.php');
?>

  <!-- Post Content -->
  <article>
    <div class="container">
      <div class="row">
         <div class="col-lg-8 col-md-10 mx-auto">
          <?php echo nl2br($post['konten']); ?>
        </div>
      </div>
    </div>
  </article>

  <hr>

<?php 
  include('footer.php');
?>