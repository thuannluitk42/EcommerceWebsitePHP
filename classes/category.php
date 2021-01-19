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
        $this->fm = new format();
    }

    public function catInsert($catName)
    {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $category_id = date('dmYHis');

        if (empty($catName)) {
            $msg = "Category field must not empty";
            return $msg;
        } else {
            $query = "insert into tbl_category values ($category_id,'$catName')";
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
}

?>