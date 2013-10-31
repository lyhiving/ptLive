<?php
/**
 * 菜单部件，controller active
 */
class menu extends CWidget {
    public $items = array();

    public function run() {
        echo '<ul class="nav">';
        foreach ($this->items as $item) {
            $url = explode('/', $item['url']);
            if ($this->getController()->getAction()->id == $url[1])
                $class = ' class="active"';
            else
                $class = '';

            $link = Yii::app()->createUrl($item['url']);
            echo "<li{$class}>";
            echo "<a href='{$link}'>";
            echo $item['label'];
            echo '</a>';
            echo '</li>';
        }

        echo "</ul>";
    }
}
