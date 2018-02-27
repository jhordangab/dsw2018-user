<?php
use yii\bootstrap\Modal;

Modal::begin([
    'id' => 'modalimport_balancete',
    'header' => "<h3> Importação de Balancetes</h3>",
    'size'=>'modal-lg',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => false] 
]);
?>

<iframe id="iframe_modal_import_balancete" src="<?php Yii::$app->request->getUrl() ?>" width="100%" height="350px" frameborder="0" ></iframe>

<?php Modal::end(); ?>