<div class="grid">
    <div class="grid__row row--cart">
        <?php include_once "./layout/fe/menu.php"; ?>
        <div class="grid__column-10 grid__column-10--cart">
        <div class="cart">
            <div class="cart__title">
                <h3 class="cart__title-heading">Giỏ hàng của bạn</h3>
            </div>
            <?php
                $tong = 0; 
                if(isset($Cartitem) && count($Cartitem)>0){
                foreach($Cartitem as $key => $item){
                    $tong += $item["price"];
            ?>
                <div class="cart__body">
                    <img src="upload/sanpham/<?php echo $item['options']['image']; ?>" alt="" class="cart__body-img">
                    <span class="cart__body-name"><?php echo $item['name']; ?></span>
                    <div class="card-details__qty-btn card-details__qty-btn--cartbody ">
                        <button id="sub" class="btn btn--qty btn--sub-qty" data-id="<?php echo $item["id"]; ?>">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input type="text" class="card-details__qty-input" disabled value="<?php echo $item['qty']; ?>">
                        <button id="add" class="btn btn--qty btn--add-qty" data-id="<?php echo $item["id"]; ?>">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="cart__body-payment"> 
                        <span class="cart__body-price"><?php echo number_format($item['price']); ?>đ</span>
                        <span class="cart__body-multi">x</span>
                        <span class="cart__body-quantity"><?php echo $item['qty']; ?></span>
                    </div>
                    <a href="home.php?p=cart&DelCart=<?php echo $item["id"]; ?>" class="btn btn--primary btn--primary-del"><i class="fas fa-backspace"></i></a>
                </div>
                
            <?php } ?>
                <div class="cart__body-total">
                    <span class="cart__body-total-label">Tổng tiền:</span>
                    <span class="cart__body-total-price"><?php echo number_format($tong); ?>đ</span>
                    <a href="home.php" class="btn btn--primary btn--continue">Tiếp tục mua hàng</a>
                    <?php if(isset($_SESSION["user"])){ ?>
                        <a href="home.php?p=checkout" class="btn btn--primary btn--continue">Thanh toán</a>
                    <?php }else{ ?>
                        <a href="home.php?p=login" class="btn btn--primary btn--continue">Thanh toán</a>
                    <?php } ?>
                </div>
            <?php }else{?>
                <div class="cart__body-total">
                    <span class="cart__body-total-label">Giỏ hàng Rỗng:</span>
                    <a href="home.php" class="btn btn--primary btn--continue">Tiếp tục mua hàng</a>
                </div>
            <?php } ?>
        </div>
    </div>
    </div>
</div>
<script>

</script>