<?php
class Connect{
    public $conn = "";
    public function __construct(){
        $this->conn = mysqli_connect('localhost','root','','webshopmobile') or die('Không thể kết nối đến database');
    }
}
?>