<style>
    /* CSS cho thông báo lỗi 1 */
    .thongbaoloi-1 {
        background-color: #f44336;
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

    /* CSS cho thông báo lỗi 2 */
    .thongbaoloi-2 {
        background-color: #ff9800;
        /* Màu nền cam */
        color: white;
        /* Màu chữ trắng */
        padding: 15px;
        /* Khoảng cách giữa nội dung và viền */
        margin-bottom: 15px;
        /* Khoảng cách dưới cùng */
        border-radius: 3px;
        /* Bo tròn viền */
    }

    .edit {
        background-color: darkcyan;
        color: white;
        padding: 3px;
        font-size: 12px;
        border-radius: 2px;
    }

    .xoa {
        background-color: rgb(236, 18, 18);
        color: rgb(255, 255, 255);
        font-size: 12px;
        padding: 3px;
        border-radius: 2px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    thead {
        background-color: #f2f2f2;
        color: #000;
    }

    th,
    td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        font-weight: bold;
    }

    .thongtinsp:hover {
        background-color: #f5f5f5;
    }

    .edit,
    .xoa {
        padding: 5px 10px;
        text-decoration: none;
        color: white;
        border-radius: 3px;
    }

    .edit {
        background-color: darkcyan;
    }

    .xoa {
        background-color: #f44336;
        margin-left: 5px;
    }
</style>
<div class="sanpham">
    <h2>Danh Mục</h2>
    <a href="admin.php?mod=product&act=add_danhmuc">THÊM DANH MỤC</a>
    <!-- thông báo  -->
    <?php if (isset($_SESSION['thongbao'])) : ?>
        <div class="thongbaoloi-1" role="alert">
            <?= $_SESSION['thongbao'] ?>
        </div>
        <!-- thông báo lỗi -->
    <?php endif;
    unset($_SESSION['thongbao']); ?>
    <?php if (isset($_SESSION['loi'])) : ?>
        <div class="thongbaoloi-2" role="alert">
            <?= $_SESSION['loi'] ?>
        </div>
    <?php endif;
    unset($_SESSION['loi']); ?>
    <!-- ----------------- -->
</div>
<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên Danh Mục</th>
            <th>Số Lượng</th>
            <th>Hoạt động</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;
        if (isset($ds_admin_danhmuc) && is_array($ds_admin_danhmuc)): foreach ($ds_admin_danhmuc as $dm): ?>
                <tr class="thongtinsp">
                    <td><?= $i ?></td>
                    <td><?= $dm['tendm'] ?></td>
                    <td>
                        <?= $dm['soluongsp'] ?>
                    </td>
                    <td>
                        <a class="edit" href="admin.php?mod=product&act=edit_danhmuc&id=<?= $dm['madm'] ?>">Edit</a>
                        <a class="xoa" onclick="deleteProduct(<?= $dm['madm'] ?>)" href="admin.php?mod=product&act=delete_danhmuc&id=<?= $dm['madm'] ?>"> Delete</a>
                    </td>
                </tr>
        <?php $i++;
            endforeach;
        endif; ?>
    </tbody>
</table>
<script>
    function deleteProduct(id) {
        var kq = confirm("Bạn có muốn xoá danh mục này không!");
        if (kq) {
            //KQ đúng -> xoá SP
            window.location.search = '?mod=product&act=delete_danhmuc&id=' + id;
        }
    }
</script>