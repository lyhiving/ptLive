<?php
class AdminController extends CController {
    public $layout = '/layouts/admin';

    public function init() {
        parent::init();

        if (!$this->isLogged()) {
            $this->redirect(array(
                'site/adminLogin'
            ));
        }
    }

    public function actionIndex() {
        $this->redirect(array(
            $this->isLogged() ?
                'admin/publish' : 'site/adminLogin'
        ));
    }

    public function actionPublish() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->render('publish');
        }
        else {
            if (( $msg = News::publish() ) === true) {
                $this->redirect(array(
                    'alert', 
                    'msg' => '发布成功',
                    'jump' => 'publish',
                ));
            } else {
                $this->redirect(array(
                    'alert', 
                    'msg' => "发布失败 - {$msg}",
                    'jump' => 'publish',
                ));
            }
        }
    }

    public function actionPtManager() {
        $this->render('ptManager',
            News::getNewsOfPage(10));
    }

    public function actionComment() {
        $this->render('comment',
            Comment::getCommentsOfPage($_GET['news_id'], 10)
        );
    }

    public function actionDelPt() {
        if (isset($_GET['news_id'])) {
            $msg = (Comment::delByNewsId($_GET['news_id']) &&
                News::delById($_GET['news_id'])) ?
                    '删除成功' : '删除失败';
            $this->redirect(array(
                'alert',
                'msg' => $msg,
                'jump' => 'ptManager',
            ));
        }
    }

    public function actionDelComment() {
        if (isset($_GET['id'])) {
            $this->redirect(array(
                'alert',
                'msg' => (Comment::delById($_GET['id']) ?
                    '删除成功' : '删除失败'),
                'jump' => 'comment&news_id=' . $_GET['news_id'],
            ));
        }
    }

    public function actionAlert() {
        $this->render('alert', array(
            'msg' => $_GET['msg']
        ));
    }

    public function actionLogout() {
        unset($_SESSION['admin']);
        $this->redirect(array('site/index'));
    }

    public function isLogged() {
        return isset($_SESSION['admin']);
    }
}
