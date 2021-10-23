<?php
    if(isset($_POST["submitLogin"])){
        if(isset($_POST["customer_email"]) && isset($_POST["customer_password"])){
            if($_POST["customer_email"] == "" && $_POST["customer_password"]==""){
                $errorEmail = "Email không được bỏ trống!!!";
                $errorPass = "Mật khẩu không được bỏ trống";
            }else{
                $email = $_POST["customer_email"];
                $pass = md5($_POST["customer_password"]);
                $qr = "SELECT *FROM `tbl_customers` where `customer_email` = '$email' and `customer_password` = '$pass'";
                $thucthi = mysqli_query($data->conn,$qr);
                if(mysqli_num_rows($thucthi) > 0){
                    $row = mysqli_fetch_array($thucthi);
                    $_SESSION["user"] = $row;
                    header('Location:home.php');
                }else{
                    $ErrorLogin = "Sai tên tài khoản và mật khẩu";
                }
            }
        }
    }
?>
<div class="grid">
    <?php if(isset($ErrorLogin)){ ?>
        <div class="alert alert--danger mt-2 mb-2" id="alert">
            <?php echo $ErrorLogin; ?>
        </div>
    <?php } ?>
    <div class="auth">
        <div class="auth-form">
            <div class="auth-form__container">
                <div class="auth-form__header">
                    <h3 class="auth-form__heading">Đăng nhập</h3>
                    <a href="home.php?p=register" class="auth-form__btn-heading">Đăng ký</a>
                </div>
                <form action="home.php?p=login" method="post" class="auth-form__form">
                    <div class="auth-form__row">
                        <input type="text" name="customer_email" class="auth-form__input" placeholder="Nhập email của bạn">
                    </div>
                    <div class="auth-form__row">
                        <input type="password" name="customer_password" class="auth-form__input" placeholder="Nhập mật khẩu của bạn">
                    </div>
                    <div class="auth-form__aside">
                        <div class="auth-form__help">
                            <a href="" class="auth-form__help-link">Quên mật khẩu</a>
                            <a href="" class="auth-form__help-link">Cần trợ giúp?</a>
                        </div>
                    </div>
                    <div class="auth-form__control">
                        <button class="btn auth-form__control-back btn-normal">TRỞ LẠI</button>
                        <button name="submitLogin" type="submit" class="btn btn--primary">ĐĂNG NHẬP</button>
                    </div>
                </form>
            </div>
            <div class="auth-form__social">
                <a class="auth-form__social--facebook btn btn--size-s btn--with-icon"><i class="auth-form__social-icons fab fa-facebook-square"></i> <span class="auth-form__social-tittle"> Kết nối với FaceBook</span></a>
                <a class="auth-form__social--google btn btn--size-s btn--with-icon"><img src="./assets/img/iconGG.png" class="auth-form__social-icons-gg" alt=""><span class="auth-form__social-tittle">Kết nối với Google</span></a>
            </div> 
        </div>
    </div>
</div>
