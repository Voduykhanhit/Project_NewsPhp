<?php
    if(isset($_GET["order_code"]) && isset($_SESSION["user"])){
        $order_code = $_GET["order_code"];
?>
    <div class="grid">
        <div class="cart-complete">
            <i class="fas fa-check-circle cart-complete__icon"></i>
            <h3 class="cart-complete__title">ĐẶT HÀNG THÀNH CÔNG</h3>
            <div class="cart-complete__notes">
                <span class="cart-complete__notes-thanks">Cảm ơn bạn đã đặt hàng tại</span>
                <span class="cart-complete__notes-website">dkmobile.com</span>
            </div>
            <h3 class="cart-complete__code">
                Mã số đơn hàng của bạn là: <br>
                <?php echo $order_code; ?>
            </h3>
            <div class="cart-complete__btn">
                <a href="" class="btn btn btn--cart"><i class="fas fa-list cart-complete__btn-icon"></i> Chi tiết đơn hàng</a>
                <a href="home.php" class="btn btn btn--cart"><i class="fas fa-redo-alt cart-complete__btn-icon"></i> Quay lại trang chủ</a>
            </div>
            <span class="cart-complete__message">Chúng tôi đã nhận được thông tin đặt hàng của bạn, nhân viên cửa hàng sẽ sớm liên hệ bạn để hoàn tất quá trình giao hàng và tiến hành giao hạn đến địa chỉ của bạn trong thời gian sớm nhất.</span>
        </div>
    </div>
<?php }else{ header('Location:home.php'); }?>