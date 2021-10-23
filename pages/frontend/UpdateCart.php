<?php
session_start();
    include "../../lib/Func.php";
    include "../../lib/dbConnect.php";

    $home = new Handle;
    $data = new Connect;

    if(isset($_POST["action"])){
        $rowId = $_POST['rowId'];
        $qty = $_POST['qty'];
        $findPd = $home->ChiTietSanPham($rowId);
        $rowPdUd = mysqli_fetch_array($findPd);
        if($rowPdUd["product_quantity"] >= $qty){
            if($_POST["action"] == "qtyAdd"){
                $_SESSION["cart"][$rowId]["qty"] +=1;
            }else if($_POST["action"] == "qtySub"){
                $_SESSION["cart"][$rowId]["qty"] -=1;
            }
        }else{
            $errors = "Sản phẩm không đủ số lượng";
            echo $errors;
        }
    }

?>