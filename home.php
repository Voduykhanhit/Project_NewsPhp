<?php
    session_start();
    if(isset($_GET['p'])){
        $p = $_GET['p'];
    }else{
        $p = "";
    }
?>
<?php
    ob_start();
    require "./lib/dbConnect.php";
    require "./lib/Func.php";
    $home = new Handle;
    $data = new Connect;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Home</title>
    <!-- reset CSS -->
    <link rel="stylesheet" href="./public/frontend/css/normalize.min.css">
    <link rel="stylesheet" href="./public/frontend/css/base.css">
    <link rel="stylesheet" href="./public/frontend/css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./public/frontend/fonts/fontawesome-free-5.15.3-web/css/all.min.css">

</head>
<body>
    <!-- Block Element Modifier:dùng thay đổi Element Block__element--modifier -->
    <div class="app">
       <?php include "./layout/fe/header.php"; ?>
        <div class="container">
            <?php if(isset($_SESSION['erCart'])){ $mes = $_SESSION['erCart'];?>
                <div class="grid">
                    <div class="alert alert--danger mt-2 mb-2" id="alert"><?php echo $mes; ?></div>
                </div>
            <?php unset($_SESSION['erCart']);}else if(isset($_SESSION["msg"])){ $mes = $_SESSION["msg"]; ?>
                <div class="grid">
                    <div class="alert alert--danger mt-2 mb-2" id="alert"><?php echo $mes; ?></div>
                </div>
            <?php unset($_SESSION["msg"]); } ?>
            <?php if(isset($_SESSION['erCheckOut'])){ $mes = $_SESSION['erCart'];?>
                <div class="grid">
                    <div class="alert alert--danger mt-2 mb-2" id="alert"><?php echo $mes; ?></div>
                </div>
            <?php unset($_SESSION['erCheckOut']);} ?>  
            <!-- content -->
           <?php
                switch($p){
                    case "/": include_once "./pages/frontend/trangchu.php";
                        break;
                    case "details": include_once "./pages/frontend/details.php";
                        break;
                    case "cart": include_once "./pages/frontend/CartHandle.php";
                        break;
                    case "viewcart": include_once "./pages/frontend/giohang.php";
                        break;
                    case "category": include_once "./pages/frontend/danhmucsanpham.php";
                        break;
                    case "register": include_once "./pages/frontend/dangky.php";
                        break;
                    case "login": include_once "./pages/frontend/dangnhap.php";
                        break;
                    case "logout": include_once "./pages/frontend/dangxuat.php";
                        break;
                    case "checkout": include_once "./pages/frontend/thanhtoan.php";
                        break;
                    case "complete": include_once "./pages/frontend/thanhcong.php";
                        break;
                    case "infocus": include_once "./pages/frontend/thongtinkhachhang.php";
                        break;
                    case "priceproduct": include_once "./pages/frontend/locgia.php";
                        break;
                    case "order": include_once "./pages/frontend/donhang.php";
                        break;
                    case "order_details": include_once "./pages/frontend/chitietdonhang.php";
                        break;
                    default: include_once "./pages/frontend/trangchu.php";
                }
           ?>
           <!-- end content -->
        </div>
        <?php include_once "./layout/fe/footer.php" ?>
    </div>
    <!-- Modal layout -->
    <!-- <div class="modal">
        <div class="modal__overlay"></div>
        <div class="modal__body">
                
            <div class="auth-form">
                <div class="auth-form__container">
                    <div class="auth-form__header">
                        <h3 class="auth-form__heading">Đăng ký</h3>
                        <button class="auth-form__btn-heading">Đăng nhập</button>
                    </div>
                    <form action="" class="auth-form__form">
                        <div class="auth-form__row">
                            <input type="text" class="auth-form__input" placeholder="Nhập email của bạn">
                        </div>
                        <div class="auth-form__row">
                            <input type="password" class="auth-form__input" placeholder="Nhập mật khẩu của bạn">
                        </div>
                        <div class="auth-form__row">
                            <input type="password" class="auth-form__input" placeholder="Nhập lại mật khẩu">
                        </div>
                    </form>
                    <div class="auth-form__aside">
                        <p class="auth-form__note">
                            Bằng việc đăng kí, bạn đã đồng ý với Shopee về
                            <a href="" class="auth-form__text-link">Điều khoản dịch vụ</a> &
                            <a href="" class="auth-form__text-link">Chính sách bảo mật</a>
                        </p>
                    </div>
                    
                    <div class="auth-form__control">
                        <button class="btn auth-form__control-back btn-normal">TRỞ LẠI</button>
                        <button class="btn btn--primary">ĐĂNG KÝ</button>
                    </div>
                </div>
                <div class="auth-form__social">
                    <a class="auth-form__social--facebook btn btn--size-s btn--with-icon"><i class="auth-form__social-icons fab fa-facebook-square"></i> <span class="auth-form__social-tittle"> Kết nối với FaceBook</span></a>
                    <a class="auth-form__social--google btn btn--size-s btn--with-icon"><img src="./public/frontend/img/iconGG.png" class="auth-form__social-icons-gg" alt=""><span class="auth-form__social-tittle">Kết nối với Google</span></a>
                </div> 
            </div>
            
            <div class="auth-form">
                <div class="auth-form__container">
                    <div class="auth-form__header">
                        <h3 class="auth-form__heading">Đăng nhập</h3>
                        <button class="auth-form__btn-heading">Đăng ký</button>
                    </div>
                    <form action="" class="auth-form__form">
                        <div class="auth-form__row">
                            <input type="text" class="auth-form__input" placeholder="Nhập email của bạn">
                        </div>
                        <div class="auth-form__row">
                            <input type="password" class="auth-form__input" placeholder="Nhập mật khẩu của bạn">
                        </div>
                    </form>
                    <div class="auth-form__aside">
                        <div class="auth-form__help">
                            <a href="" class="auth-form__help-link auth-form__help">Quên mật khẩu</a>
                            <a href="" class="auth-form__help-link">Cần trợ giúp?</a>
                        </div>
                    </div>
                    
                    <div class="auth-form__control">
                        <button class="btn auth-form__control-back btn-normal">TRỞ LẠI</button>
                        <button class="btn btn--primary">ĐĂNG KÝ</button>
                    </div>
                </div>
                <div class="auth-form__social">
                    <a class="auth-form__social--facebook btn btn--size-s btn--with-icon"><i class="auth-form__social-icons fab fa-facebook-square"></i> <span class="auth-form__social-tittle"> Kết nối với FaceBook</span></a>
                    <a class="auth-form__social--google btn btn--size-s btn--with-icon"><img src="./public/frontend/img/iconGG.png" class="auth-form__social-icons-gg" alt=""><span class="auth-form__social-tittle">Kết nối với Google</span></a>
                </div> 
            </div>
        </div>
    </div> -->
    <script src="./public/frontend/js/jquery.min.js"></script>
    <script>
        var i=0;
        function add(){
            var value = parseInt(document.getElementById('QtyDetails').value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            document.getElementById('QtyDetails').value = value;
        }
        function sub(){
            document.getElementById('QtyDetails').value -= 1;
        }
    </script>
    <script>
        $(document).ready(function(){
            window.setTimeout( ()=>{
                $('#alert').remove();
            },4000);
            $(document).on('click','.btn--add-qty',function(){
                var action = "qtyAdd";
                var value = $(this).parent().find('.card-details__qty-input').val();
                var rowId = $(this).data('id');
                $.ajax({
                    url:"pages/frontend/UpdateCart.php",
                    data:{action:action,rowId:rowId,qty:value},
                    method:"POST",
                    success:function(data){
                        if(data != ""){
                            alert(data);
                        }else{
                            window.location.reload();
                        }
                    }
                });
            });
            $(document).on('click','.btn--sub-qty',function(){
                var action = "qtySub";
                var value = $(this).parent().find('.card-details__qty-input').val();
                var rowId = $(this).data('id');
                if(value < 2){
                    alert('Số lượng nhỏ nhất đã là 1 bạn không được giảm thêm');
                }else{  
                    $.ajax({
                        url:"pages/frontend/UpdateCart.php",
                        data:{action:action,rowId:rowId,qty:value},
                        method:"POST",
                        success:function(data){
                            if(data != ""){
                                alert(data);
                            }else{
                                window.location.reload();
                            }
                        }
                    });
                }
                
            });
            // Select quận huyện
            $('.chon').on('change',function(){
                var action = $(this).attr('id');
                var matp = $(this).val();
                var result = '';
                if(action =='Tinh')
                {
                    result = 'Huyen';
                }else{
                    result = 'Xa';
                }
                $.ajax({
                    url:'pages/frontend/SelectQuan.php',
                    method:'POST',
                    data:{maid:matp,action:action},
                    success:function(data){
                        $('#'+result).html(data);
                    }
                });
            });
            //Tính phí vận chuyển
            $('#feeship').on('click',function(){
                var feeship = "FeeShip";
                var matp = $('#Tinh').val();
                var maqh = $('#Huyen').val();
                var xaid = $('#Xa').val();
                $.ajax({
                    url:'pages/frontend/SelectQuan.php',
                    method:'POST',
                    data:{matp:matp,maqh:maqh,xaid:xaid,feeship:feeship},
                    success:function(data){
                       window.location.reload();
                    }
                });
            });
            $('#Example').change(function(){
                if($(this).is(":checked")){
                    $('.txtvalue').removeAttr('disabled');
                }else{
                    $('.txtvalue').attr('disabled','');
                }
            });
        });
    </script>
</body>
</html>



