<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>



<?php
if (! isset($_GET['category_id']) || $_GET['category_id'] == null) {
    echo "<script>window.location='catlist.php'</script>";
} else {
    $id = $_GET['category_id'];
}
?>

<?php

$cat = new Category();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $catName = $_POST['category_name'];

    $updateCat = $cat->catUpdate($catName,$id);
}

?>


<div class="grid_10">
	<div class="box round first grid">
		<h2>Update Category</h2>
		<div class="block copyblock"> 

               <?php
               if (isset($updateCat)) {
                   echo $updateCat;
            }
            ?>
                           <?php
                        $getCat = $cat->getCategoryById($id);
                        if ($getCat) {
                            while ($result = $getCat->fetch_assoc()) {

                                ?>
               
                 <form action="" method="post">
				<table class="form">
					<tr>
						<td><input type="text" name="category_name" value="<?php echo $result['category_name']?>"
							class="medium" /></td>
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