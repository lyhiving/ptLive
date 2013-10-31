<div class="admin-login well">
    <?php if (isset($error)) {
        echo <<<EOF
    <div class="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>密码错误</strong>
    </div>
EOF;
    } ?>
    <form class="form form-horizontal" method="post">
        <div class="control-group">
            <label class="control-label" for="name">管理员</label>
            <div class="controls">
                <input id="name" name="name" type="text" />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="pwd">密码</label>
            <div class="controls">
                <input id="pwd" name="pwd" type="password" />
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <input class="btn btn-info" type="submit" value="登陆" />
            </div>
        </div>
    </form>
</div>
