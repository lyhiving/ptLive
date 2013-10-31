<h1>评论管理</h1>
<table class="table table-striped table-condensed table-hover table-bordered pt-manager">
    <thead>
        <tr>
            <th>昵称</th>
            <th>内容</th>
            <th>ip</th>
            <th>时间</th>
            <th>操作</th>
        </tr>
    </thead>
    <?php
        foreach ($commentList as $comment) {
            echo <<<EOF
            <tr>
                <td>{$comment->name}</td>
                <td>{$comment->msg}</td>
                <td>{$comment->ip}</td>
                <td>{$comment->time}</td>
                <td>
                    <a href='index.php?r=admin/delComment&id={$comment->id}&news_id={$comment->news_id}'>
                        <i class='icon-trash'></i>删除
                    </a>
                </td>
            </tr>
EOF;
        }
 ?>
    </tr>
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
