<?php

namespace app\models;

use Yii;
use moonland\phpexcel\Excel;
use app\magic\StatusBalanceteMagic;

class BalanceteImportForm extends yii\base\Model
{
    public $mes;
    
    public $ano;
    
    public $file;
    
    public $importar_saldo;
            
    public function rules()
    {
        return 
        [
            [['file', 'mes', 'ano'], 'required'],
            [['file'], 'file', 'extensions' => 'xls, xlsx, ods'],
            [['mes'], 'validateBalancete'],
            [['importar_saldo'], 'validateSaldo'],
            [['importar_saldo'], 'boolean']
        ];
    }
    
    public function attributeLabels()
    {
        return 
        [
            'file' => 'Arquivo',
        ];
    }
    
    public function validateBalancete($attribute, $params, $validator)
    {
        $empresa_id = Yii::$app->user->identity->empresa_id;
        
        $find = Balancete::find()->andWhere(
        [
            'mes' => $this->mes, 
            'ano' => $this->ano, 
            'empresa_id' => $empresa_id,
            'is_ativo' => TRUE, 
            'is_excluido' => FALSE
        ])->exists();
        
        if ($find) 
        {
            $this->addError('mes', 'O balancete já foi importado para o período selecionado.');
            $this->addError('ano', 'O balancete já foi importado para o período selecionado.');
        }
    }
    
    public function validateSaldo($attribute, $params, $validator)
    {
        if($this->importar_saldo)
        {
            $empresa_id = Yii::$app->user->identity->empresa_id;

            $saldoInicial = SaldoInicial::find()->andWhere([
                'empresa_id' => $empresa_id,
                'is_ativo' => TRUE, 
                'is_excluido' => FALSE
            ])->exists();

            if ($saldoInicial) 
            {
                $this->addError($attribute, 'O saldo inicial dessa empresa já foi importado');
            }
        }
    }
    
    public function save()
    {
        $time = time();
        $file_path = 'csv/balancete/';
        $file = $time. '.' . $this->file->extension;
        
        if (!file_exists($file_path)) 
        {
            mkdir($file_path, 0777, true);
        }
        
        $this->file->saveAs($file_path . $file);

        $data = Excel::import($file_path . $file);

        $empresa_id = Yii::$app->user->identity->empresa_id;
        $empresa_nome = Yii::$app->user->identity->empresa_nome;
        
        $balancete = new Balancete();
        $balancete->setScenario(Balancete::SCENARIO_IMPORTATION);
        $balancete->empresa_id = $empresa_id;
        $balancete->empresa_nome = $empresa_nome;
        $balancete->mes = $this->mes;
        $balancete->ano = $this->ano;
        $balancete->status = StatusBalanceteMagic::STATUS_SENT;
        $balancete->save();
        
        foreach($data[0] as $value)
        {
            $codigo = $this->alteraCategoria(str_replace([',', '.'], '', trim($value['Conta Contábil'])));
            
            $this->importarBalanceteMes($balancete->id, $empresa_id, $codigo, $value['Nomenclatura da Conta'], $value['Saldo do Mês']);
        
            if($this->importar_saldo)
            {
                $this->importarSaldoInicial($empresa_id, $empresa_nome, $codigo, $value['Saldo Anterior']);
            }
        }
        
        return true;
    }
    
    public function importarBalanceteMes($balancete_id, $empresa_id, $desc_codigo, $desc_categoria, $valor)
    {
        $categoria = CategoriaPadrao::findOne(['desc_codigo' => $desc_codigo]);
        $codigo = (integer) str_replace('.', '', $desc_codigo);
        
        if(!$categoria)
        {
            $categoria = CategoriaEmpresa::findOne(['desc_codigo' => $desc_codigo, 'empresa_id' => $empresa_id]);

            if(!$categoria)
            {
                $categoria = new CategoriaEmpresa();
                $categoria->empresa_id = $empresa_id;
                $categoria->codigo = $codigo;
                $categoria->desc_codigo = $desc_codigo;
                $categoria->descricao = $desc_categoria;
                $categoria->codigo_pai = $this->getCodigoPai($codigo);
                $categoria->is_service = (strlen($codigo) > 6);
                $categoria->save();
            }
        }
        
        $balancete_valor = new BalanceteValor();
        $balancete_valor->balancete_id = $balancete_id;
        $balancete_valor->categoria_id = $codigo;
        $balancete_valor->valor = $valor;
        $balancete_valor->save();
    }
    
    public function importarSaldoInicial($empresa_id, $empresa_nome, $categoria_id, $valor)
    {
        $saldoInicial = new SaldoInicial();
        $saldoInicial->empresa_id = $empresa_id;
        $saldoInicial->empresa_nome = $empresa_nome;
        $saldoInicial->ano = $this->ano;
        $saldoInicial->mes = $this->mes;
        $saldoInicial->categoria_id = (integer) str_replace('.', '', $categoria_id);
        $saldoInicial->valor = $valor;
        $saldoInicial->save();
    }
    
    public function alteraCategoria($codigo)
    {
        if (strpos($codigo, '.') !== true)
        {
            switch (strlen($codigo))
            {
                case 1:
                    return $codigo;
                case 2:
                    return substr($codigo, 0, 1) . '.' . substr($codigo, 1, 1);
                case 3:
                    return substr($codigo, 0, 1) . '.' . substr($codigo, 1, 1) .
                        '.' . substr($codigo, 2, 1);
                case 4:
                    return substr($codigo, 0, 1) . '.' . substr($codigo, 1, 1) .
                        '.' . substr($codigo, 2, 1) . '.' . substr($codigo, 3, 1);
                case 6:
                    return substr($codigo, 0, 1) . '.' . substr($codigo, 1, 1) .
                        '.' . substr($codigo, 2, 1) . '.' . substr($codigo, 3, 1) .
                            '.' . substr($codigo, 4, 2);
                case 7:
                    return substr($codigo, 0, 1) . '.' . substr($codigo, 1, 1) .
                        '.' . substr($codigo, 2, 1) . '.' . substr($codigo, 3, 1) .
                            '.' . substr($codigo, 4, 2) . '.' . substr($codigo, 6, 1);
                case 8:
                    return substr($codigo, 0, 1) . '.' . substr($codigo, 1, 1) .
                        '.' . substr($codigo, 2, 1) . '.' . substr($codigo, 3, 1) .
                            '.' . substr($codigo, 4, 2) . '.' . substr($codigo, 6, 2);
                case 9:
                    return substr($codigo, 0, 1) . '.' . substr($codigo, 1, 1) .
                        '.' . substr($codigo, 2, 1) . '.' . substr($codigo, 3, 1) .
                            '.' . substr($codigo, 4, 2) . '.' . substr($codigo, 6, 3);
                case 10:
                    return substr($codigo, 0, 1) . '.' . substr($codigo, 1, 1) .
                        '.' . substr($codigo, 2, 1) . '.' . substr($codigo, 3, 1) .
                            '.' . substr($codigo, 4, 2) . '.' . substr($codigo, 6, 4);
                default:
                    return $codigo;
            }
        }
        
        return $codigo;
    }
    
    public function getCodigoPai($codigo)
    {
        switch (strlen($codigo))
        {
            case 1:
                return null;
            case 2:
                return substr($codigo, 0, 1);
            case 3:
                return substr($codigo, 0, 2);
            case 4:
                return substr($codigo, 0, 3);
            case 6:
                return substr($codigo, 0, 4);
            case 7:
            case 8:
            case 9:
            case 10:
                return substr($codigo, 0, 6);
            default:
                return null;
        }
    }
}
