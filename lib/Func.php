<?php
    class Handle{
        public $conn = "";
        public function __construct(){
            $this->conn = mysqli_connect('localhost','root','','webshopmobile') or die('Không thể kết nối đến database');
        }
        function DanhSachSanPham($perRow,$rowPerPage){
            $qr = "SELECT *FROM `tbl_product` ORDER BY `product_id` DESC LIMIT $perRow,$rowPerPage";
            return mysqli_query($this->conn,$qr);
        }
        function GiaThapDenCao($perRow,$rowPerPage){
            $qr = "SELECT *FROM `tbl_product` ORDER BY `product_price` ASC LIMIT $perRow,$rowPerPage";
            return mysqli_query($this->conn,$qr);
        }
        function GiaCaoDenThap($perRow,$rowPerPage){
            $qr = "SELECT *FROM `tbl_product` ORDER BY `product_price` DESC LIMIT $perRow,$rowPerPage";
            return mysqli_query($this->conn,$qr);
        }
        function DuoiMotTrieu($perRow,$rowPerPage){
            $qr = "SELECT *FROM `tbl_product` WHERE `product_price` < 1000000 ORDER BY `product_price` ASC LIMIT $perRow,$rowPerPage";
            return mysqli_query($this->conn,$qr);
        }
        function MotDenNam($perRow,$rowPerPage){
            $qr = "SELECT *FROM `tbl_product` WHERE `product_price` BETWEEN 1000000 AND 5000000 ORDER BY `product_price` ASC LIMIT $perRow,$rowPerPage";
            return mysqli_query($this->conn,$qr);
        }
        function NamDenMuoi($perRow,$rowPerPage){
            $qr = "SELECT *FROM `tbl_product` WHERE `product_price` BETWEEN 5000000 AND 10000000 ORDER BY `product_price` ASC LIMIT $perRow,$rowPerPage";
            return mysqli_query($this->conn,$qr);
        }
        function MuoiDen15($perRow,$rowPerPage){
            $qr = "SELECT *FROM `tbl_product` WHERE `product_price` BETWEEN 10000000 AND 15000000 ORDER BY `product_price` ASC LIMIT $perRow,$rowPerPage";
            return mysqli_query($this->conn,$qr);
        }
        function MuoiLamDen20($perRow,$rowPerPage){
            $qr = "SELECT *FROM `tbl_product` WHERE `product_price` BETWEEN 15000000 AND 20000000 ORDER BY `product_price` ASC LIMIT $perRow,$rowPerPage";
            return mysqli_query($this->conn,$qr);
        }
        function HaiMuoiDen25($perRow,$rowPerPage){
            $qr = "SELECT *FROM `tbl_product` WHERE `product_price` BETWEEN 20000000 AND 25000000 ORDER BY `product_price` ASC LIMIT $perRow,$rowPerPage";
            return mysqli_query($this->conn,$qr);
        }
        function LonHon25($perRow,$rowPerPage){
            $qr = "SELECT *FROM `tbl_product` WHERE `product_price` > 25000000 ORDER BY `product_price` ASC LIMIT $perRow,$rowPerPage";
            return mysqli_query($this->conn,$qr);
        }
        function DanhSachDanhMuc(){
            $qr = "SELECT *FROM `tbl_category_product` ORDER BY `category_id` DESC";
            return mysqli_query($this->conn,$qr);
        }
        function ChiTietSanPham($idProduct){
            $qr = "SELECT *FROM `tbl_product` as pd INNER JOIN `tbl_category_product` as ctg ON `pd`.category_id = `ctg`.category_id and `product_id`='$idProduct'";
            return mysqli_query($this->conn,$qr);
        }
        function DanhSachBinhLuan($idProduct){
            $qr = "SELECT *FROM `tbl_comments` WHERE `product_id`='$idProduct'";
            return mysqli_query($this->conn,$qr);
        }
        function TraLoiBinhLuan(){
            $qr = "SELECT *FROM `tbl_replycomment` as rl INNER JOIN `tbl_admin` as am ON `rl`.admin_id = `am`.admin_id";
            return mysqli_query($this->conn,$qr);
        }
        function SanPhamTheoDanhMuc($idCtg,$perRow,$rowPerPage){
            $qr = "SELECT *FROM `tbl_product` as pd INNER JOIN `tbl_category_product` as ctg ON `pd`.category_id = `ctg`.category_id and `pd`.category_id = '$idCtg' LIMIT $perRow,$rowPerPage";
            return mysqli_query($this->conn,$qr);
        }
        function DanhSachThanhPho(){
            $qr = "SELECT *FROM `tbl_tinhthanhpho` WHERE 1";
            return mysqli_query($this->conn,$qr);
        }
        function DanhSachQuanHuyen(){
            $qr = "SELECT *FROM `tbl_quanhuyen` WHERE 1";
            return mysqli_query($this->conn,$qr);
        }
        function QuanHuyen($matp){
            $qr = "SELECT *FROM `tbl_quanhuyen` where `matp` = '$matp'";
            return mysqli_query($this->conn,$qr);
        }
        function XaPhuong($maqh){
            $qr = "SELECT *FROM `tbl_xaphuongthitran` where `maqh` = '$maqh'";
            return mysqli_query($this->conn,$qr);
        }
        function PhiVanChuyen($matp,$maqh,$xaid){
            $qr = "SELECT *FROM `tbl_feeship` where `matp`='$matp' and `maqh`='$maqh' and `xaid`='$xaid'";
            return mysqli_query($this->conn,$qr);
        }
        function ThemHoaDon($customer_id,$shipping_id,$payment_id,$total,$code){
            $qr = "INSERT INTO `tbl_order`(`customer_id`,`shipping_id`,`payment_id`,`order_total`,`order_status`,`order_code`,`created_at`) VALUES('$customer_id','$shipping_id','$payment_id','$total',1,'$code',NOW())";
            return mysqli_query($this->conn,$qr);
        }
        function ThemCTHoaDon($product_id,$product_name,$product_price,$product_sales_quantity,$product_feeship,$code){
            $qr = "INSERT INTO `tbl_order_details`(`product_id`,`product_name`,`product_price`,`product_sales_quantity`,`product_feeship`,`order_code`,`created_at`) VALUES('$product_id','$product_name','$product_price','$product_sales_quantity','$product_feeship','$code',NOW())";
            return mysqli_query($this->conn,$qr);
        }
        function ThemNguoiNhan($shipping_name,$shipping_address,$shipping_phone,$shipping_email,$shipping_notes){
            $qr = "INSERT INTO `tbl_shipping`(`shipping_name`,`shipping_address`,`shipping_phone`,`shipping_email`,`shipping_notes`,`created_at`) VALUES('$shipping_name','$shipping_address','$shipping_phone','$shipping_email','$shipping_notes',NOW())";
            if(mysqli_query($this->conn,$qr)){
                $last_id = mysqli_insert_id($this->conn);
                return $last_id;
            }else{
                return "Lỗi insert CSDL".mysqli_error();
            }
        }
        function ThemPhuongThucThanhToan($payment_method,$payment_status){
            $qr = "INSERT INTO `tbl_payment`(`payment_method`,`payment_status`,`created_at`) VALUES('$payment_method','$payment_status',NOW())";
            
            if(mysqli_query($this->conn,$qr)){
                $last_id = mysqli_insert_id($this->conn);
                return $last_id;
            }else{
                return "Lỗi insert CSDL".mysqli_error();
            }
            
        }
        function rand_string($length){
            $str= "";
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $size = strlen( $chars );
            for( $i = 0; $i < $length; $i++ ) {
                $str .= $chars[ rand( 0, $size - 1 ) ];
             }
            return $str;
        }
        function HoaDon($cm_id){
            $qr = "SELECT *FROM `tbl_order` as `od` INNER JOIN `tbl_customers` as `cm` ON `od`.customer_id = `cm`.customer_id and `od`.customer_id = '$cm_id'";
            return mysqli_query($this->conn,$qr);
        }
        function MotHoaDon($cm_id,$order_code){
            $qr = "SELECT *FROM `tbl_order` WHERE `customer_id` = '$cm_id' and `order_code` = '$order_code'";
            return mysqli_query($this->conn,$qr);
        }
        function ChiTietHoaDon($order_code){
            $qr = "SELECT *FROM `tbl_order_details` WHERE `order_code`='$order_code'";
            return mysqli_query($this->conn,$qr);
        }
        function LayMotNguoiNhan($shipping_id){
            $qr = "SELECT *FROM `tbl_shipping` WHERE `shipping_id` = '$shipping_id'";
            return mysqli_query($this->conn,$qr);
        }
        function LayMotKhachHang($customer_id){
            $qr = "SELECT *FROM `tbl_customers` WHERE `customer_id` = '$customer_id'";
            return mysqli_query($this->conn,$qr);
        }
    }
?>