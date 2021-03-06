<?php
include_once '../lib/Database.php';
include_once '../helpers/format.php';
?>

<?php

class category
{

    private $db;

    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function catInsert($catName)
    {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
//         $category_id = date('dmYHis');

        if (empty($catName)) {
            $msg = "Category field must not empty";
            return $msg;
        } else {
            $query = "insert into tbl_category(category_name) values ('$catName')";
            $catInsert = $this->db->insert($query);
            if ($catInsert) {
                $msg = "<span class= 'success'>Category insert successfully.<span>";
                return $msg;
            } else {
                $msg = "<span class= 'error'>Category insert failed.<span>";
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