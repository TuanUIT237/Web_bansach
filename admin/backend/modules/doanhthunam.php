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
        var nam = $('#select-year').val();
            $.ajax({
                url:"thongke.php",
                method:"POST",
                dataType:"JSON",
                data: {nam:nam},
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
    <h6 style="margin-top:5px; padding:3px;">Thống kê theo năm:</h6>
    <div style="margin-left: 20px">
        <label class="col-form-label" style="font-size: 16px; margin-right:5px;">Năm</label>
        <input type="text" id="select-year" class="form-control" style="width: 50px; height:33px; padding: 7px 5px 5px 7px; font-size:14px; display:inline-block;">
        <input type="submit" id="submit-thongke" class="btn btn-primary" value="Xem" style="font-size: 14px; padding: 5px 10px 5px 10px; margin-left: 20px;">
    </div>
</div>
<div id="chart" style="height: 300px; margin-top: 50px;"></div>
</div>
