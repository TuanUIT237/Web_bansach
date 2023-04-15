<div class="col-md-4">
    <div class="x_panel">
        <div class="x_title">
            <h2>Thêm mới khuyến mãi</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br>
            <?php
                if(isset($_POST["addNew"])){
                    $sqlsearchid="SELECT * FROM khuyenmai ORDER BY id_km DESC LIMIT 1 OFFSET 0";
                    $querysearchid=mysqli_query($con,$sqlsearchid);
                    $rowsearchid=mysqli_fetch_array($querysearchid);
                    $idkm=$rowsearchid['id_km']+1;
                    $tenctkm= $_POST["ten_ctkm"];
                    $ngaybd= $_POST["ngay_bd"];
                    $ngaykt= $_POST["ngay_kt"];
                    $discount=$_POST["discount"];
                    if(isset($_GET["id"]) && isset($_GET["edit"])){
                        $sqlUpdate="UPDATE khuyenmai SET ten_ctkm='$tenctkm', ngay_bd='$ngaybd',ngay_kt='$ngaykt',discount='$discount'
                        WHERE id_km=".$_GET["id"];
                        mysqli_query($con,$sqlUpdate);
                        header("location:index.php?page=qlyKhuyenmai");
                    }else{
                        $sqlInsert= "INSERT INTO khuyenmai(id_km,ten_ctkm,ngay_bd,ngay_kt,discount) VALUES ('$idkm','$tenctkm','$ngaybd','$ngaykt','$discount')";
					    mysqli_query($con,$sqlInsert);
                    }
                }
                //kiểm tra tham số id trên url khi sửa
                $tenctkm="";
                $ngaybd="";
                $ngaykt="";
                $discount="";
                if(isset($_GET["id"]) && isset($_GET["edit"])){
                    $sqlEdit= "SELECT* FROM khuyenmai  WHERE id_km=".$_GET["id"];
                    $resultEdit= mysqli_query($con, $sqlEdit);
                    $rowEdit=mysqli_fetch_row($resultEdit);
                    // echo "<pre>";
                    // print_r($rowEdit);
                    $tenctkm=$rowEdit[1];
                    $ngaybd=$rowEdit[2];
                    $ngaykt=$rowEdit[3];
                    $discount=$rowEdit[4];
                }

                //kiểm tra tham số id trên url khi xóa
                if(isset($_GET["id"]) && isset($_GET["delete"])){
                    $sqlSelect="SELECT * FROM khuyenmai WHERE id_km=".$_GET["id"];
                    $query=mysqli_query($con,$sqlSelect);
                    $row=mysqli_fetch_array($query);
                    $id=$row['id_km'];
                    $tenctkm=$row['ten_ctkm'];
                    $ngaybd=$row['ngaybd'];
                    $ngaykt=$row['ngaykt'];
                    $discount=$row['discount'];
                    $sqlInsert="INSERT INTO trash_khuyenmai VALUES('$id','$tenctkm','$ngaybd','$ngaykt','$discount')";
                    mysqli_query($con,$sqlInsert);
                    $sqlDelete="DELETE FROM khuyenmai WHERE id_km=".$_GET["id"];
                    mysqli_query($con,$sqlDelete);
                    header("location:index.php?page=qlyKhuyenmai");
                }
            ?>
            <form class="form-label-left input_mask" method="post">

                <div class="form-group row">
                    <label class="col-form-label col-md-4 col-sm-4 ">Tên chương trình</label>
                    <div class="col-md-8 col-sm-8 ">
                        <input type="text" class="form-control" value="<?php echo $tenctkm; ?>" name="ten_ctkm" id="ten_ctkm" placeholder="Nhập chương trình">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-md-4 col-sm-4 ">Ngày bắt đầu <span class="required">*</span>
                    </label>
                    <div class="col-md-8 col-sm-8 ">
                        <input class="date-picker form-control" value="<?php echo $ngaybd; ?>" name="ngay_bd" id="ngay_bd" placeholder="dd-mm-yyyy" type="text" required="required" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                        <script>
                            function timeFunctionLong(input) {
                                setTimeout(function() {
                                input.type = 'text';
                                }, 60000);
                            }
                        </script>
                    </div>
			    </div>
                
                <div class="form-group row">
                    <label class="col-form-label col-md-4 col-sm-4 ">Ngày kết thúc <span class="required">*</span>
                    </label>
                    <div class="col-md-8 col-sm-8 ">
                        <input class="date-picker form-control" value="<?php echo $ngaykt; ?>" name="ngay_kt" id="ngay_kt" placeholder="dd-mm-yyyy" type="text" required="required" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                        <script>
                            function timeFunctionLong(input) {
                                setTimeout(function() {
                                input.type = 'text';
                                }, 60000);
                            }
                        </script>
                    </div>
			    </div>
                
                <div class="form-group row">
                    <label class="col-form-label col-md-4 col-sm-4 ">Discount (%):</label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="range" class="form-control form-range" id="range" value="<?php echo $discount;?>"
                                name="discount" id="discount" min="0" max="1" step="0.05" style="padding:6px 0px;">
                    </div>
                    <span class="col-md-2 col-sm-2"  id="range_val"></span>
                </div>
                
                <div class="ln_solid"></div>
                <div class="form-group row">
                    <div class="col-md-9 col-sm-9  offset-md-3">
                        <button class="btn btn-primary" type="reset" name="Reset">Làm mới</button>
                        <button type="submit" class="btn btn-success" name="addNew">Xác nhận</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="x_search">
		<form class="form-label-left input_mask" method="post">
			<div class="form-group row">
				<label class="col-form-label col-md-3 col-sm-3 ">Tìm kiếm:</label>
				<div class="col-md-6 col-sm-6 ">
					<input type="text" class="form-control"  name="timkiem" id="timkiem" placeholder="Tìm chương trình">
				</div>
				<div class="col-md-3 col-sm-3">
						<button type="submit" class="btn btn-warning" name="Search"><i class="fa fa-search"></i></button>
					</div>
			</div>
		</form>
    </div>
</div>
<div class="col-md-8">
    <div class="x_panel" style="height: 660px;overflow: scroll;">
        <div class="x_title" >
        <h2>Bảng chương trình khuyến mãi</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div>
        </div>
        <div class="x_content" >
        	<table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Tên chương trình</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Discount</th>
                <th>Chức năng</th>
            </tr>
            </thead>
            <tbody>
            <?php
                if(isset($_POST["Search"])){
                    $timkiem=$_POST["timkiem"];
                    $sqlSearch= "SELECT* FROM  khuyenmai  WHERE  (id_km LIKE '%$timkiem%'|| ten_ctkm LIKE '%$timkiem%')";
                    $resultSearch= mysqli_query($con, $sqlSearch);
                    if(mysqli_num_rows($resultSearch)>0){
                        while($rowSearch= mysqli_fetch_assoc($resultSearch)){
            ?>          
                        <tr>
                            <td><?php echo $rowSearch["id_km"]?></td>
                            <td><?php echo $rowSearch["ten_ctkm"]?></td>
                            <td><?php echo $rowSearch["ngay_bd"]?></td>
                            <td><?php echo $rowSearch["ngay_kt"]?></td>
                            <td><?php echo ($rowSearch["discount"]*100)."%"?></td>
                            <td>
                                <a href="index.php?page=qlyKhuyenmai&id=<?php echo $rowSearch["id_km"];?>&edit=1">
                                    <i class="fa fa-pencil-square-o"></i> Sửa</a>
                                <a href="index.php?page=qlyKhuyenmai&id=<?php echo $rowSearch["id_km"];?>&delete=1" 
                                onclick="return confirm('Bạn có muốn xóa khuyến mãi trình này không?')"><i class="fa fa-trash-o"></i> Xóa</a>
                            </td>
                        </tr>
                <?php }
				    }
                }else{
                    //Truy vấn dữ liệu
                    $sqlSelect="SELECT * FROM  khuyenmai";
                    //Thực thi
                    $result= mysqli_query($con,$sqlSelect);
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                
            ?> 
                <tr>
                    <td><?php echo $row["id_km"]?></td>
                    <td><?php echo $row["ten_ctkm"]?></td>
                    <td><?php echo $row["ngay_bd"]?></td>
                    <td><?php echo $row["ngay_kt"]?></td>
                    <td><?php echo ($row["discount"]*100)."%"?></td>
                    <td>
                        <a href="index.php?page=qlyKhuyenmai&id=<?php echo $row["id_km"];?>&edit=1">
                            <i class="fa fa-pencil-square-o"></i> Sửa</a>
                        <a href="index.php?page=qlyKhuyenmai&id=<?php echo $row["id_km"];?>&delete=1" 
                        onclick="return confirm('Bạn có muốn xóa khuyến mãi này không?')"><i class="fa fa-trash-o"></i> Xóa</a>
                    </td>
                </tr>
                
                <?php }}} ?>
            </tbody>
        	</table>
        </div>
    </div>
</div>
