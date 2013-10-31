<div class="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php if (isset($msg))
        echo "<strong>{$msg}</strong>"
    ?>
    <q class="prompt">
        <span>3</span>秒后自动跳转
    </q>
</div>
<script type="text/javascript">
    window.onload = function(){
        var t = 3;
        var url = '<?php echo 'index.php?r=admin/'.$_GET['jump']; ?>'
        var timer = setInterval(function() { 
            $('.prompt>span').text(t);
            if (t == 0) {
                clearInterval(timer);
                window.location.href = url;
            }
            t--;
        }, 1000);
    };
</script>
