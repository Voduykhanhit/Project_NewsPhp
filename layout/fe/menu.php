<div class="grid__column-2">
    <nav class="category">
        <h3 class="category__title"><i class="fas fa-list-ul category__title-icon"></i> Danh mục</h3>
        <ul class="category-list">
            <?php
                $Category = $home->DanhSachDanhMuc();
                while($rowctg = mysqli_fetch_array($Category)){
            ?>
            <li class="category-item">
                <a href="home.php?p=category&idCate=<?php echo $rowctg["category_id"]; ?>" class="category-item__link"><?php echo $rowctg["category_name"]; ?></a>
            </li>
            <?php } ?>
        </ul>
    </nav>
</div>