<div class="bookdetailwrap">

    <header class="pageheader">
        <h1>
            Lịch sử giao dịch
        </h1>
    </header>
            
    <div class="checkorder">

        <div class="form">
            <form action="" method="post" novalidate="novalidate">
                <input name="id" placeholder="Nhập mã đơn hàng của bạn" class="text">
                <input type="submit" value="Tìm mã" class="submit" name="transactions">
            </form>
            
        </div>
        <?php
            if(isset($_POST['transactions'])&&($_POST['transactions'])){
                $id=$_POST['id'];
            }else{
                $id="";
            }
        ?>
        <table>
            <tbody>
                <tr>
                <th>STT</th>
                <th>Mã đơn hàng</th>
                <th>Người mua</th>
                <th>Địa chỉ</th>
                <th>Ngày nhận hàng</th>
                <th>Tình trạng</th>
                <th>Trạng thái</th>
                </tr>
                <?php
                    $sql="SELECT hd.id_hoadon,hd.diachi,hd.ngayhd,nd.tennguoidung,hd.tinhtrang,hd.trangthai FROM (cthd ct JOIN hoadon hd ON ct.id_hoadon=hd.id_hoadon) JOIN nguoidung nd ON nd.id_nguoidung=hd.id_nguoidung WHERE hd.id_hoadon='$id' AND tinhtrang=2 AND trangthai=1";
                    $query=mysqli_query($con,$sql);
                    $i=0;
                    while($row=mysqli_fetch_array($query)){
                        $i++;
                        if($i==1){
                ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['id_hoadon'];?></td>
                    <td><?php echo $row['tennguoidung'];?></td>
                    <td><?php echo $row['diachi']; ?></td>
                    <td><?php echo $row['ngayhd'];?></td>
                    <td><?php 
                        if($row['tinhtrang']==2){
                            echo 'Đã nhận hàng';
                        }?>
                    </td>
                    <td><?php 
                        if($row['trangthai']==1){
                            echo 'Đã thanh toán';
                        }?>
                    </td>
                </tr>
                <?php
                        }
                }
                ?>
            </tbody>
        </table>
        <div class="pager"></div>
    </div>
</div>