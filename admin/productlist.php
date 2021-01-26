<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php';?>
<?php include_once '../helpers/format.php';?>

<?php
$pd = new product();
$fm = new format();
?>


<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>SL</th>
						<th>Product name</th>
						<th>Category</th>
						<th>Brand</th>
						<th>Description</th>
						<th>Price</th>
						<th>Image</th>
						<th>Type</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
			
			<?php
            $getProduct = $pd->getAllProducts();
            if ($getProduct) {
                $i = 0;
                while ($result = $getProduct->fetch_assoc()) {
                    $i ++;
                    ?>
			
			
				<tr class="odd gradeX">
						<td><?php echo $i;?></td>
						<td><?php echo $fm->textShorten($result['product_name'],15);?></td>
						<td><?php echo $result['category_name'];?></td>
						<td><?php echo $result['brand_name'];?></td>
						<td><?php echo $fm->textShorten($result['body'],50);?></td>
						<td><?php echo $result['price'];?></td>
						<td><img src="<?php echo $result['image'];?>" height="40px"
							width="60px"></td>
						<td><?php
                        if ($result['type'] == 0) {
                            echo "Featured";
                        } else {
                            echo "General";
                        }
                
                        ?></td>

						<td><a
							href="productedit.php?product_id=<?php echo $result['product_id']?>">Edit</a>
							|| <a onclick="return confirm('Are you sure to delete')"
							href="?productdel=<?php echo $result['product_id']?>">Delete</a></td>
					</tr>
                <?php
                    }
                }
                ?>
			</tbody>
			</table>

		</div>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
