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
        $this->fm = new Format();
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

    public function getAllProducts()
    {
//         $query = "select * from tbl_product order by product_id desc";
        $query = "select tbl_product.*, tbl_category.category_name,tbl_brand.brand_name
                   from tbl_product 
                    inner join tbl_category 
                    on tbl_product.category_id = tbl_category.category_id
                    inner join tbl_brand
                    on tbl_product.brand_id = tbl_brand.brand_id
                    order by tbl_product.product_id desc";
        $result = $this->db->select($query);

        return $result;
    }

    public function getProductById($id)
    {
        $query = "select * from tbl_product where product_id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function updateProduct($product_name, $id)
    {
        $product_name = $this->fm->validation($product_name);
        $product_name = mysqli_real_escape_string($this->db->link, $product_name);
        $product_id = mysqli_real_escape_string($this->db->link, $id);

        if (empty($product_name)) {
            $msg = "<span class= 'error'>Product field must not empty.<span>";
            return $msg;
        } else {
            $query = "update tbl_product set product_name='$product_name' where product_id='$product_id'";
            $update_row = $this->db->update($query);
            if ($update_row) {
                $msg = "<span class= 'success'>Product updated successfully.<span>";
                return $msg;
            } else {
                $msg = "<span class= 'error'>Product updated failed.<span>";
                return $msg;
            }
        }
    }

    public function deleteProductById($product_id)
    {
        $query = "delete from  tbl_product where product_id='$product_id'";
        $delete_row = $this->db->delete($query);
        if ($delete_row) {
            $msg = "<span class= 'success'>Product deleted successfully.<span>";
            return $msg;
        } else {
            $msg = "<span class= 'error'>Product deleted failed.<span>";
            return $msg;
        }
    }
}

?>