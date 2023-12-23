<?php
$title = 'Quản lý Đơn hàng';
$baseUrl = '../';
require_once('../layouts/header.php');

//status = 0 là đang ở trạng thái chưa giải quyết(pending), status = 1 là đã hoàn thành(approved), status = 2 là đơn hàng đã hủy(cancel)
$sql = "select * from Orders order by status asc, order_date desc";
$data = executeResult($sql);

?>
<div class="row" style="margin-top: 20px;">
    <div class="col-md-12 table-responsive">
        <h3>QUẢN LÝ ĐƠN HÀNG</h3>
        <table class="table table-bordered table-hover" style="margin-top: 20px;"> 
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Họ & Tên</th>
                    <th>SĐT</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Nội dung</th>
                    <th>Tổng tiền</th>
                    <th>Ngày tạo</th>
                    <th style="width: 120px;"></th>
                    <th style="width: 50px;"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $index = 0;
                foreach($data as $item) {
                    echo '<tr>
                    <th>'.(++$index).'</th>
                    <td><a href="detail.php?id='.$item['id'].'">'.$item['fullname'].'</a></td>
                    <td><a href="detail.php?id='.$item['id'].'">'.$item['phone_number'].'</a></td>
                    <td><a href="detail.php?id='.$item['id'].'">'.$item['email'].'</a></td>
                    <td>'.$item['address'].'</td>
                    <td>'.$item['note'].'</td>
                    <td>'.$item['total_money'].'</td>
                    <td>'.$item['order_date'].'</td>
                    <td style="width: 50px;">';
                    if($item['status'] == 0) {
                        echo '<button onclick="changeStatus('.$item['id'].',1)" class="btn btn-sm btn-success" style="margin-bottom: 10px">Approve</button>
                        <button onclick="changeStatus('.$item['id'].',2)" class="btn btn-sm btn-danger">Cancel</button>';
                    } else if($item['status'] == 1) {
                        echo'<label class="badge badge-success">Approved</label>';
                    } else {
                        echo'<label class="badge badge-danger">Cancel</label>
                        ';
                    }
                    echo'</td>
                    <td style="width: 50px;">
                        <button onclick="deleteOrder('.$item['id'].')" class="btn btn-danger">Xóa</button>
                    </td>  
                </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Cho phép xóa người dùng -->
<script type="text/javascript">
    function changeStatus(id, status) {
        $.post('form_api.php', {
            'id': id,
            'status': status,
            'action': 'update_status'
        }, function(data) {
            location.reload()
        })
    }

    function deleteOrder(id) {
        option = confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?');
        if(!option) return;
        $.post('form_api.php', {
            'id': id,
            'action': 'delete'
        }, function(data) {
            location.reload()
        })
    }
</script>
<?php
require_once('../layouts/footer.php');
?>
