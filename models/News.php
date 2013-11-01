<?php
class News extends CActiveRecord {
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function relations() {
        return array(
            'admin' => array(self::BELONGS_TO, 'Admin', 'admin_id'),
            'comment' => array(self::HAS_MANY, 'Comment', 'news_id'),
        );
    }

    public static function publish() {
        $news = new News;
        
        $pic = CUploadedFile::getInstanceByName('img');
        $types = array('jpg', 'jpeg', 'gif', 'png');

        if ($pic != null) {
            if($pic->getSize() > 2*1024*1024){
                return "提示：文件不能超过2M,{$pic->getSize()}";
            } else if ( !in_array(strtolower($pic->getExtensionName()), $types)) {
                return "提示：文件类型{$pic->getType()}不允许";
            } else {
                $img_filename =
                    md5($pic->getName().time())
                    . '.'
                    . $pic->getExtensionName();
                $news->img = $img_filename;
                $pic->saveAs('uploads/images/'.$img_filename);
            }
        }
        else {
            $news->img = '';
        }
        $news->admin_id = $_SESSION['admin']['id'];
        $news->text = $_POST['text'];
        return $news->save();
    }

    /**
     * getNews 读取新闻
     * @param int $offset 
     * @param int $limit 
     * @param int $type 1,图文 2,图片
     * @static
     * @access public
     * @return CActiveRecord
     */
    public static function getNews($offset, $limit, $type = 1) {
        $condition = $type == 1 ? null : 'img<>""';
        return self::model()->findAll(array(
            'offset' => $offset,
            'limit' => $limit,
            'order' => 'id DESC',
            'condition' => $condition,
        ));
    }

    public static function getNewsOfPage($pageSize) {
        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        $count = News::model()->count($criteria);

        $pager = new CPagination($count);
        $pager->pageSize = $pageSize;
        $pager->applyLimit($criteria);

        $newsList = News::model()->findAll($criteria);
        return array(
            'pages' => $pager,
            'newsList' => $newsList,
        );
    }

    public static function delById($id) {
        $new = self::model()->findByPk($id);
        $img_file = 'uploads/images/'.$new->img;
        if( $new->img != '' &&
            file_exists($img_file))
        {
            unlink($img_file);
        }
        return $new->delete();
    }
}
