<?php
class Admin extends CActiveRecord {
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }
    
    public static function findByPost() {
        return self::model()->find(
            'name=:name AND password=:pwd', 
            array(
                ':name' => $_POST['name'],
                ':pwd' => md5($_POST['pwd'])
            )
        );
    }
}
