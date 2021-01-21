<?php
include_once '../lib/Database.php';
include_once '../helpers/format.php';
?>

<?php

class brand
{

    private $db;

    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new format();
    }

    public function brandInsert($brand_name)
    {
        $brand_name = $this->fm->validation($brand_name);
        $brand_name = mysqli_real_escape_string($this->db->link, $brand_name);

        if (empty($brand_name)) {
            $msg = "Brand field must not empty";
            return $msg;
        } else {
            $query = "insert into tbl_brand(brand_name) values ('$brand_name')";
            $brandInsert = $this->db->insert($query);
            if ($brandInsert) {
                $msg = "<span class= 'success'>Brand insert successfully.<span>";
                return $msg;
            } else {
                $msg = "<span class= 'error'>Brand insert failed.<span>";
                return $msg;
            }
        }
    }

    public function getAllBrands()
    {
        $query = "select * from tbl_brand order by brand_id  desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function getBrandById($id)
    {
        $query = "select * from tbl_brand where brand_id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function updateBrand($brand_name, $id)
    {
        $brand_name = $this->fm->validation($brand_name);
        $brand_name = mysqli_real_escape_string($this->db->link, $brand_name);
        $brand_id = mysqli_real_escape_string($this->db->link, $id);

        if (empty($brand_name)) {
            $msg = "<span class= 'error'>Brand field must not empty.<span>";
            return $msg;
        } else {
            $query = "update tbl_brand set brand_name='$brand_name' where brand_id='$brand_id'";
            $update_row = $this->db->update($query);
            if ($update_row) {
                $msg = "<span class= 'success'>Brand updated successfully.<span>";
                return $msg;
            } else {
                $msg = "<span class= 'error'>Brand updated failed.<span>";
                return $msg;
            }
        }
    }

    public function deleteBrandById($brand_id)
    {
        $query = "delete from  tbl_brand where brand_id='$brand_id'";
        $delete_row = $this->db->delete($query);
        if ($delete_row) {
            $msg = "<span class= 'success'>Brand deleted successfully.<span>";
            return $msg;
        } else {
            $msg = "<span class= 'error'>Brand deleted failed.<span>";
            return $msg;
        }
    }
}

?>