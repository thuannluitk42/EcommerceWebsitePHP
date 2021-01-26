<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/product.php';?>


<?php
if (! isset($_GET['product_id']) || $_GET['product_id'] == null) {
    echo "<script>window.location='product.php'</script>";
} else {
    $id = $_GET['product_id'];
}

$product = new product();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $updateProduct = $product->updateProduct($_POST, $_FILES, $id);
}

?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Add New Product</h2>
		<div class="block">
		
			<?php
    		if (isset($updateProduct)) {
    		    echo $updateProduct;
                }
            ?>
            <?php 
            $get_product = $product->getProductById($id);
            if($get_product){
               while ($value=$get_product->fetch_assoc()) {
            ?>
		
			<form action="" method="post" enctype="multipart/form-data">
				<table class="form">

					<tr>
						<td><label>Name</label></td>
						<td><input type="text" name="product_name" value="<?php echo $value['product_name']?>" class="medium" /></td>
					</tr>
					<tr>
						<td><label>Product Name</label></td>
						<td><select id="select" name="category_id">
								<option>Select Category</option>
							<?php
                            $category = new category();
                            $get_category = $category->getAllCategories();
                            if ($get_category) {
                                while ($result = $get_category->fetch_assoc()) {
                                    ?>
							<option 							
							<?php 
							if($value['category_id']==$result['category_id']){?>							
							selected="selected"
							<?php }?>							
							value="<?php echo $result['category_id']?>"><?php echo $result['category_name']?>
							</option>
							<?php }}?>
                        </select></td>
					</tr>
					<tr>
						<td><label>Brand</label></td>
						<td><select id="select" name="brand_id">
								<option>Select Brand</option>
							<?php
                            $brand = new brand();
                            $get_brand = $brand->getAllBrands();
                            if ($get_brand) {
                                while ($result = $get_brand->fetch_assoc()) {
                            ?>							
							<option 							
							<?php 
							if($value['brand_id']==$result['brand_id']){?>							
							selected="selected"
							<?php }?>							
							value="<?php echo $result['brand_id']?>"><?php echo $result['brand_name']?>
							</option>
							<?php }}?>
						</select></td>
					</tr>

					<tr>
						<td style="vertical-align: top; padding-top: 9px;"><label>Description</label>
						</td>
						<td><textarea class="tinymce" name="body">
							<?php echo $value['body']?>
						</textarea></td>
					</tr>
					<tr>
						<td><label>Price</label></td>
						<td><input type="text" name="price" value="<?php echo $value['price']?>"  class="medium" /></td>
					</tr>

					<tr>
						<td><label>Upload Image</label></td>
						<td>
						<img  src="<?php $value['image'];?>" height="60px" width="80px"> <br/>
						<input type="file" name="image" />
						</td>
					</tr>

					<tr>
						<td><label>Product Type</label></td>
						<td><select id="select" name="type">
								<option>Select Type</option>
								
								<?php 
								if($value['type']==0){?>
								<option value="0" selected="selected">Featured</option>
								<option value="1">Non-Featured</option>
								<?php }else{?>
								<option value="0">Featured</option>
								<option value="1" selected="selected">Non-Featured</option>
								<?php }?>
						</select></td>
					</tr>

					<tr>
						<td></td>
						<td><input type="submit" name="submit" value="update"/></td>
					</tr>
				</table>
			</form>
			
			<?php 
            }}
			?>
		</div>
	</div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


