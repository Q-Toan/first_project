<style>
    .thongbaothanhtoan {
        background-color: rgb(49, 209, 129);
        /* Màu nền đỏ */
        color: white;
        /* Màu chữ trắng */
        padding: 15px;
        /* Khoảng cách giữa nội dung và viền */
        margin-bottom: 15px;
        /* Khoảng cách dưới cùng */
        border-radius: 5px;
        /* Bo tròn viền */
    }
</style>
<main>
    <div class="container-danhmuc">
        <div class="danhmuc-top row">
            <p><a href="?mod=page&act=home">Trang chủ</a></p><i class="fa-solid fa-angle-right"></i>
            <p>Giỏ hàng</p>
        </div>
    </div>
    <div class="khunggiohang">
        <div class="container">
            <h2 class="giohang">GIỎ HÀNG</h2>
            <?php if (isset($_SESSION['thongbao'])) : ?>
                <div class="thongbaothanhtoan">
                    <?= $_SESSION['thongbao'] ?>
                </div>
                <?php unset($_SESSION['thongbao']); ?>
            <?php endif; ?>
            <form action="?mod=product&act=updateCart" method="post">
                <input type="hidden" name="tongtien" id="tongtien">
                <div class="cart">
                    <table>
                        <thead>
                            <tr>
                                <th>Ảnh</th>
                                <th class="tensanpham1">Tên phẩm</th>
                                <th>Giá</th>
                                <th>Giá khuyến mãi</th>
                                <th>Số lượng</th>
                                <th>Tổng cộng</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (is_array($ctgiohang) || is_object($ctgiohang)): ?>
                                <?php foreach ($ctgiohang as $item): ?>
                                    <tr>
                                        <td><img src="upload/product/<?= $item['anh'] ?>" width="120px" alt=""></td>
                                        <td class="tensanpham2"><?= $item['tensp'] ?></td>
                                        <td><?= $item['dongia'] ?>đ</td>
                                        <td><?= $item['khuyenmai'] ?>đ</td>
                                        <td class="soluongsanpham"><input type="number" min="0" value="1"></td>
                                        <td></td>
                                        <td><a href="?mod=product&act=removeFromCart&id=<?= $item['masp'] ?>"><i class="fa-solid fa-trash"></i></a></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <!-- Thêm các sản phẩm khác nếu cần -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="tongtien" colspan="5">TỔNG TIỀN</th>
                                <th></th>
                                <th><a href="?mod=product&act=removeCart"><i class="fa-solid fa-trash"></i></a></th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="customer-info">
                        <h2>Thông tin khách hàng</h2>
                        <label for="ghichu">Điền thông tin nhận hàng! </label>
                        <input type="text" id="ghichu" name="ghichu" placeholder="Điền Thông tin địa chỉ Quận / Huyện /Phường / Xã và SĐT:" required>
                    </div>
                    <style>
                        .thanhtoan {
                            text-align: center;
                            margin-top: 20px;
                            /* Khoảng cách từ đỉnh div */
                        }
                        .thanhtoan input[type="submit"] {
                            width: 100%;
                            background-color: #4CAF50;
                            /* Màu nền */
                            color: white;
                            /* Màu chữ */
                            padding: 10px 20px;
                            /* Kích thước nút */
                            border: none;
                            /* Bỏ viền */
                            border-radius: 4px;
                            /* Bo tròn góc */
                            cursor: pointer;
                            /* Biểu tượng con trỏ khi di chuyển vào nút */
                            font-size: 16px;
                            /* Kích thước chữ */
                        }
                        .thanhtoan input[type="submit"]:hover {
                            background-color: #45a049;
                            /* Màu nền khi di chuột qua */
                        }
                    </style>
                    <div class="thanhtoan">
                        <input type="submit" value="Thanh toán">
                    </div>
                </div>
            </form>
        </div>
    </div>
</main></main>
</main>
</main>
<script>
    function tongtien() {
        // Lấy tất cả các hàng trong bảng sản phẩm
        var dssanpham = document.querySelectorAll('table tbody tr');
        var tongtien = 0; // Khởi tạo tổng tiền là 0
        // Lặp qua từng sản phẩm trong danh sách
        for (const sanpham of dssanpham) {
            // Lấy giá sản phẩm và loại bỏ ký tự 'VND'
            var gia = parseFloat(sanpham.querySelector('td:nth-child(3)').innerText.replace('VND', '').trim());
            // Lấy giá khuyến mãi và loại bỏ ký tự 'VND'
            var giakhuyenmai = parseFloat(sanpham.querySelector('td:nth-child(4)').innerText.replace('VND', '').trim());
            // Lấy số lượng sản phẩm từ ô input
            var soluong = parseInt(sanpham.querySelector('td:nth-child(5) input').value);
            // Tính tổng tiền cho sản phẩm hiện tại
            var tien = (gia - giakhuyenmai) * soluong;
            // Hiển thị tổng tiền cho sản phẩm hiện tại, định dạng số với dấu phân cách hàng nghìn
            sanpham.querySelector('td:nth-child(6)').innerText = tien.toLocaleString() + ' VND';
            // Cộng vào tổng tiền chung
            tongtien += tien;
        }
        // Hiển thị tổng tiền ở cuối bảng, định dạng số với dấu phân cách hàng nghìn
        document.querySelector('tfoot th:nth-child(2)').innerText = tongtien.toLocaleString() + ' VND';
        // Cập nhật giá trị tổng tiền vào một trường input ẩn (có thể dùng cho form submission)
        document.querySelector('#tongtien').value = tongtien;
    }
    // Gọi hàm tính tổng tiền khi trang được tải
    document.addEventListener('DOMContentLoaded', function() {
        tongtien();
    });
    // Thêm sự kiện lắng nghe cho các ô input số lượng
    document.querySelectorAll('td.soluongsanpham input').forEach(function(input) {
        input.addEventListener('change', tongtien);
    });
</script>
</script>