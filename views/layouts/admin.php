<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>相思湖图文直播后台管理</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="css/todc-bootstrap.css" />
    <link rel="stylesheet" href="css/live.css" />
    <link rel="stylesheet" href="css/jquery.fancybox.css" />
    <script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="navbar navbar-fixed-top navbar-inverse">
                    <div class="navbar-inner">
                        <div class="container-fluid">
                        <button data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="index.php" class="brand">
                            <img width="17" height="17" src="img/xsh-logo.png" alt="logo">
                            相思湖网站图文直播系统
                        </a>
                        <div class="nav-collapse collapse navbar-responsive-collapse">;
                        <?php
                        if ($this->isLogged()) {
                            $this->widget(
                                'ext.widgets.menu',
                                array(
                                    'items' => array(
                                        array(
                                            'label' => '发布图文',
                                            'url' => 'admin/publish',
                                        ),
                                        array(
                                            'label' => '图文管理',
                                            'url' => 'admin/ptManager',
                                        ),
                                        array(
                                            'label' => '退出',
                                            'url' => 'admin/logout',
                                        ),
                                    ),
                                )
                            );
                        }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <?php echo $content; ?>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.fancybox.js"></script>
</body>
</html>
