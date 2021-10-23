<?php
    session_start();
    include "../../lib/dbConnect.php";
    include "../../lib/Func.php";
    $home = new Handle;
    if(isset($_POST["action"])){
        $action = $_POST["action"];
        $maid = $_POST["maid"];
        $output="";
        if($action == "Tinh"){
            $SelectHuyen = $home->QuanHuyen($maid);
            foreach($SelectHuyen as $value){
                $output .= '<option value="'.$value['maqh'].'">'.$value['name_quanhuyen'].'</option>';
            }
        }else{
            $SelectXa = $home->XaPhuong($maid);
            foreach($SelectXa as $value){
                $output .= '<option value="'.$value['xaid'].'">'.$value['name_xaphuong'].'</option>';
            }
        }
    }
    if(isset($_POST["feeship"]) && isset($_POST["matp"]) && isset($_POST["maqh"]) && isset($_POST["xaid"])){
        $matp = $_POST['matp'];
        $maqh = $_POST['maqh'];
        $xaid = $_POST['xaid'];
        $pvc = $home->PhiVanChuyen($matp,$maqh,$xaid);
        $row = mysqli_fetch_array($pvc);
        $_SESSION["fee"] = $row["fee_feeship"];
    }
    echo $output;
?>