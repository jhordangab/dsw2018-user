<?php
use yii\bootstrap\Modal;

Modal::begin([
    'id' => 'modal_indicadores',
    'header' => "<h3> Indicadores</h3>",
    'size'=>'modal-lg',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => false] 
]);
?>

<iframe id="iframe_modal_indicadores" src="<?php Yii::$app->request->getUrl() ?>" width="100%" height="200px" frameborder="0" ></iframe>

<?php Modal::end(); ?>