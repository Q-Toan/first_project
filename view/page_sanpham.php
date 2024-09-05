<main>
    <div class="container-danhmuc">
        <div class="danhmuc-top row">
            <p><a href="?mod=page&act=home">Trang chủ</a></p><i class="fa-solid fa-angle-right"></i>
            <p>Sản phẩm</p>
        </div>
    </div>
    <section class="danhmuc">
        <div class="container-danhmuc">
            <div class="row">
                <div class="danhmuc-left">
                    <form action="" id="search" method="POST">
                        <input type="hidden" name="mod" value="product">
                        <input type="hidden" name="act" value="search">
                        <input type="text" name="keyword" placeholder="bạn cần tìm ?">
                        <input type="submit" name="submit" id="search" value="Tìm">
                    </form>
                    <ul>
                        <h4>DANH MỤC</h4>
                        <?php foreach ($data['dsdm'] as $dm) : ?>
                            <li class="danhmuc-left-li">
                                <a href="index.php?mod=product&act=detail&id=<?= $dm['madm'] ?>">
                                    <?= $dm['tendm'] ?>
                                </a>
                                <hr color="#ddd">
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="danhmuc-right row">
                    <div class="danhmuc-right-top-item">
                        <p>SẢN PHẨM MỚI</p>
                    </div>
                    <div class="danhmuc-right-top-item">
                        <button><span>Bộ lọc</span><i class="fa-solid fa-caret-down"></i></button>
                    </div>
                    <div class="danhmuc-right-top-item">
                        <select name="sort" id="sort-select" onchange="sortProducts()">
                            <option value="default">Sắp xếp</option>
                            <option value="high-to-low">giá cao - thấp</option>
                            <option value="low-to-high">giá thấp - cao</option>
                        </select>
                    </div>
                    <script>
                        function sortProducts() {
                            const sortSelect = document.getElementById('sort-select');
                            const productContainer = document.querySelector('.danhmuc-right-content');
                            const products = Array.from(productContainer.getElementsByClassName('danhmuc-right-content-item'));
                            products.sort((a, b) => {
                                const priceA = parseFloat(a.querySelector('span').textContent.replace('đ', '').replace(',', ''));
                                const priceB = parseFloat(b.querySelector('span').textContent.replace('đ', '').replace(',', ''));
                                if (sortSelect.value === 'high-to-low') {
                                    return priceB - priceA;
                                } else if (sortSelect.value === 'low-to-high') {
                                    return priceA - priceB;
                                }
                                return 0;
                            });
                            productContainer.innerHTML = '';
                            products.forEach(product => productContainer.appendChild(product));
                        }zz
                    </script>
                    <div class="danhmuc-right-content row">
                        <?php
                        // Sắp xếp mảng sản phẩm theo thứ tự giảm dần của ngày thêm vào
                        usort($data['dssp'], function ($a, $b) {
                            return strtotime($b['ngaytao']) - strtotime($a['ngaytao']);
                        });
                        $count = 0; // Biến đếm số sản phẩm
                        foreach ($data['dssp'] as $sp) :
                            if ($count < 8) : // Hiển thị chỉ khi số lượng sản phẩm chưa đạt 4
                        ?>
                                <div class="danhmuc-right-content-item">
                                    <a href="?mod=product&act=ctsanpham&id=<?= $sp['masp'] ?>"><img src="upload/product/<?= $sp['anh'] ?>"><br></a>
                                    <p>Mã: <?= $sp['masp'] ?><span><?= $sp['khuyenmai'] ?>đ</span></p>
                                    <!-- <p><del><?= $sp['dongia'] ?>đ</del><span><?= $sp['khuyenmai'] ?>đ</span></p> -->
                                    <a href="">
                                        <h3><?= $sp['tensp'] ?></h3>
                                    </a>
                                </div>
                        <?php
                                $count++; // Tăng biến đếm sau mỗi sản phẩm
                            endif;
                        endforeach;
                        ?>
                    </div>
                    <div class="danhmuc-right-bottom row">
                        <div class="danhmuc-right-bottom-item">
                            <p>Hiển thị 2<span> | </span>4 sản phẩm</p>
                        </div>
                        <div class="danhmuc-right-bottom-item">
                            <p><span>&#171;</span> 1 2 3 4 5 <span>&#187;</span> Trang cuối</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    const itemslidebar = document.querySelectorAll(".danhmuc-left-li")
    itemslidebar.forEach(function(menu, index) {
        menu.addEventListener("click", function() {
            menu.classList.toggle("block")
        })
    })
</script>