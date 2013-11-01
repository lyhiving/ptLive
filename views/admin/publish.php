<link rel="stylesheet" href="js/jquery-ui/css/enhanced.css" />
<script type="text/javascript" src="js/jquery-ui/js/fileinput.jquery.js"></script>
<script type="text/javascript">
if (!(document.all &&
    navigator.userAgent.indexOf('Opera') === -1))
{
    $(document).ready(function() {
        $('#Upload_image').customFileInput({
            feedback_text: '选择图片...文件',
            button_text: '导入文件',
            button_change_text : '重新选择',
            button_position : 'right'
        });
    });
}
</script>
<div class="publish">
    <form class="well form form-horizontal" action="index.php?r=admin/publish" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>发布图文</legend>
            <div class="control-group">
                <label class="control-label" for="text">文字：</label>
                <div class="controls">
                    <textarea id="text" name="text" cols="50" rows="3"></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="Upload_image">图片：</label>
                <div class="controls">
                    <input id="Upload_image" name="img" type="file" />
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <input type="submit" value="发布" class="btn btn-primary" />
                </div>
            </div>
        </fieldset>
    </form>
</div>
