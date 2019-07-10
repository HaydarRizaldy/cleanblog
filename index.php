<?php
    include ('config/koneksi.php');

    $query    = "SELECT * FROM cleanblog ORDER BY date DESC";
    $hasil    = mysqli_query($con,$query);
    $posts    = mysqli_fetch_all($hasil, MYSQLI_ASSOC);

    $judul    = "My Personal Blog";
    $subjudul = "Belajar Membuat Blog Sederhana";
    $banner   = "assets/img/home-bg.jpg";

    include ('header.php');
?>  

<!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        
        <?php foreach($posts as $post) : ?>
        <div class="post-preview">
          <a href="post.php?id=<?php echo $post['id'];?>">
            <h2 class="post-title">
              <?php echo $post['judul'];?>
            </h2>
          </a>
          <p><?php if(empty($post['intro']))
          {
            echo substr($post['konten'],0,350).'...';
          }
          else
          {
            echo $post['intro'];
          }
            ?>
          </p>
          <p class="post-meta">Posted on <?php echo date("d F Y H:i:s", strtotime($post['date']));?>
          </p>
        </div>
        <hr>
      <?php endforeach; ?>
      </div>
    </div>
  </div>

  <hr>

<?php
  include('footer.php');
?>
