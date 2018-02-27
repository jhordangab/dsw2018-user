<?php
use yii\bootstrap\Modal;

Modal::begin([
    'id' => 'modal_balancete',
    'header' => "<h3> Balancetes</h3>",
    'size'=>'modal-lg',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => false] 
]);
?>

<iframe id="iframe_modal_balancete" src="<?php Yii::$app->request->getUrl() ?>" width="100%" height="300px" frameborder="0" ></iframe>

<?php Modal::end(); ?>