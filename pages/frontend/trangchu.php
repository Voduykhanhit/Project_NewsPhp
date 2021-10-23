<?php
    if(isset($_GET["pages"])){
        $pages = $_GET["pages"];
    }else{
        $pages = 1;
    }
    $rowPerPage = 15;
    $perRow = $pages*$rowPerPage - $rowPerPage;
    $TotalRow = mysqli_num_rows(mysqli_query($data->conn,"SELECT *FROM `tbl_product`"));
    $TotalPage = ceil($TotalRow/$rowPerPage);
    $listPage = "";
    for($i=1;$i<=$TotalPage;$i++){
        if($pages == $i){
            $listPage .= '<a href="home.php?pages='.$i.'" class="btn home-paginate__link home-paginate__link--active">'.$i.'</a>';
        }else{
            $listPage .= '<a href="home.php?pages='.$i.'" class="btn home-paginate__link">'.$i.'</a>';
        }
    }
?>
<div class="grid">
    <div class="grid__row">
        <!-- Menu -->
        <?php include_once "./layout/fe/menu.php"; ?>
        <!-- end Menu -->
        <div class="grid__column-10">
            <div class="home-filter">
                <span class="home-filter__label">Sắp xếp theo</span>
                <button class="home-filter__btn btn">Phổ biến</button>
                <button class="home-filter__btn btn btn--primary">Mới nhất</button>
                <button class="home-filter__btn btn">Bán chạy</button>
                <div class="select-input">
                    <span class="select-input__label">Giá</span>
                    <i class="select-input__icon fas fa-chevron-down"></i>
                    <ul class="select-input__list">
                        <li class="select-input__item">
                            <a href="home.php?price=asc" id="asc" class="select-input__link">Giá : Thấp đến Cao</a>
                        </li>
                        <li class="select-input__item">
                            <a href="home.php?price=desc" id="desc" class="select-input__link">Giá : Cao đến Thấp</a>
                        </li>
                        <li class="select-input__item">
                            <a href="home.php?price=0" id="desc" class="select-input__link">Giá : Dưới 1tr</a>
                        </li>
                        <li class="select-input__item">
                            <a href="home.php?price=1" id="desc" class="select-input__link">Giá : 1tr - 5tr</a>
                        </li>
                        <li class="select-input__item">
                            <a href="home.php?price=2" id="desc" class="select-input__link">Giá : 5tr - 10tr</a>
                        </li>
                        <li class="select-input__item">
                            <a href="home.php?price=3" id="desc" class="select-input__link">Giá : 10tr - 15tr</a>
                        </li>
                        <li class="select-input__item">
                            <a href="home.php?price=4" id="desc" class="select-input__link">Giá : 15tr - 20tr</a>
                        </li>
                        <li class="select-input__item">
                            <a href="home.php?price=5" id="desc" class="select-input__link">Giá : 20tr - 25tr</a>
                        </li>
                        <li class="select-input__item">
                            <a href="home.php?price=6" id="desc" class="select-input__link">Giá : Trên 25tr</a>
                        </li>
                    </ul>
                </div>
                <div class="home-filter__page">
                    <span class="home-filter__page-number">
                        <span class="home-filter__page-current">1</span>/14
                    </span>
                    <div class="home-filter__page-control">
                        <a href="" class="home-filter__page-btn home-filter__page-btn--active">
                            <i class="home-filter__page-icon fas fa-angle-left"></i>
                        </a>
                        <a href="" class="home-filter__page-btn">
                            <i class="home-filter__page-icon fas fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="home-product">
                <div class="grid__row">
                    <!-- grid__column-2-4 -->
                    <?php
                        if(isset($_GET["price"])){
                            $price = $_GET["price"];
                            switch($price){
                                case "asc": $listproduct = $home->GiaThapDenCao($perRow,$rowPerPage);
                                    break;
                                case "desc": $listproduct = $home->GiaCaoDenThap($perRow,$rowPerPage);
                                    break;
                                case "0": $listproduct = $home->DuoiMotTrieu($perRow,$rowPerPage);
                                    break;
                                case "1": $listproduct = $home->MotDenNam($perRow,$rowPerPage);
                                    break;
                                case "2": $listproduct = $home->NamDenMuoi($perRow,$rowPerPage);
                                    break;
                                case "3": $listproduct = $home->MuoiDen15($perRow,$rowPerPage);
                                    break;
                                case "4": $listproduct = $home->MuoiLamDen20($perRow,$rowPerPage);
                                    break;
                                case "5": $listproduct = $home->HaiMuoiDen25($perRow,$rowPerPage);
                                    break;
                                case "6": $listproduct = $home->LonHon25($perRow,$rowPerPage);
                                    break;
                                default: $listproduct = $home->DanhSachSanPham($perRow,$rowPerPage);
                            }
                        }else{
                            $listproduct = $home->DanhSachSanPham($perRow,$rowPerPage);
                        }
                        if(isset($_GET["price"]) && $_GET["price"] == "asc"){
                            $listproduct = $home->GiaThapDenCao($perRow,$rowPerPage);
                            unset($_GET["price"]);
                        }else if( isset($_GET["price"]) && $_GET["price"] == "desc" ){
                            $listproduct = $home->GiaCaoDenThap($perRow,$rowPerPage);
                            unset($_GET["price"]);
                        }else{
                            
                        }
                        while($row = mysqli_fetch_array($listproduct)){
                    ?>
                        <div class="grid__column-2-4">
                            <div class="home-product__cart-list">
                                <!-- header cart -->
                                <a href="home.php?p=details&idProduct=<?php echo $row["product_id"]; ?>">
                                    <div class="home-product__header">
                                        <span class="home-product__header-favourite">Yêu thích <i class="home-product__header-favourite-icon fas fa-check"></i></span>
                                        <img src="upload/sanpham/<?php echo $row["product_image"] ?>" class="home-product__header-img" alt="">
                                        <div class="home-product__header-sale">
                                            <span class="home-product__header-sale-percent">10%</span>
                                            <span class="home-product__header-sale-status">Giảm</span>
                                        </div>
                                    </div>
                                </a>
                                <!-- end header -->
                                <div class="home-product__body">
                                    <span class="home-product__body-title"><?php echo $row["product_name"]; ?></span>
                                    <!-- price -->
                                    <div class="home-product__body-price">
                                        <del class="home-product__body-price-old"><?php echo number_format((float) $row["product_price"]*1.1); ?></del>
                                        <span class="home-product__body-price-curent"><?php echo number_format($row["product_price"]);?></span>
                                    </div>
                                    <!-- end price -->
                                    <!-- Vote Rate -->
                                    <div class="home-product__body-vr">
                                        <span class="home-product__body-rate home-product__body-rate--liked">
                                            <i class="far fa-heart home-product__body-rate-icon-empty"></i>
                                            <i class="fas fa-heart home-product__body-rate-icon-fill"></i>
                                        </span>
                                        <div class="home-product__body-vote">
                                            <i class="home-product__body-vote-icon-gold fas fa-star"></i>
                                            <i class="home-product__body-vote-icon-gold fas fa-star"></i>
                                            <i class="home-product__body-vote-icon-gold fas fa-star"></i>
                                            <i class="home-product__body-vote-icon-gold fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <!-- <i class="fas fa-star"></i> -->
                                        </div>
                                        <span class="home-product__body-rate__sold">66 đã bán</span>
                                    </div>
                                    <!-- end Vote rate -->
                                    <!-- Brand -->
                                    <div class="home-product__body-brand">
                                        <span class="home-product__body-brand-name">Whoo</span>
                                        <span class="home-product__body-brand-name">Hàn Quốc</span>
                                    </div>
                                    <!-- endBrand -->
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- end grid__column-2-4 -->
                </div>
            </div>
            <ul class="home-paginate">
                <li class="home-paginate__item">
                    <?php
                        if($pages < 2){

                        }else{
                            $backPage = $pages -1;
                    ?>
                        <a href="home.php?pages=<?php echo $backPage; ?>" class="btn home-paginate__link ">
                            <i class="fas fa-angle-left home-paginate__link-icon-backpage"></i>
                        </a>
                    <?php } ?>

                   <?php echo $listPage; ?>

                   <?php if($pages == $TotalPage){

                   }else{
                       $nextpage = $pages + 1;
                    ?>
                        <a href="home.php?pages=<?php echo $nextpage; ?>" class="btn home-paginate__link">
                            <i class="home-paginate__link-icon-nextpage fas fa-angle-right"></i>
                        </a>
                    <?php } ?>
                </li>
            </ul>
        </div>
    </div>
</div>