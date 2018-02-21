<?php
use mdm\admin\components\MenuHelper;
$callback = function($menu){
    // $data = eval($menu['data']); 
    //if have syntax error, unexpected 'fa' (T_STRING)  Errorexception,can use
   $data = $menu['data'];
    return [
        'label' => $menu['name'],
        'url' => [$menu['route']],
        'active' => [$menu['route']],
        'option' => $data,
        'icon' => $menu['data'], 
        'items' => $menu['children'],
    ];
};

$items = MenuHelper::getAssignedMenu(Yii::$app->user->id, null, $callback, true);
?>

<aside id="aside" class="ui-aside">
    <?php $menu =
    app\components\Menu::widget([
       'options' => ['class' => 'nav','id'=>'menutemplate'],
       'items' => $items
    ]);
    echo $menu;
    ?>
</aside>

<?php 
$js = <<< MENU

$( "#menutemplate" ).attr( "ui-nav", " " );
MENU;

$this->registerJs($js, $this::POS_END);
?>