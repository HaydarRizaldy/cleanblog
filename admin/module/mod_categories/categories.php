<?php 

if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
echo "<h1>Untuk mengakses modul, and harus login terlebih dahulu.</h1>
<p><a href='index.php'>LOGIN</a></p>";
}

else{

	$aksi = "module/mod_categories/action.php";

	// Mengatasi variabel yang belum di definisikan (notice undefined index)
	$act = isset($_GET['act']) ? $_GET['act'] : '';

	switch($act){
		// Tampil Kategori

		default:

		echo "
        <ol class='breadcrumb'>
          <li class='breadcrumb-item'>
            <a href='media.php?module=home'>Dashboard</a>
          </li>
          <li class='breadcrumb-item active'>Categories</li>
        </ol>

        <!-- DataTables Example -->
        <div class='card mb-3'>
          <div class='card-header'>
            <i class='fas fa-table'></i>
            Data Categories</div>
          <div class='card-body'>
            <div class='table-responsive'>
             <a class='btn btn-primary' href='?module=categories&act=tambah'>Add Category</a><br><br>
              <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Link</th>
                    <th>Active</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Link</th>
                    <th>Active</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>";

                $query = "SELECT * FROM categories ORDER BY id DESC";
                $hasil = mysqli_query($con,$query);
                $tampil = mysqli_fetch_all($hasil, MYSQLI_ASSOC);

                $no = 1;
                foreach($tampil as $r) :

                    echo "<tr><td>$no</td>
                      <td>$r[title]</td>
                      <td>categories-$r[id]-$r[seotitle]</td>
                      <td>$r[active]</td>
                      <td><a href='?module=categories&act=edit&id=$r[id]' class='btn btn-warning'>EDIT</a></td>
                      </tr>";
                    $no++;
                endforeach;



                echo "
                </tbody>
              </table>
            </div>
          </div>
          
        </div>";
        break;

        // Add Category

        case "tambah";
        	echo "
        	<ol class='breadcrumb'>
          		<li class='breadcrumb-item'>
           			<a href='media.php?module=home'>Dashboard</a>
         		</li>
         		<li class='breadcrumb-item active'>Add Category</li>
        	</ol>

            <div class='card mb-3'>
          		<div class='card-header'>
            		<i class='fas fa-table'></i> Form
            	</div>
          		<div class='card-body'>

		          	<form method='POST' action='$aksi?module=categories&act=input'> 
		        			<div class='form-group'>
		        				<label for='name'>Category Name</label>
		        				<input name='name' type='text' class='form-control' id='name'
		        					placeholder='Category Name'>
		        			</div>
		        			<div class='form-group'>
		        				<input type='submit' class='btn btn-success' value='Save'>
		        				<input type='button' class='btn btn-danger' value='Cancel' onclick='self.history.back()'>
		        			</div>
		        	</form>
        		</div>
        	</div>";
        break;

        // Edit Category

        case "edit";
        	$query = "SELECT * FROM categories WHERE id='$_GET[id]'";
        	$hasil = mysqli_query($con,$query);
        	$r     = mysqli_fetch_assoc($hasil);

        	echo "
        	<ol class='breadcrumb'>
          		<li class='breadcrumb-item'>
           			<a href='media.php?module=home'>Dashboard</a>
         		</li>
         		<li class='breadcrumb-item active'>Edit Category</li>
        	</ol>

            <div class='card mb-3'>
          		<div class='card-header'>
            		<i class='fas fa-table'></i> Form
            	</div>
          		<div class='card-body'>

		          	<form method='POST' action='$aksi?module=categories&act=update'>
		          		<input type='hidden' name='id' value='$r[id]'>
		        			<div class='form-group'>
		        				<label for='name'>Category Name</label>
		        				<input name='name' type='text' value='$r[title]' class='form-control' id='title'
		        					placeholder='Category Name'>
		        			</div>

		        			<label for'active'>Active:</label>";

		        if ($r['active']=='Yes'){
		        	echo   "<div class='form-check'>
  								<input class='form-check-input' type='radio' name='active' value='Yes' checked>
  										<label class='form-check-label' for='exampleRadios1'>
   											Yes
  										</label>
							</div>
							<div class='form-check'>
  								<input class='form-check-input' type='radio' name='active'  value='No'>
 						 				<label class='form-check-label' for='exampleRadios2'>
    										No
  										</label>
							</div>";
		        }

		        else {
		        	echo   "<div class='form-check'>
  								<input class='form-check-input' type='radio' name='active' value='Yes' >
  										<label class='form-check-label' for='exampleRadios1'>
   											Yes
  										</label>
							</div>
							<div class='form-check'>
  								<input class='form-check-input' type='radio' name='active'  value='No' checked>
 						 				<label class='form-check-label' for='exampleRadios2'>
    										No
  										</label>
							</div>";
		        }

		        	echo   "<br><div class='form-group'>
		        				<input type='submit' class='btn btn-success' value='Update'>
		        				<input type='button' class='btn btn-danger' value='Cancel' onclick='self.history.back()'>
		        			</div>
		        			
		        	</form>
        		</div>
        	</div>";
        break;




     }   



}

?>