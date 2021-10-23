<?php
    if(isset($_SESSION["user"])){
        $cm_id = $_SESSION["user"]["customer_id"];
        $order = $home->HoaDon($cm_id);
?>
<div class="grid">
    <div class="table">
        <table class="table__content">
            <caption><i class="fas fa-clipboard-list"></i> HOÁ ĐƠN CỦA BẠN</caption>
            <thead>
                <tr>
                    <th>Mã hoá đơn</th>
                    <th>Tên khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Ngày đặt</th>
                    <th>Chi tiết</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_array($order)){ ?>
                    <tr>
                        <td><?php echo $row["order_code"]; ?></td>
                        <td><?php echo $row["customer_name"]; ?></td>
                        <td><?php echo $row["order_total"]; ?>đ</td>
                        <td>
                            <?php 
                                if($row["order_status"] == 1){
                                    echo "Đơn hàng mới";
                                }else if($row["order_status"] == 2){
                                    echo "Đang xác nhận";
                                }
                                else if($row["order_status"] == 3){
                                    echo "Đã huỷ";
                                }
                                else if($row["order_status"] == 4){
                                    echo "Đóng gói sản phẩm";
                                }
                                else if($row["order_status"] == 5){
                                    echo "Chờ nhận hàng";
                                }else if($row["order_status"] == 6){
                                    echo "Đang chuyển";
                                }else if($row["order_status"] == 7){
                                    echo "Thất bại";
                                }else if($row["order_status"] == 8){
                                    echo "Đang chuyển hoàn";
                                }else if($row["order_status"] == 9){
                                    echo "Đã chuyển hoàn";
                                }else{
                                    echo "Thành công";
                                }
                            ?>
                        </td>
                        <td><?php echo $row["created_at"]; ?></td>
                        <td><a href="home.php?p=order_details&order_code=<?php echo $row["order_code"]; ?>" class="table__link"><i class="far fa-eye"></i> Xem hoá đơn</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php }else{ header('Location:home.php');} ?>