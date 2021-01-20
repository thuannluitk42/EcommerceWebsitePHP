<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php
$cat = new category();
if (isset($_GET['catdel'])) {
    $category_id = $_GET['catdel'];
    $catdel = $cat->deleteCategoryById($category_id);
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Category List</h2>
		<div class="block">
                <?php
                if (isset($catdel)) {
                    echo $catdel;
                }

                ?>
                    <table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Serial No.</th>
						<th>Category Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
    $getCat = $cat->getAllCategories();
    if ($getCat) {
        $i = 0;

        while ($result = $getCat->fetch_assoc()) {
            $i ++;

            ?>
						<tr class="odd gradeX">
						<td><?php echo $i;?></td>
						<td><?php echo $result['category_name'];?></td>
						<td><a
							href="catedit.php?category_id=<?php echo $result['category_id']?>">Edit</a>
							|| <a onclick="return confirm('Are you sure to delete')"
							href="?catdel=<?php echo $result['category_id']?>">Delete</a></td>
					</tr>
					<?php }}?>
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

