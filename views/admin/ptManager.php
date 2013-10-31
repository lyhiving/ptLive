<h1>图文管理</h1>
<table class="table table-striped table-condensed table-hover table-bordered pt-manager">
    <thead>
        <tr>
            <th>序号</th>
            <th>内容</th>
            <th>图片</th>
            <th>评论</th>
            <th>时间</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach ($newsList as $news) {
        $comment_count = count($news->comment);
        if ($news->img == '') {
            $img = '';
        }
        else {
            $link = "uploads/images/{$news->img}";
            $img = CHtml::link(
                CHtml::tag('img', array(
                    'src' => $link
                )),
                $link,
                array(
                    'class' => 'fancybox',
                    'data-fancybox-group' => 'live-pt',
                    'title' => $news->text,
                )
            );
        }
        echo <<<EOF
        <tr>
        <td>{$news->id}</td>
        <td>{$news->text}</td>
        <td>{$img}</td>
        <td><a href='index.php?r=admin/comment&news_id={$news->id}'>{$comment_count}条</a></td>
        <td>{$news->time}</td>
        <td>
            <a href='index.php?r=admin/delPt&news_id={$news->id}'><i class='icon-trash'></i>删除</a>
            </td>
        </tr>
EOF;
    }
    ?>
    </tbody>
</table>
<div class="pagination">
<?php 
$this->widget('CLinkPager',array(    
    'pages' => $pages,    
    'header'=>'',    
    'cssFile' => '',
    'hiddenPageCssClass' => 'disabled',
    'selectedPageCssClass' => 'active',
    'nextPageLabel' => '&gt;',
    'prevPageLabel' => '&lt;',
    'firstPageLabel' => '&lt;&lt;',
    'lastPageLabel' => '&gt;&gt;',
    'htmlOptions' => array(
        'id' => 'studentLinkPager',
        'class' => 'pagination pagination-sm pull-left hidden-xs',
    ),
));
?>
</div>
<script type="text/javascript">
    window.onload = function(){
        $('.fancybox').fancybox();
    };
</script>
