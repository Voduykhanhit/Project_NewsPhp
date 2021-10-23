<?php
    if(isset($_POST["submit"])){
        if(isset($_POST["Ten"]) && isset($_POST["DiaChi"]) && isset($_POST["SoDienThoai"]) && isset($_POST["Email"]) && isset($_POST["GhiChu"]) && isset($_POST["Payment"])){
            $payment_method = $_POST["Payment"];
            $payment_status = "Đang xử lý";
            $shipping_name = $_POST["Ten"];
            $shipping_address = $_POST["DiaChi"];
            $shipping_phone = $_POST["SoDienThoai"];
            $shipping_email = $_POST["Email"];
            $shipping_notes = $_POST["GhiChu"];
            if($payment_method == ""){
                $Payment  = "Bạn chưa lựa chọn phương thức thanh toán";
            }else if($shipping_name == ""){
                $Ten = "Tên không được bỏ trống!!!";
            }else if($shipping_address == ""){
                $DiaChi = "Địa chỉ không được bỏ trống!!!";
            }else if($shipping_email == ""){
                $Email = "Email không được bỏ trống!!!";
            }else if($shipping_notes == ""){
                $GhiChu = "Ghi chú không được bỏ trống!!";
            }else if($shipping_phone ==""){
                $SoDienThoai = "Số điện thoại không được bỏ trống!!!";
            }else if(strlen($shipping_phone) <= 9){
                $SoDienThoai = "Số điện thoại phải từ 10 số trở lên";
            }else if(!is_numeric($shipping_phone)){
                $SoDienThoai = "Số điện thoại phải là số";
            }
            else{
                $payment = $home->ThemPhuongThucThanhToan($payment_method,$payment_status);
                $shipping = $home->ThemNguoiNhan($shipping_name,$shipping_address,$shipping_phone,$shipping_email,$shipping_notes);
                $order_code = $home->rand_string(5);
                $total = 0;
                foreach($Cartitem as $key=>$value){
                    $total += $value["price"];
                }
                $customer_id = $_SESSION["user"]["customer_id"];
                $order = $home->ThemHoaDon($customer_id,$shipping,$payment,$total,$order_code);
                if(isset($_SESSION["fee"])){
                    $fee = $_SESSION["fee"];
                }else{
                    $fee = 0;
                }
                foreach($Cartitem as $key=> $item){
                    $order_details = $home->ThemCTHoaDon($item["id"],$item["name"],$item["price"],$item["qty"],$fee,$order_code);
                }
                if($order_details){
                    unset($_SESSION['cart']);
                    unset($_SESSION['fee']);
                    header("Location:home.php?p=complete&order_code=".$order_code);
                }else{
                    $erCheckOut = "Lỗi thanh toán!!!";
                }
            }  
        }
    }
?>
<!-- Message -->
<?php if(isset($_SESSION["user"])){?>
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
                            <button class="btn btn--qty btn--sub-qty" data-id="<?php echo $item["id"]; ?>">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="text" class="card-details__qty-input" value="<?php echo $item['qty']; ?>">
                            <button class="btn btn--qty btn--add-qty" data-id="<?php echo $item["id"]; ?>">
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
                        <span class="cart__body-total-price"><?php if(isset($_SESSION['fee'])){ echo number_format($tong + $_SESSION['fee']); }else{ echo number_format($tong); }  ?>đ</span>
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
            <div class="form">
                <h2 class="form__title"><i class="fas fa-shipping-fast"></i> Phí vận chuyển</h2>
                <form action="" method="post" class="form__content">
                    <div class="form__group">
                        <label for="" class="form__label">Tỉnh</label>
                        <select name="Tinh" id="Tinh" class="form__select chon">
                            <option value="">--Chọn--</option>
                            <?php 
                                $listT = $home->DanhSachThanhPho();
                                while($rowT = mysqli_fetch_array($listT)){
                            ?>
                            <option value="<?php echo $rowT['matp'] ?>"><?php echo $rowT['name_city'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form__group">
                        <label for="" class="form__label">Huyện</label>
                        <select name="Huyen" id="Huyen" class="form__select chon">
                            <option value="">--Chọn--</option>
                            <?php 
                                $listQH = $home->DanhSachQuanHuyen();
                                while($rowQH = mysqli_fetch_array($listQH)){
                            ?>
                                <option value="<?php echo $rowQH['maqh']; ?>"><?php echo $rowQH['name_quanhuyen']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form__group">
                        <label for="" class="form__label">Xã</label>
                        <select name="Xa" id="Xa" class="form__select">
                            <option value="">--Chọn--</option>
                        </select>
                    </div>
                        <button type="button" class="btn btn--primary btn--submit" id="feeship">Tính phí</button>
                        <button class="btn btn--primary btn--submit">Huỷ</button>
                </form>
            </div>
            <div class="form">
                <h2 class="form__title"><i class="fas fa-money-check form__title-icon"></i> Thông tin người nhận</h2>
                <form action="home.php?p=checkout" method="post" class="form__content">
                    <div class="form__group">
                        <label for="Ten" class="form__label">Tên người nhận</label>
                        <input type="text" class="form__input" name="Ten" id="Ten" value="" placeholder="Nhập tên người nhận">
                        <?php if(isset($Ten)){ ?> 
                            <p class="help is-danger"><?php  echo $Ten ?></p>
                        <?php } ?>
                    </div>
                    <div class="form__group">
                        <label for="DiaChi" class="form__label">Địa chỉ</label>
                        <textarea name="DiaChi" class="form__input" id="DiaChi" cols="30" rows="10"></textarea>
                        <?php if(isset($DiaChi)){ ?> 
                            <p class="help is-danger"><?php  echo $DiaChi ?></p>
                        <?php } ?>
                    </div>
                    <div class="form__group">
                        <label for="SoDienThoai" class="form__label">Số điện thoại</label>
                        <input type="text" class="form__input" name="SoDienThoai" id="SoDienThoai" value="" placeholder="Nhập số điện thoại">
                        <?php if(isset($SoDienThoai)){ ?> 
                            <p class="help is-danger"><?php  echo $SoDienThoai ?></p>
                        <?php } ?>
                    </div>
                    <div class="form__group">
                        <label for="Email" class="form__label">Email</label>
                        <input type="email" class="form__input" name="Email" id="Email"  value="" placeholder="Nhập số email">
                        <?php if(isset($Email)){ ?> 
                            <p class="help is-danger"><?php  echo $Email ?></p>
                        <?php } ?>
                    </div>
                    <div class="form__group">
                        <label for="GhiChu" class="form__label">Ghi chú</label>
                        <textarea name="GhiChu" class="form__input" id="GhiChu" cols="30" rows="10"></textarea>
                        <?php if(isset($GhiChu)){ ?> 
                            <p class="help is-danger"><?php  echo $GhiChu ?></p>
                        <?php } ?>
                    </div>
                    <div class="form__group">
                        <label for=""  class="form__label">Hình thức thanh toán</label>
                        <select name="Payment"  class="form__select">
                            <option value="">--Chọn hình thức thanh toán--</option>
                            <option value="1">Khi nhận hàng</option>
                            <option value="2">Thẻ ATM</option>
                        </select>
                        <?php if(isset($Payment)){ ?> 
                            <p class="help is-danger"><?php  echo $Payment ?></p>
                        <?php } ?>
                    </div>
                    <button type="submit" name="submit" class="btn btn--primary btn--action" type="button">Gửi</button>
                    <button class="btn btn--primary btn--action" type="reset">Huỷ</button>
                    <!-- <div class="form__check">
                        <input type="checkbox" class="form__checkbox" value="Checkmeout" id="Example">
                        <label for="Example" class="form__label">ok</label>
                    </div> -->
                    <!-- <div class="form__row">
                        <div class="form__column-4">
                            <label for="" class="form__label mr-2">Danh mục</label>
                            <input type="text" class="form__input ml-2" value="" placeholder="Nhập thông tin">
                        </div>
                        <div class="form__column-4">
                            <label for="" class="form__label mr-2">Sản phẩm</label>
                            <input type="text" class="form__input ml-2" value="" placeholder="Nhập thông tin">
                        </div>
                        <div class="form__column-4">
                            <label for="" class="form__label mr-2">Sản phẩm</label>
                            <input type="text" class="form__input ml-2" value="" placeholder="Nhập thông tin">
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form__column-4">
                            <label for="" class="form__label mr-2">Danh mục</label>
                            <input type="text" class="form__input ml-2" value="" placeholder="Nhập thông tin">
                        </div>
                        <div class="form__column-8">
                            <label for="" class="form__label mr-2">Sản phẩm</label>
                            <input type="text" class="form__input ml-2" value="" placeholder="Nhập thông tin">
                        </div>
                    </div> -->
                </form>
            </div>
        </div>
        </div>
    </div>
<?php }else{ header('Location:home.php'); }?>