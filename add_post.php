<?php
    session_start();
    include('config/koneksi.php');

    if(! isset($_SESSION['loggedin']))
        exit('Access Forbidden');
    
    if(isset($_POST['submit']))
    {
        $judul  = $_POST['judul'];
        $konten = $_POST['konten'];
        $intro  = $_POST['intro'];
        $date_created = date("Y-m-d H:i:s");

        $query = mysqli_query($con,"INSERT INTO tblog (judul,konten,intro,date_created) VALUES('$judul','$konten','$intro','$date_created')");

        if($query)
        {
            header('location:index.php');
        }
        else 
        {
            $error = "Error : " . msyqli_error($con);
        }
    }
    $judul    = "Form Tambah Artikel";
    $subjudul = "";
    $banner   = "assets/img/home-bg.jpg";
    include('header.php');
?>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
        
            <div class="col-lg-8 col-md-10 mx-auto">
                <form method="post" action="add_post.php">
                    <?php if(isset($error)): ?>
                        <div class="alert alert-warning"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <label>Judul Artikel</label>
                    <input type="text" name="judul" class="form-control">
                    <br>
                    <label>Intro Artikel</label>
                    <textarea name="intro" class="form-control"></textarea>
                    <br>
                    <label>Konten Artikel</label>
                    <textarea name="konten" class="form-control"></textarea>
                    <br>
                    <button type="submit" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <hr>

<?php
    include('footer.php');
?>