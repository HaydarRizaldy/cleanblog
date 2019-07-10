<?php 
if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
echo "<h1>Untuk mengakses modul, and harus login terlebih dahulu.</h1>
<p><a href='index.php'>LOGIN</a></p>";
}

else {

	$aksi = "module/mod_users/action.php";

	// Mengatasi variabel yang belum di definisikan (notice undefined index)
	$act = isset($_GET['act']) ? $_GET['act'] : '';

	switch($act) {
		// Tampil Users

		default: ?>

        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="media.php?module=home">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Users</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Data Categories</div>
          <div class="card-body">
            <div class="table-responsive">
             <a class="btn btn-primary" href="?module=users&act=tambah">Add User</a><br><br>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Full Name</th>
                    <th>E-mail</th>
                    <th>level</th>
                    <th>Block</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Full Name</th>
                    <th>E-mail</th>
                    <th>level</th>
                    <th>Block</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>

                <?php
                $query = "SELECT * FROM users ORDER BY username DESC";
                $hasil = mysqli_query($con,$query);
                $tampil = mysqli_fetch_all($hasil, MYSQLI_ASSOC);

                $no = 1;
                foreach($tampil as $r) :?>

                    <tr><td><?php echo $no; ?></td>
                        <td><?php echo $r['username']; ?></td>
                        <td><?php echo $r['nama_lengkap']; ?></td>
                        <td><?php echo $r['email']; ?></td>
                        <td><?php echo $r['level']; ?></td>
                        <td><?php echo $r['blokir']; ?></td>
                        <td><a href="?module=users&act=edit&id=
                          <?php echo $r['username']; ?>" class="btn btn-warning">EDIT</a></td>
                    </tr>
                <?php
                  $no++;
                endforeach; ?>

                </tbody>
              </table>
            </div>
          </div>
          
        </div>
        
        <?php break;

        // Add Category

        case "tambah":?>
        	
        	<ol class="breadcrumb">
          		<li class="breadcrumb-item">
           			<a href="media.php?module=home">Dashboard</a>
         		</li>
         		<li class="breadcrumb-item active">Add User</li>
        	</ol>

            <div class="card mb-3">
          		<div class="card-header">
            		<i class="fas fa-table"></i> Form
            	</div>
          		<div class="card-body">

		          	<form method="POST" action="<?php echo $aksi . '?module=users&act=input'; ?>"> 
		        			<div class="form-group">
		        				<label for="name">Username</label>
		        				<input name="name" type="text" class="form-control" id="name"
		        					placeholder="Username">
		        			</div>
		        			<div class="form-group">
		        				<input type="submit" class="btn btn-success" value="Save">
		        				<input type="button" class="btn btn-danger" value="Cancel" onclick="self.history.back()">
		        			</div>
		        	</form>
        		</div>
        	</div>
        <?php
        break;


        // Edit User

        case "edit":
        	$query = "SELECT * FROM users WHERE id='$_GET[id]'";
        	$hasil = mysqli_query($con,$query);
        	$r     = mysqli_fetch_assoc($hasil);
          ?>

        	<ol class="breadcrumb">
          		<li class="breadcrumb-item">
           			<a href="media.php?module=home">Dashboard</a>
         		</li>
         		<li class="breadcrumb-item active">Edit User</li>
        	</ol>

            <div class="card mb-3">
          		<div class="card-header">
            		<i class="fas fa-table"></i> Form
            	</div>
          		<div class="card-body">

		          	<form method="POST" action="$aksi?module=users&act=update">
		          		<input type="hidden" name="id" value="$r[id]">
		        			<div class="form-group">
		        				<label for="name">Username</label>
		        				<input name="name" type="text" value="$r[title]" class="form-control" id="title"
		        					placeholder="Username">
		        			</div>

		        			<label for="active">Active:</label>

		        <?php
            if ($r['active']=="Yes"){ ?>
		        	<div class="form-check">
  								<input class="form-check-input" type="radio" name="active" value="Yes" checked>
  										<label class="form-check-label" for="exampleRadios1">
   											Yes
  										</label>
							</div>
							<div class="form-check">
  								<input class="form-check-input" type="radio" name="active"  value="No">
 						 				<label class="form-check-label" for="exampleRadios2">
    										No
  										</label>
							</div>
		        <?php
            }

		        else { ?>
		        	<div class="form-check">
  								<input class="form-check-input" type="radio" name="active" value="Yes" >
  										<label class="form-check-label" for="exampleRadios1">
   											Yes
  										</label>
							</div>
							<div class="form-check">
  								<input class="form-check-input" type="radio" name="active"  value="No" checked>
 						 				<label class="form-check-label" for="exampleRadios2">
    										No
  										</label>
							</div>
		        
            <?php
            }
            ?>
		        	<br><div class="form-group">
		        				<input type="submit" class="btn btn-success" value="Update">
		        				<input type="button" class="btn btn-danger" value="Cancel" onclick="self.history.back()">
		        			</div>
		        			
		        	</form>
        		</div>
        	</div>
        <?php 
        break;
    }   
}
?>