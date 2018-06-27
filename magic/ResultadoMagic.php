<?php

namespace app\magic;

use Yii;
use app\models\forms\ResultadoForm;

class ResultadoMagic
{
    public static function get($model)
    {
        $data = [];
        
        switch ($model->tipo)
        {
            case ResultadoForm::RESULTADO_BALANCETE:
                $data = BalanceteBiMagic::get($model);
                break;
            
            case ResultadoForm::RESULTADO_CMV:
                $data = CmvBiMagic::get($model);
                break;
            
            case ResultadoForm::RESULTADO_DESPESA:
                $data = DespesaBiMagic::get($model);
                break;
            
            case ResultadoForm::RESULTADO_DFC:
                $data = DfcBiMagic::get($model);
                break;
            
            case ResultadoForm::RESULTADO_DRE:
                $data = DreBiMagic::get($model);
                break;
            
            case ResultadoForm::RESULTADO_LALUR:
                $data = LalurBiMagic::get($model);
                break;
            
            case ResultadoForm::RESULTADO_OUTRAS_DESPESAS:
                $data = OutraDespesaBiMagic::get($model);
                break;
            
            case ResultadoForm::RESULTADO_RF:
                $data = RfBiMagic::get($model);
        }
        
        return $data;
    }
}
    