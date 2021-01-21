<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>



<?php
if (! isset($_GET['brand_id']) || $_GET['brand_id'] == null) {
    echo "<script>window.location='brandlist.php'</script>";
} else {
    $id = $_GET['brand_id'];
}
?>

<?php

$brand = new brand();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brand_name = $_POST['brand_name'];

    $updateBrand = $brand->updateBrand($brand_name, $id);
}

?>


<div class="grid_10">
	<div class="box round first grid">
		<h2>Update Brand</h2>
		<div class="block copyblock"> 

               <?php
            if (isset($updateBrand)) {
                echo $updateBrand;
            }
            ?>
                           <?php
                        $getBrand = $brand->getBrandById($id);
                        if ($getBrand) {
                            while ($result = $getBrand->fetch_assoc()) {

                                ?>
               
                 <form action="" method="post">
				<table class="form">
					<tr>
						<td>
						<input type="text" name="brand_name" value="<?php echo $result['brand_name']?>" class="medium" />
					
						</td>
					</tr>
					<tr>
						<td><input type="submit" name="submit" Value="UPDATE" /></td>
					</tr>
				</table>
			</form>
			<?php
                            }
                        }
                        ?>
		</div>
	</div>
</div>
<?php include 'inc/footer.php';?>