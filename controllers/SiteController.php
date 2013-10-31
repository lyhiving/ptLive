<?php
class SiteController extends CController {
    public function actionIndex() {
        $this->render('index');
    }

    public function actionLoadPt() {
        $this->widget('ext.widgets.live', array(
            'offset' => $_GET['offset']
        ));
    }

    public function actionAdminLogin() {
        $this->layout = '/layouts/admin';
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->render('adminLogin');
        } else {
            $admin = Admin::findByPost();
            if ($admin != null) {
                $_SESSION['admin'] = array(
                    'id' => $admin->id,
                    'name' => $admin->name,
                    'avater' => $admin->avater,
                );
                $this->redirect(array(
                    'admin/publish'
                ));
            }
            else {
                $this->render(
                    'adminLogin',
                    array('error' => '密码错误')
                );
            }
        }
    }

    public function actionSendComment() {
        if (Comment::sendComment($_POST['name'], $_POST['msg'], $_GET['id'])) {
            setcookie('username', $_POST['name'], time()+2592000);
            echo 'ok';
        }
        else {
            echo 'error';
        }
    }

    public function isLogged() {
        return isset($_SESSION['admin']);
    }
}
