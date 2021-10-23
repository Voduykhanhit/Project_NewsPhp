<?php
    if(isset($_GET['idProduct'])){
        $idProduct = $_GET['idProduct'];
    }else{
        $idProduct = "";
    }
    $details = $home->ChiTietSanPham($idProduct);
    $rowdt = mysqli_fetch_array($details);
    $comment = $home->DanhSachBinhLuan($idProduct);
    $reply = $home->TraLoiBinhLuan();
?>
<div class="grid">
    <!-- CARD DETAILS -->
    <div class="card-details">
        <div class="grid__row">
            <div class="grid__column-5">
                <img src="./upload/sanpham/<?php echo $rowdt["product_image"]; ?>" alt="" class="card-details__image-product">
                <div class="card-details__social">
                    <span class="card-details__social-label">Chia sẻ:</span>
                    <a href="" class="card-details__social-link"><i class="fab fa-facebook-messenger card-details__social-icon-mes"></i></a>
                    <a href="" class="card-details__social-link"><i class="fab fa-facebook card-details__social-icon-facebook"></i></a>
                    <a href="" class="card-details__social-link"><i class="fab fa-pinterest card-details__social-icon-pinterest"></i></a>
                    <a href="" class="card-details__social-link"><i class="fab fa-twitter-square card-details__social-icon-square"></i></a>
                </div>
            </div>
            <div class="grid__column-7">
                <span class="label-btn card-details__label--right">Yêu thích</span>
                <h3 class="card-details__product-name"><?php echo $rowdt["product_name"]; ?></h3>
                <div class="card-details__vote">
                    <div class="card-details__vote-item">
                        <span class="card-details__vote-qty">4.8</span>
                        <i class="home-product__body-vote-icon-gold fas fa-star"></i>
                        <i class="home-product__body-vote-icon-gold fas fa-star"></i>
                        <i class="home-product__body-vote-icon-gold fas fa-star"></i>
                        <i class="home-product__body-vote-icon-gold fas fa-star"></i>
                        <i class="home-product__body-vote-icon-gold fas fa-star"></i>
                    </div>
                    <div class="card-details__vote-item">
                        <span class="card-details__vote-qty">1k</span>
                        <span class="card-details__vote-active">Đánh giá</span>
                    </div>
                    <div class="card-details__vote-item">
                        <span class="card-details__vote-qty">4,3k</span>
                        <span class="card-details__vote-active">Đã bán</span>
                    </div>
                </div>
                <div class="card-details__price">
                    <span class="card-details__price-old">&#8363;<?php echo number_format($rowdt["product_price"]*1.1) ?></span>
                    <span class="card-details__price-curent">&#8363;<?php echo number_format($rowdt["product_price"]) ?></span>
                    <span class="label-btn card-details__price--sale">10% Giảm</span>
                </div>
                <form action="home.php?p=cart" method="post" class="form-details">
                    <div class="card-details__qty">
                        <span class="card-details__qty-label">Số lượng</span>
                        <div class="card-details__qty-btn">
                            <button class="btn btn--qty" onclick="sub()">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="hidden" name="idAddCart" value="<?php echo $rowdt["product_id"]; ?>">
                            <input type="text" id="QtyDetails" name="quantity" class="card-details__qty-input" value="1">
                            <button class="btn btn--qty" id="Add" onclick="add()">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <span class="card-details__qty-label"><?php echo $rowdt["product_quantity"]; ?> sản phẩm có sẵn</span>
                    </div>
                    <div class="card-details__btn">
                        <button type="submit" class="btn btn--cart"><i class="fas fa-cart-plus card-details__btn-icon"></i> Thêm vào giỏ</a>
                        <button class="btn btn--primary btn--checkout">Thanh Toán</button>
                    </div>
                </form>
            </div>
            <!-- end column -->
        </div>
    </div>
    <!-- END CARD -->
    <!-- SELLER -->
    <div class="card-seller">
        <div class="card-seller__introduce">
            <div class="card-seller__avatar">
                <img src="https://cf.shopee.vn/file/819e3fc4971d61dcb6e99d5de5e14fda_tn" alt="" class="card-seller__img">
                <span class="card-seller__story">Yêu thích</span>
            </div>
            <div class="card-seller__info">
                <span class="card-seller__info-name">phukiensohathanh</span>
                <span class="card-seller__info-time">Online 8 Phút trước</span>
                <div class="card-seller__info-btn">
                    <button class="btn btn--cart btn--cart-chat"><i class="fas fa-comments card-seller__info-icon"></i> Chat Ngay</button>
                    <button class="btn btn--view"><i class="fas fa-home"></i> Xem Shop</button>
                </div>
            </div>
        </div>
        <div class="card-seller__vote"> 
            <ul class="card-seller__list">
                <li class="card-seller__item">
                    <span class="card-seller__item-label">Đánh giá</span>
                    <a href="" class="card-seller__item-link">9,4k</a>
                </li>
                <li class="card-seller__item">
                    <span class="card-seller__item-label">Tỉ Lệ Phản Hồi</span>
                    <a href="" class="card-seller__item-link">89%k</a>
                </li>
                <li class="card-seller__item">
                    <span class="card-seller__item-label">Tham gia</span>
                    <a href="" class="card-seller__item-link">34 tháng trước</a>
                </li>
                <li class="card-seller__item">
                    <span class="card-seller__item-label">Sản phẩm</span>
                    <a href="" class="card-seller__item-link">168</a>
                </li>
                <li class="card-seller__item">
                    <span class="card-seller__item-label">Thời Gian Phản Hồi</span>
                    <a href="" class="card-seller__item-link">trong vài giờ</a>
                </li>
                <li class="card-seller__item">
                    <span class="card-seller__item-label">Người Theo Dõi</span>
                    <a href="" class="card-seller__item-link">14k</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END SELLER -->
    <!-- PRODUCT INFO -->
    <div class="info-product">
        <div class="info-product__title">
            <h3 class="info-product__heading">CHI TIẾT SẢN PHẨM</h3>
        </div>
        <div class="info-product__details">
            <span class="info-product__details-label">Danh mục</span>
            <span class="info-product__details-content"><?php echo $rowdt["category_name"];?></span>
        </div>
        <div class="info-product__title">
            <h3 class="info-product__heading">MÔ TẢ SẢN PHẨM</h3>
        </div>
        <div class="info-product__des">
            <span class="info-product__des-content">
<?php echo $rowdt["product_desc"]; ?>
            </span>
        </div>
    </div>
    <!-- END PRODUCT INFO -->
    <!-- COMMENT -->
    <div class="wrap-comment">
        <h2 class="wrap-comment__title">ĐÁNH GIÁ SẢN PHẨM</h2>
        <div class="wrap-comment__vote">
            <div class="wrap-comment__vote-qty">
                <div class="wrap-comment__vote-ratings">
                    <span class="wrap-comment__vote-score">5</span>
                    <span class="wrap-comment__vote-score-out-of">trên 5</span>
                </div>
                <div class="wrap-comment__vote-rating-icon">
                    <i class="home-product__body-vote-icon-red fas fa-star"></i>
                    <i class="home-product__body-vote-icon-red fas fa-star"></i>
                    <i class="home-product__body-vote-icon-red fas fa-star"></i>
                    <i class="home-product__body-vote-icon-red fas fa-star"></i>
                    <i class="home-product__body-vote-icon-red fas fa-star"></i>
                </div>
            </div>
            <div class="wrap-comment__vote-filter">
                <button class="btn wrap-comment__vote-filter-btn wrap-comment__vote-filter-btn--active">Tất cả</button>
                <button class="btn wrap-comment__vote-filter-btn">5 sao(13)</button>
                <button class="btn wrap-comment__vote-filter-btn">4 Sao (0)</button>
                <button class="btn wrap-comment__vote-filter-btn">3 Sao (0)</button>
                <button class="btn wrap-comment__vote-filter-btn">2 Sao (0)</button>
                <button class="btn wrap-comment__vote-filter-btn">1 Sao (0)</button>
                <button class="btn wrap-comment__vote-filter-btn">Có Bình Luận (6)</button>
                <button class="btn wrap-comment__vote-filter-btn">Có Hình Ảnh / Video (3)</button>
            </div>
        </div>
        <!-- User comment -->
        <?php
            while($rowcm = mysqli_fetch_array($comment)){
        ?>
            <div class="wrap-comment__user">
                <img src="https://cf.shopee.vn/file/c0467f7fda533aec108617f3f542e85c_tn" alt="Ảnh đại diện người dùng" class="wrap-comment__user-img">
                <div class="wrap-comment__user-info">
                    <span class="wrap-comment__user-name"><?php echo $rowcm["comments_name"]; ?></span>
                    <div class="wrap-comment__user-info-vote">
                        <i class="home-product__body-vote-icon-gold fas fa-star"></i>
                        <i class="home-product__body-vote-icon-gold fas fa-star"></i>
                        <i class="home-product__body-vote-icon-gold fas fa-star"></i>
                        <i class="home-product__body-vote-icon-gold fas fa-star"></i>
                        <i class="home-product__body-vote-icon-gold fas fa-star"></i>
                    </div>
                    <span class="wrap-comment__user-info-sectors">Phân loại hàng: Trắng, 4L BH 12 Tháng</span>
                    <span class="wrap-comment__user-info-comment"><?php echo $rowcm["comments_content"]; ?></span>
                    <ul class="wrap-comment__list-img-product">
                        <li class="wrap-comment__item-img-product"><img src="https://cf.shopee.vn/file/050595676342d4f22fa4ca8b4411b027_tn" alt="" class="wrap-comment__img-product"></li>
                        <li class="wrap-comment__item-img-product"><img src="https://cf.shopee.vn/file/8ddf79eb95429c3f9980238d2ff4e653_tn" alt="" class="wrap-comment__img-product"></li>
                        <li class="wrap-comment__item-img-product"><img src="https://cf.shopee.vn/file/bdb5ac42cc524d2f453cd74425384261_tn" alt="" class="wrap-comment__img-product"></li>
                        <li class="wrap-comment__item-img-product"><img src="https://cf.shopee.vn/file/e3c865f7ce87354bc3ba90957865c04c_tn" alt="" class="wrap-comment__img-product"></li>
                    </ul>
                    <span class="wrap-comment__user-info-comment-time"><?php echo $rowcm["created_at"]; ?></span>
                    <?php 
                        while($rowrl = mysqli_fetch_array($reply)){
                            if($rowcm['comments_id'] == $rowrl["comments_id"]){
                    ?>
                        <div class="wrap-comment__seller">
                            <span class="wrap-comment__seller-name"><?php echo $rowrl["admin_name"];?></span>
                            <span class="wrap-comment__seller-reply"><?php echo $rowrl["reply_content"];?></span>
                        </div>
                    <?php }
                        } 
                ?>
                    <div class="wrap-comment__like">
                        <span class="wrap-comment__like-icon-qty"><i class="far fa-thumbs-up wrap-comment__like-icon-like"></i> 1</span>
                        <i class="fas fa-ellipsis-v wrap-comment__like-icon-report"></i>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!-- end user comment -->
    </div>
    <!-- COMMENT -->
</div>