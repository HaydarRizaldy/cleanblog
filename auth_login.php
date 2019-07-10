<?php
    session_start();
    include('config/koneksi.php');
    
    if(isset($_POST['login']))
    {
        $username = "admin";
        $password = "admin";

        if($_POST['username']==$username && $_POST['password']==$password)
        {
            $_SESSION['loggedin'] = true;
            header('location:index.php');
        }
        else 
        {
            exit('Username atau password salah');
        }
    }

    $judul    = "Login";
    $subjudul = "";
    $banner   = "assets/img/home-bg.jpg";
    
    include('header.php');
?>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
        
             <div class="col-lg-8 col-md-10 mx-auto">
                <form method="post" action="auth_login.php">
                    <?php if(isset($error)): ?>
                        <div class="alert alert-warning"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <label>Username</label>
                    <input type="text" name="username" class="form-control">
                    <br>
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                    <br>
                    <button type="submit" name="login">Login</button>
                </form>
            </div>
        </div>
    </div>

    <hr>

<?php
    include('footer.php');
?>