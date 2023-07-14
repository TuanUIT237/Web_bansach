<div class="bookdetailwrap">
    <header class="pageheader">
        <h1>
            Chương trình khuyến mãi
        </h1>
    </header>
    <?php
        $sql="SELECT * FROM khuyenmai";
        $query=mysqli_query($con,$sql);
        
    ?>  
    <article class="articledetail">
        <table>
            <tbody>
                <tr>
                <th>STT</th>
                <th>Tên chương trình</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Sale-off</th>
                </tr>
                <?php
                    $i=0;
                    while($row=mysqli_fetch_array($query)){
                        $i++;
                ?>
                <tr>
                    <td><?php echo $i?></td>
                    <td><?php echo $row['ten_ctkm']?></td>
                    <td><?php echo $row['ngay_bd']?></td>
                    <td><?php echo $row['ngay_kt']?></td>
                    <td><?php echo $row['discount']*100; echo '%'?></td>
                </tr>
                <?php
                    }
                ?>
            </tbody></table>
            <div class="pager"></div>
    </article>
</div>