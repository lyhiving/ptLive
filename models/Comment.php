<?php
class Comment extends CActiveRecord {
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'comment';
    }

    public static function sendComment($name, $msg, $news_id) {
        // TODO 判断空串
        $comment = new Comment;
        $comment->name = $name;
        $comment->msg = $msg;
        $comment->ip = self::getIp();
        $comment->news_id = $news_id;
        $comment->name = $name;
        return $comment->save();
    }

    public static function getComments($news_id) {
        return self::model()->findAll(array(
            'order' => 'id',
            'condition' => 'news_id=:news_id',
            'params' => array(':news_id' => $news_id),
        ));
    }

    public static function getCommentsOfPage($news_id, $pageSize) {
        $criteria = new CDbCriteria();
        $criteria->order = 'id';
        $criteria->condition = 'news_id=:news_id';
        $criteria->params = array(':news_id' => $news_id);
        $count = Comment::model()->count($criteria);

        $pager = new CPagination($count);
        $pager->pageSize = $pageSize;
        $pager->applyLimit($criteria);

        $commentList = Comment::model()->findAll($criteria);
        return array(
            'pages' => $pager,
            'commentList' => $commentList,
        );
    }

    public static function getCommentCount($news_id) {
        return self::model()->count(array(
            'condition' => 'news_id=:news_id',
            'params' => array(':news_id' => $news_id),
        ));
    }

    public static function delById($id) {
        $new = self::model()->findByPk($id);
        return $new->delete();
    }

    public static function delByNewsId($id) {
        return self::getCommentCount($id)==0 ||
            self::model()->deleteAll(
                'news_id=:news_id',
                array(
                    ':news_id' => $id
                )
            );
    }

    public static function getIp() {
        $allips = array();

        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            array_push($allips, $_SERVER['HTTP_CLIENT_IP']);
        }
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $proxyips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $allips = array_merge($allips, $proxyips);
        }
        if (isset($_SERVER['HTTP_X_REMOTE_ADDR'])) {
            array_push($allips, $_SERVER['HTTP_X_REMOTE_ADDR']);
        }
        array_push($allips, $_SERVER['REMOTE_ADDR']);

        foreach($allips as $ip) {
            $ip = trim($ip);
            if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                if (substr($ip, 0, 3) !== '127') {
                    return $ip;
                }
            }
        }
        return $_SERVER['REMOTE_ADDR'];
    }
}
