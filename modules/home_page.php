<div class="slider-wrapper theme-default">
        <div class="slide-wrapper">
            <?php
                $sql_slider="SELECT * FROM slider";
                $query_slider=mysqli_query($con,$sql_slider);
                $i=0;
                while($row_slider=mysqli_fetch_array($query_slider)){
            ?>
                <div class="slide" value="<?php echo $i;?>"><img src="image/slider/<?php echo $row_slider['hinhanh'];?>"></div>
            <?php
                $i++;
            }
            ?>
            <a class="prev" value ="-1">❮</a>
            <a class="next" value="1">❯</a>
        </div>
        <div class="Nav">
            <span class="dot" value="0"></span>
            <span class="dot" value="1"></span>
            <span class="dot" value="2"></span>
        </div>
</div>
    <?php
    include_once ('./modules/listbook.php');
    ?>      