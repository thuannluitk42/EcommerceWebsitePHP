<?php
include_once '../lib/Database.php';
include_once '../helpers/format.php';
?>

<?php

class product
{

    private $db;

    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new format();
    }

    public function insertProduct($data, $file)
    {
        $product_name = mysqli_real_escape_string($this->db->link, $data['product_name']);
        $category_id = mysqli_real_escape_string($this->db->link, $data['category_id']);
        $brand_id = mysqli_real_escape_string($this->db->link, $data['brand_id']);
        $body = mysqli_real_escape_string($this->db->link, $data['body']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited = array(
            'jpg',
            'png',
            'jpeg',
            'gif'
        );
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "upload/" . $unique_image;

        if ($product_name == "" || $category_id == "" || $brand_id == "" || $body == "" || $price == "" || $type == "") {
            $msg = "<span class= 'error'>field must not empty.<span>";
            return $msg;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);

            $query = "insert into tbl_product (product_name,category_id,brand_id,body,price,image,type)
                    values('$product_name','$category_id','$brand_id','$body','$price','$uploaded_image','$type')";
            $productInsert = $this->db->insert($query);
            
            if ($productInsert) {
                $msg = "<span class= 'success'>Product insert successfully.<span>";
                return $msg;
            } else {
                $msg = "<span class= 'error'>Product insert failed.<span>";
                return $msg;
            }
        }
    }

    public function getAllCategories()
    {
        $query = "select * from tbl_category order by category_id  desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function getCategoryById($id)
    {
        $query = "select * from tbl_category where category_id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function updateCategory($category_name, $id)
    {
        $category_name = $this->fm->validation($category_name);
        $category_name = mysqli_real_escape_string($this->db->link, $category_name);
        $category_id = mysqli_real_escape_string($this->db->link, $id);

        if (empty($category_name)) {
            $msg = "<span class= 'error'>Category field must not empty.<span>";
            return $msg;
        } else {
            $query = "update tbl_category set category_name='$category_name' where category_id='$category_id'";
            $update_row = $this->db->update($query);
            if ($update_row) {
                $msg = "<span class= 'success'>Category updated successfully.<span>";
                return $msg;
            } else {
                $msg = "<span class= 'error'>Category updated failed.<span>";
                return $msg;
            }
        }
    }

    public function deleteCategoryById($category_id)
    {
        $query = "delete from  tbl_category where category_id='$category_id'";
        $delete_row = $this->db->delete($query);
        if ($delete_row) {
            $msg = "<span class= 'success'>Category deleted successfully.<span>";
            return $msg;
        } else {
            $msg = "<span class= 'error'>Category deleted failed.<span>";
            return $msg;
        }
    }
}

?>