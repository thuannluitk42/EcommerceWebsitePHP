<?php

class format{
    
    public function validation($data){
        //Hàm trim() sẽ loại bỏ khoẳng trắng( hoặc bất kì kí tự nào được cung cấp) dư thừa ở đầu và cuối chuỗi
        $data=trim($data);
        //Hàm stripcslashes() sẽ loại bỏ các dấu backslashes ( \ ) có trong chuỗi.
        $data=stripcslashes($data);
        //Hàm htmlspecialchars() Chuyển đổi các ký tự nháy kép ("), nháy đơn ('), nhỏ hơn (<), lớn hơn (>), dấu và (&) 
        //thành ký tự thực thể HTML
        $data=htmlspecialchars($data);
        return $data;
    }
    
}

?>