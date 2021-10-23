<?php
    if(isset($_SESSION["user"])){
        if(isset($_POST['submit'])){
            if(isset($_POST["checkvalue"])){
                if(isset($_POST["customer_id"]) && isset($_POST['customer_name']) && isset($_POST['customer_phone']) && isset($_POST['customer_password']) && isset($_POST['customer_passwordAgain'])){
                    $cm_name = $_POST['customer_name'];
                    $cm_phone = $_POST['customer_phone'];
                    $cm_password = $_POST['customer_password'];
                    $cm_passwordAgain = $_POST['customer_passwordAgain'];
                    $id_cm = $_POST["customer_id"];
                    if($cm_password != $cm_passwordAgain)
                    {
                        $customer_passwordAgain = "Mật khẩu nhập lại không khớp";
                    }else if($cm_name == ""){
                        $customer_name = "Tên không được bỏ trống";
                    }else if(strlen($cm_phone) < 10){
                        $customer_phone = "Số điện thoải phải từ 10 số trở lên";
                    }else if(!is_numeric($cm_phone)){
                        $customer_phone = "Số điện thoại phải là số";
                    }else{
                        $password_md5 = md5($cm_password);
                        
                        $qr = "UPDATE `tbl_customers` SET `customer_name` = '$cm_name',`customer_password`= '$password_md5',`customer_phone`= '$cm_phone',`updated_at`= now() where `customer_id` = '$id_cm'";
                        $ThucThi =  mysqli_query($data->conn,$qr);
                        
                        if($ThucThi){
                            $_SESSION["msg"] = "Chỉnh sửa thành công!!!";
                            $_SESSION["user"]["customer_name"] = $cm_name;
                            $_SESSION["user"]["customer_phone"] = $cm_phone;
                            header('Location:home.php?p=infocus');
                        }else{
                            echo "Lỗi insert CSDL".mysqli_error();
                        }
                    }
                }
            }else{
                if(isset($_POST["customer_id"]) && isset($_POST['customer_name']) && isset($_POST['customer_phone'])){
                    $cm_name = $_POST['customer_name'];
                    $cm_phone = $_POST['customer_phone'];
                    $id_cm = $_POST["customer_id"];
                    if($cm_name == ""){
                        $customer_name = "Tên không được bỏ trống";
                    }else if(strlen($cm_phone) < 10){
                        $customer_phone = "Số điện thoải phải từ 10 số trở lên";
                    }else if(!is_numeric($cm_phone)){
                        $customer_phone = "Số điện thoại phải là số";
                    }else{
                        $qr = "UPDATE `tbl_customers` SET `customer_name` = '$cm_name',`customer_phone` = '$cm_phone',`updated_at`= now() where `customer_id` = '$id_cm'";
                        $ThucThi =  mysqli_query($data->conn,$qr);
                        if($ThucThi){
                            $_SESSION["msg"] = "Chỉnh sửa thành công!!!";
                            $_SESSION["user"]["customer_name"] = $cm_name;
                            $_SESSION["user"]["customer_phone"] = $cm_phone;
                            header('Location:home.php?p=infocus');
                        }else{
                            echo "Lỗi insert CSDL".mysqli_error();
                        }
                    }
                }
            }    
        }
?>
<div class="grid">
    <div class="auth">
        <div class="auth-form">
            <div class="auth-form__container">
                <div class="auth-form__header">
                    <h3 class="auth-form__heading">Thông tin của bạn</h3>
                    <a href="home.php?p=logout" class="auth-form__btn-heading">Đăng xuất</a>
                </div>
                <form action="home.php?p=infocus" method="post" class="auth-form__form">
                    <div class="auth-form__row">
                        <input type="hidden" name="customer_id" value="<?php echo $_SESSION["user"]["customer_id"]; ?>" class="auth-form__input" placeholder="Nhập tên của bạn">
                        <input type="text" name="customer_name" value="<?php echo $_SESSION["user"]["customer_name"]; ?>" class="auth-form__input" placeholder="Nhập tên của bạn">
                        <?php if(isset($customer_name)){ ?> 
                            <p class="help is-danger"><?php  echo $customer_name ?></p>
                        <?php } ?>
                    </div>
                    <div class="auth-form__row">
                        <input type="text" disabled name="customer_email" class="auth-form__input" value="<?php echo $_SESSION["user"]["customer_email"]; ?>" placeholder="Nhập email của bạn">
                        <?php if(isset($customer_email)){ ?> 
                            <p class="help is-danger"><?php  echo $customer_email ?></p>
                        <?php } ?>
                    </div>
                    <div class="auth-form__row">
                        <input type="text" name="customer_phone" class="auth-form__input" value="<?php echo $_SESSION["user"]["customer_phone"]; ?>" placeholder="Nhập Số điện thoại">
                        <?php if(isset($customer_phone)){ ?> 
                            <p class="help is-danger"><?php  echo $customer_phone ?></p>
                        <?php } ?>
                    </div>
                     <div class="form__check mt-2">
                        <input type="checkbox" class="form__checkbox" name="checkvalue" id="Example">
                        <label for="Example" class="form__label">Đổi mật khẩu</label>
                    </div>
                    <div class="auth-form__row">
                        <input type="password" name="customer_password" class="auth-form__input txtvalue" disabled  value="" disabled placeholder="Nhập mật khẩu của bạn">
                        <?php if(isset($customer_password)){ ?> 
                            <p class="help is-danger"><?php  echo $customer_password ?></p>
                        <?php } ?>
                    </div>
                    <div class="auth-form__row">
                        <input type="password" name="customer_passwordAgain"  value="" disabled class="auth-form__input txtvalue" placeholder="Nhập lại mật khẩu">
                        <?php if(isset($customer_passwordAgain)){ ?> 
                            <p class="help is-danger"><?php  echo $customer_passwordAgain ?></p>
                        <?php } ?>
                    </div>
                    <div class="auth-form__aside">
                        <p class="auth-form__note">
                            Bằng việc đăng kí, bạn đã đồng ý với Shopee về
                            <a href="" class="auth-form__text-link">Điều khoản dịch vụ</a> &
                            <a href="" class="auth-form__text-link">Chính sách bảo mật</a>
                        </p>
                    </div>
                    <div class="auth-form__control">
                        <button class="btn auth-form__control-back btn-normal">TRỞ LẠI</button>
                        <button name="submit" type="submit" class="btn btn--primary">ĐĂNG KÝ</button>
                    </div>
                </form>
            </div>
            <div class="auth-form__social auth-form__social--bg-white">
                <a class="auth-form__social--facebook btn btn--size-s btn--with-icon"><i class="auth-form__social-icons fab fa-facebook-square"></i> <span class="auth-form__social-tittle"> Kết nối với FaceBook</span></a>
                <a class="auth-form__social--google btn btn--size-s btn--with-icon"><img src="./assets/img/iconGG.png" class="auth-form__social-icons-gg" alt=""><span class="auth-form__social-tittle">Kết nối với Google</span></a>
            </div> 
        </div>
    </div>
</div>
<?php }else{ header("Location:home.php"); }?>