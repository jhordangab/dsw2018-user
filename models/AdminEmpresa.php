<?php

namespace app\models;

use Yii;

class AdminEmpresa extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'admin_empresa';
    }

    public function rules()
    {
        return [
            [['nomeParaPesquisa', 'obs', 'email', 'info', 'complemento'], 'string'],
            [['razaoSocial'], 'required'],
            [['dataAlteracao', 'dataCriacao'], 'safe'],
            [['identificador', 'qtdVisitas', 'telefone1', 'telefone2', 'telefone3', 'idCargo', 'idDepartamento', 'licenciada'], 'integer'],
            [['horasManutencao'], 'number'],
            [['alteradoPor', 'cadastradoPor', 'razaoSocial'], 'string', 'max' => 200],
            [['categoria', 'cidade', 'referencia', 'setor', 'atividade', 'inscEstadual', 'rota'], 'string', 'max' => 300],
            [['cep', 'codigo', 'tipo', 'status', 'tipoEndereco'], 'string', 'max' => 20],
            [['cnpj', 'pais', 'estado', 'latitude', 'longitude'], 'string', 'max' => 30],
            [['contato', 'telefone', 'inscricaoMunicipal', 'fax'], 'string', 'max' => 150],
            [['correspondencia'], 'string', 'max' => 10],
            [['nomeResumo', 'endereco', 'nomeFantasia', 'numeroEndereco', 'logradouro'], 'string', 'max' => 100],
            [['ddd'], 'string', 'max' => 5],
            [['site'], 'string', 'max' => 50],
            [['dddFax'], 'string', 'max' => 3],
            [['tipoDeEmpresa'], 'string', 'max' => 40],
            [['agencia_cliente'], 'string', 'max' => 4],
            [['dv_agencia_cliente', 'dv_conta_corrente'], 'string', 'max' => 1],
            [['conta_corrente'], 'string', 'max' => 8],
            [['numero_convenio'], 'string', 'max' => 6],
            [['numero_controle_cliente'], 'string', 'max' => 25],
            [['banco'], 'string', 'max' => 500],
            [['identificador'], 'unique'],
            [['cnpj'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alteradoPor' => 'Alterado Por',
            'cadastradoPor' => 'Cadastrado Por',
            'categoria' => 'Categoria',
            'cep' => 'Cep',
            'cidade' => 'Cidade',
            'cnpj' => 'Cnpj',
            'codigo' => 'Codigo',
            'contato' => 'Contato',
            'correspondencia' => 'Correspondencia',
            'nomeParaPesquisa' => 'Nome Para Pesquisa',
            'nomeResumo' => 'Nome Resumo',
            'obs' => 'Obs',
            'pais' => 'Pais',
            'razaoSocial' => 'Razao Social',
            'referencia' => 'Referencia',
            'setor' => 'Setor',
            'tipo' => 'Tipo',
            'atividade' => 'Atividade',
            'ddd' => 'Ddd',
            'telefone' => 'Telefone',
            'site' => 'Site',
            'status' => 'Status',
            'tipoEndereco' => 'Tipo Endereco',
            'dataAlteracao' => 'Data Alteracao',
            'dataCriacao' => 'Data Criacao',
            'email' => 'Email',
            'endereco' => 'Endereco',
            'estado' => 'Estado',
            'identificador' => 'Identificador',
            'info' => 'Info',
            'inscEstadual' => 'Insc Estadual',
            'inscricaoMunicipal' => 'Inscricao Municipal',
            'nomeFantasia' => 'Nome Fantasia',
            'horasManutencao' => 'Horas Manutencao',
            'qtdVisitas' => 'Qtd Visitas',
            'telefone1' => 'Telefone1',
            'telefone2' => 'Telefone2',
            'telefone3' => 'Telefone3',
            'dddFax' => 'Ddd Fax',
            'fax' => 'Fax',
            'idCargo' => 'Id Cargo',
            'idDepartamento' => 'Id Departamento',
            'tipoDeEmpresa' => 'Tipo De Empresa',
            'licenciada' => 'Licenciada',
            'agencia_cliente' => 'Agencia Cliente',
            'dv_agencia_cliente' => 'Dv Agencia Cliente',
            'conta_corrente' => 'Conta Corrente',
            'dv_conta_corrente' => 'Dv Conta Corrente',
            'numero_convenio' => 'Numero Convenio',
            'numero_controle_cliente' => 'Numero Controle Cliente',
            'rota' => 'Rota',
            'complemento' => 'Complemento',
            'numeroEndereco' => 'Numero Endereco',
            'logradouro' => 'Logradouro',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'banco' => 'Banco',
        ];
    }
    
    public function getAnos()
    {
        $sql = <<<SQL
                
                SELECT ano 
                    FROM balancete 
                    WHERE empresa_id = {$this->id} 
                    AND is_ativo = 1 AND is_excluido = 0
                    GROUP BY ano 
                    ORDER BY ano DESC;
   
SQL;
                    
        return Yii::$app->db->createCommand($sql)->queryAll();
    }
}
