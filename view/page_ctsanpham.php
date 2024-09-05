<main>
    <div class="container-danhmuc">
        <div class="danhmuc-top row">
            <p><a href="?mod=page&act=home">Trang chủ</a></p><i class="fa-solid fa-angle-right"></i><p>Chi tiết sản phẩm</p>
        </div>
    </div>
    <section class="product-2">
        <div class="container-product">
            <div class="product-content row">       
                <div class="product-content-left row">
                    <div class="product-content-left-big-img">
                        <img src="upload/product/<?=$ctsanpham['anh']?>" alt="#">
                        
                    </div>
                    <div class="product-content-left-small-img">
                        <img src="upload/product/<?=$ctsanpham['anh']?>" alt="#">
                        <img src="upload/product/<?=$ctsanpham['anh']?>" alt="#">
                        <img src="assets_user/img/anhnu8.webp" alt="#">
                    </div>  
                </div>
                <div class="product-content-right">
                    <div class="product-content-right-product-name">
                        <h1><?=$ctsanpham['tensp']?></h1>
                        <p>Mã: <?=$ctsanpham['masp']?></p>
                    </div>
                    <div class="product-content-right-product-price">
                        </del> Giá Gốc: <?= number_format($ctsanpham['dongia'] - $ctsanpham['khuyenmai'], 0, ',', '.') ?> VND</p>
                    </div>
                    <!-- <div class="product-content-right-product-color">
                        <p><span style="font-weight: bold">Màu sắc:</span> Xanh cổ vịt nhạt<span style="color: red">*</span></p>
                        <div class="product-content-right-product-color-img">
                            <img src="assets/img/anhcolor.jpg" alt="">
                        </div>
                    </div> -->
                    <div class="product-content-right-product-size">
                        <p style="font-weight: bold">Size: </p>
                        <div class="size">
                            <span onclick="updatePrice('S'); highlightSize(this)" style="background-color: #ccc; color: white;">S</span>
                            <span onclick="updatePrice('M'); highlightSize(this)">M</span>
                            <span onclick="updatePrice('L'); highlightSize(this)">L</span>
                            <span onclick="updatePrice('XL'); highlightSize(this)">XL</span>
                            <span onclick="updatePrice('XXL'); highlightSize(this)">XXL</span>
                        </div>
                    </div>
                    <script>
                        // Set default size to S when page loads
                        window.onload = function() {
                            updatePrice('S');
                            highlightSize(document.querySelector('.size span'));
                        }
                    </script>                    
                    <script>
                        function highlightSize(element) {
                            // Remove highlight from all sizes
                            var sizes = document.querySelectorAll('.size span');
                            sizes.forEach(function(size) {
                                size.style.backgroundColor = '';
                                size.style.color = '';
                            });
                            element.style.backgroundColor = '#ccc';
                            element.style.color = 'white';
                        }
                    </script>                    
                    <p id="price">Tổng: <?=$ctsanpham['dongia']- $ctsanpham['khuyenmai']?> VND</p>
                    <script>
                        let basePrice = <?=$ctsanpham['dongia']- $ctsanpham['khuyenmai']?>;
                        function updatePrice(size) {
                            let newPrice = basePrice;
                            switch(size) {
                                case 'M':
                                    newPrice += 356;
                                    break;
                                case 'L':
                                    newPrice += 477;
                                    break;
                                case 'XL':
                                    newPrice += 587;
                                    break;
                                case 'XXL':
                                    newPrice += 689;
                                    break;
                                default:
                                    break;
                            }
                            let quantity = document.querySelector('.quantity input').value;
                            let total = newPrice * quantity;
                            document.getElementById('price').innerHTML = 'Tổng: ' + total + ' VND';
                        }
                    </script>                    
                    <div class="quantity">
                        <p style="font-weight: bold">Sản phẩm còn <?=$ctsanpham['soluong']?>: </p>
                        <input type="number" min="0" value="1" onchange="updatePrice(document.querySelector('.size span[style*=\'background-color\']').textContent)">
                    </div>
                    
                    <div class="product-content-right-product-button">
                        <?php if ($ctsanpham['soluong'] > 0): ?>
                            <a href="?mod=product&act=addToCart&id=<?=$ctsanpham['masp']?>"><button><i class="fas fa-shopping-cart"></i><p>THÊM VÀO GIỎ HÀNG</p></button></a>
                        <?php else: ?>
                            <button disabled style="opacity: 0.5; cursor: not-allowed;"><p>HẾT HÀNG</p></button>
                        <?php endif; ?>
                    </div>
                    <?php if(isset($_SESSION['thongbao'])): ?>
                        <div class="thongbaocart">
                            <?=$_SESSION['thongbao']?>
                        </div>
                    <?php endif; unset($_SESSION['thongbao']); ?>
                    <?php if(isset($_SESSION['loi'])): ?>
                        <div class="loicart">
                            <?=$_SESSION['loi']?>
                        </div>
                    <?php endif; unset($_SESSION['loi']); ?>
                    <div class="product-content-right-product-icon">
                        <div class="product-content-right-product-icon-item">
                            <i class="fas fa-phone-alt"></i> <p>Hotline</p>
                        </div> 
                        <div class="product-content-right-product-icon-item">
                            <i class="fas fa-comments"></i> <p>Chat</p>
                        </div>
                        <div class="product-content-right-product-icon-item">
                            <i class="fas fa-envelope"></i> <p>Mail</p>
                        </div>                  
                    </div>
                    <div class="product-content-right-product-rgin-botton">
                        <p style="font-weight: bold; margin-bottom: 10px; margin-top: 24px">Mô tả sản phẩm:</p>
                        <span style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif;color: #504f4f; font-size: 15px; line-height: 18px;">
                            <?=$ctsanpham['mota']?>
                        </span><br>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product-related">
        <h2>COMMENT:</h2> 
        <?php if(isset($_SESSION['user'])): ?>
            <form action="?mod=product&act=comment" method="post" >
                <input type="text" name="noidung" placeholder="Nhận xét sản phẩm!">
                <input type="hidden" name="masp" value="<?=$ctsanpham['masp']?>">
                <button class="comment" type="submit">Gửi</button>
            </form>
        <?php endif; ?>
        <?php if(isset($dsbinhluan) && is_array($dsbinhluan)): ?>
            <?php foreach($dsbinhluan as $bl): ?>
            <div class="khungcomment">
                <div class="khungcomment-col-3">
                    <strong><?=$bl['hoten']?></strong><br>
                    <br><?=$bl['ngaygui']?><br>
                </div>
                <div class="khungcomment-col-9">
                    Nội dung: <?=$bl['noidung']?>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <div class="product-related-title">
            <p>SẢN PHẨM LIÊN QUAN</p>
        </div>
        <div class="product-content row">
        <?php if(isset($spcungdanhmuc) && is_array($spcungdanhmuc)): ?>
            <?php foreach($spcungdanhmuc as $ctsanpham): ?>
                <div class="product-related-item">
                    <a href="?mod=product&act=ctsanpham&id=<?=$ctsanpham['masp']?>"><img src="upload/product/<?=$ctsanpham['anh']?>"><br></a>
                    <p>Mã: <?=$ctsanpham['masp']?><span><?=$ctsanpham['khuyenmai']?>đ</span></p>
                    <a href=""><h3><?=$ctsanpham['tensp']?></h3></a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>
    </section>
</section>
</main>
    <script>
        const bigImg = document.querySelector(".product-content-left-big-img img")
        const smalImg = document.querySelectorAll(".product-content-left-small-img img")
        smalImg.forEach(function(imgItem,X){
        imgItem.addEventListener("click",function(){
            bigImg.src = imgItem.src
        })
    })
    </script>

