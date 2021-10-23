<?php
    if(isset($_POST["idAddCart"]) && isset($_POST["quantity"])){
        $rowId = $_POST["idAddCart"];
        $quantity = $_POST["quantity"];
        $produdct = $home->ChiTietSanPham($rowId);
        $rowPd = mysqli_fetch_array($produdct);
        if(isset($_SESSION["cart"][$rowId])){
            if($rowPd["product_quantity"] < $_SESSION["cart"][$rowId]["qty"]){
                $_SESSION["erCart"] = "Sản phẩm không đủ số lượng để thêm vào giỏ!!!";
            }else{
                $_SESSION["cart"][$rowId]["qty"] += $quantity;
            }
        }else{
            if($rowPd["product_quantity"] < $quantity){
                $_SESSION["erCart"] = "Sản phẩm không đủ số lượng để thêm vào giỏ!!!";
            }else{
                $item = [
                    "id"=>$rowPd["product_id"],
                    "name"=>$rowPd["product_name"],
                    "qty"=>$quantity,
                    "price"=>$rowPd["product_price"],
                    "options"=>[
                        "image"=>$rowPd["product_image"]
                    ]
                ];
                $_SESSION["cart"][$rowId]=$item;
            }
        }
        $url = "home.php?p=details&idProduct=".$rowId;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    if(isset($_GET["DelCart"])){
        $rowId = $_GET["DelCart"];
        unset($_SESSION["cart"][$rowId]);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
?>