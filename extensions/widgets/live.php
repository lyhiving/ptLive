<?php
class live extends CWidget {
    /**
     * type 1,pic text; 2,pic
     * @var int
     */
    public $type = 1;
    public $offset = 0;
    public $limit = 10;
    public function run() {
        $news = News::getNews($this->offset, $this->limit, $this->type);
        switch ($this->type) {
            case 1:
                $this->echoPt($news);
                break;
            case 2:
                $this->echoPic($news);
                break;
        }
    }

    public function echoPt($news) {
        foreach ($news as $new) {
            if ($new->img == '') {
                $img = '';
            }
            else {
                $link = "uploads/images/{$new->img}";
                $img = CHtml::link(
                    CHtml::tag('img', array(
                        'src' => $link
                    )),
                    $link,
                    array(
                        'class' => 'fancybox',
                        'data-fancybox-group' => 'live-pt',
                        'title' => $new->text,
                    )
                );
            }
            $comment_count = Comment::getCommentCount($new->id);
            $text = nl2br(htmlspecialchars($new->text));
            echo <<<EOF
            <div class="pt-item">
                <div>
                    <p>
                    {$text}<br />
                    {$img}
                    </p>
                </div>
                <div class="clearfix">
                    <span class="count">{$comment_count}条</span>
                    <a href="#" class="comment">评论</a>
                    <span class="time">{$new->time}</span>
                </div>
                <div class="comment">
EOF;
            $this->echoComment($new->id);
            $name = isset($_COOKIE['username']) ? $_COOKIE['username'] : "";
            echo <<<EOF
                    <form class="form-inline" method="post" action="index.php?r=site/sendComment&id={$new->id}">
                        <input placeholder="昵称" value="{$name}" type="text" name="name" />
                        : <input placeholder="评论" type="text" name="msg" />
                        <input class="btn btn-info" type="submit" value="发表评论" />
                    </form>
                    </div>
            </div>
EOF;
        }
    }

    public function echoComment($news_id) {
        $comments = Comment::getComments($news_id);
        echo '<div class="comment-list">';
        if (count($comments) > 0) {
            foreach ($comments as $c) {
                $name = htmlspecialchars($c->name);
                $msg = htmlspecialchars($c->msg);
                echo <<<EOF
                    <div class="clearfix">
                        <strong>{$name}:</strong>
                        <span class="msg">{$msg}</span>
                        <span class="time">{$c->time}</span>
                    </div>
EOF;
            }
        }
        echo '</div>';
    }

    public function echoPic($news) {
        foreach ($news as $new) {
            $link = "uploads/images/{$new->img}";
            $img = CHtml::link(
                CHtml::tag('img', array(
                    'src' => $link
                )),
                $link,
                array(
                    'class' => 'fancybox',
                    'data-fancybox-group' => 'live-pic',
                    'title' => $new->text,
                )
            );
            echo '<li>';
            echo $img;
            echo '</li>';
        }
    }
}
