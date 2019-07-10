<?php
    session_start();
    include('config/koneksi.php');

    if(! isset($_SESSION['loggedin']))
        exit('Access Forbidden');

    $id = $_GET['id'];

    $query = mysqli_query($con, "SELECT * FROM tblog WHERE id='$id'");
    $post = mysqli_fetch_assoc($query);

    
    if(isset($_POST['update'])){
        $judul = $_POST['judul'];
        $konten = $_POST['konten'];
        $intro = $_POST['intro'];
        // $date_created = date("Y-m-d H:i:s");

        $query = mysqli_query($con,"UPDATE tblog SET judul  ='$judul', 
                                                     konten ='$konten',
                                                     intro  ='$intro' 
                                                                        WHERE id   ='$id'");

        if($query){
            header('location:index.php');
        }
        else {
            $error = "Error : " . msyqli_error($con);
        }
    }
    $judul = "Form Edit Artikel";
    $subjudul = "";
    $banner = "assets/img/home-bg.jpg";
    include('header.php');
?>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
        
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <form method="post" action="edit_post.php?id=<?php echo $id; ?>">
                    <?php if(isset($error)): ?>
                        <div class="alert alert-warning"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <label>Judul Artikel</label>
                    <input type="text" name="judul" class="form-control" value="<?php echo $post['judul'];?>">
                    <br>
                    <label>Intro Artikel</label>
                    <textarea name="intro" class="form-control"><?php echo $post['intro'];?></textarea>
                    <br>
                    <label>Konten Artikel</label>
                    <textarea name="konten" class="form-control"><?php echo $post['konten'];?></textarea>
                    <br>
                    <button type="submit" name="update">Update</button>
                </form>
            </div>
        </div>
    </div>

    <hr>

<?php
    include('footer.php');
?>