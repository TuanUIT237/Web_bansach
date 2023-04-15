<script src="//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    var char = new Morris.Area({
    
        element: 'chart',
    
        xkey: 'date',
        
        ykeys: ['order','quantity','sales'],
    
        labels: ['Số hoá đơn','Số lượng bán ra','Doanh thu']
    });
    $("#submit-thongke").click(function(){
        var thang = $("#select-month").val();
        var nam = $('#select-year').val();
        var dataString = '&thang='+ thang + '&nam='+ nam;
            $.ajax({
                url:"thongke.php",
                method:"POST",
                dataType:"JSON",
                data: dataString,
                success:function(data)
                {
                    char.setData(data);
                }   
            });
    });
});
</script>
<div>
<div style="display:flex;">
    <h6 style="margin-top:5px; padding:3px;">Thống kê theo tháng:</h6>
    <div style="margin-left: 20px">
        <label class="col-form-label" style="font-size: 16px; margin-right:5px;">Tháng</label>
        <select id="select-month" class="form-control" style="width: 110px; height:33px; font-size:14px; display:inline-block;">
            <option value="1">Tháng 1</option>
            <option value="2">Tháng 2</option>
            <option value="3">Tháng 3</option>
            <option value="4">Tháng 4</option>
            <option value="5">Tháng 5</option>
            <option value="6">Tháng 6</option>
            <option value="7">Tháng 7</option>
            <option value="8">Tháng 8</option>
            <option value="9">Tháng 9</option>
            <option value="10">Tháng 10</option>
            <option value="11">Tháng 11</option>
            <option value="12">Tháng 12</option>
        </select>
        <label class="col-form-label" style="font-size: 16px; margin-right:5px; margin-left:10px;">Năm</label>
        <input type="text" id="select-year" class="form-control" style="width: 50px; height:33px; padding: 7px 5px 5px 7px; font-size:14px; display:inline-block;">
        <input type="submit" id="submit-thongke" class="btn btn-primary" value="Xem" style="font-size: 14px; padding: 5px 10px 5px 10px; margin-left: 20px;">
    </div>
</div>
<div id="chart" style="height: 300px; margin-top: 50px;"></div>
</div>