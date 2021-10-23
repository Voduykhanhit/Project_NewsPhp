<?php
    if(isset($_SESSION["user"])){
        if(isset($_GET["order_code"])){
            $order_code = $_GET["order_code"];
        }
        $cm_id = $_SESSION["user"]["customer_id"];
        $order_details = $home->ChiTietHoaDon($order_code);
        $order = $home->MotHoaDon($_SESSION["user"]["customer_id"],$order_code);
        $rowOd = mysqli_fetch_array($order);
        $shipping_id =  $rowOd["shipping_id"];
        $payment_id =   $rowOd["payment_id"];
        $cus = $home->LayMotKhachHang($_SESSION["user"]["customer_id"]);
        $rowcm = mysqli_fetch_array($cus);
        $shipping = $home->LayMotNguoiNhan($shipping_id);
        $rowsp  = mysqli_fetch_array($shipping);
?>
<div class="grid">
    <div class="order-details">
        <div class="table">
            <table class="table__content">
                <caption><i class="fas fa-clipboard-list"></i> HOÁ ĐƠN CỦA BẠN</caption>
                <thead>
                    <tr>
                        <th>Mã hoá đơn</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Phí vận chuyển</th>
                        <th>Tổng</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $tong=0;
                        while($row = mysqli_fetch_array($order_details)){
                        $tong += $row["product_price"]; 
                    ?>
                        <tr>
                            <td><?php echo $row["order_code"]; ?></td>
                            <td><?php echo $row["product_name"]; ?></td>
                            <td><?php echo $row["product_price"]; ?>đ</td>
                            <td><?php echo $row["product_sales_quantity"]; ?></td>
                            <td><?php echo $row["product_feeship"]; ?></td>
                            <td><?php echo number_format($tong); ?>đ</td>
                            <td></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="table">
            <table class="table__content">
                <caption><i class="fas fa-clipboard-list"></i> THÔNG TIN VẬN CHUYỂN</caption>
                <thead>
                    <tr>
                        <th>Tên người nhận</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Ghi chú</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $rowsp["shipping_name"]; ?></td>
                        <td><?php echo $rowsp["shipping_address"]; ?></td>
                        <td><?php echo $rowsp["shipping_phone"]; ?></td>
                        <td><?php echo $rowsp["shipping_email"]; ?></td>
                        <td><?php echo $rowsp["shipping_notes"]; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="table">
            <table class="table__content">
                <caption><i class="fas fa-clipboard-list"></i> TÊN KHÁCH HÀNG</caption>
                <thead>
                    <tr>
                        <th>Tên khách hàng</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $rowcm["customer_name"]; ?></td>
                        <td><?php echo $rowcm["customer_email"]; ?></td>
                        <td><?php echo $rowcm["customer_phone"]; ?>đ</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php if($rowOd["order_status"] <= 2){?>
            <div class="btn-remove-order">
                <a href="pages/frontend/xulydonhang.php"  class="btn btn--primary">Huỷ đơn hàng</a>
            </div>
        <?php }else{ ?>
            <div class="btn-remove-order">
                <a href="pages/frontend/xulydonhang.php"  class="btn btn--primary btn--remove">Huỷ đơn hàng</a>
            </div>
        <?php } ?>
    </div>
</div>
<?php }else{ header('Location:home.php');} ?>