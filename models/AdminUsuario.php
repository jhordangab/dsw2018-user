<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

class AdminUsuario extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $version;
    
    public $module;
    
    public function init()
    {
        if (!$this->module)
        {
            $this->module = Yii::$app->getModule("user");
        }
    }
    
    public static function tableName()
    {
        return 'admin_usuario';
    }

    public function rules()
    {
        return 
        [
            [['ultimasSenhas', 'departamento', 'obs'], 'string'],
            [['ultimaTrocaSenha', 'dataAlteracao', 'dataCriacao', 'dataExpiracao', 'dataNascimento'], 'safe'],
            [['acessoAoSistema', 'ausente', 'empresa_id', 'identificador', 'nivel', 'perfil_id', 'permissaoEmail', 'restrito', 'statusativo', 'usuarioAD', 'validarSuporte', 'idDepartamento', 'idCargo', 'trabalhaForaDeHorario', 'qtd_atividades'], 'integer'],
            [['horasContratadas', 'valorHora', 'meta'], 'number'],
            [['nome'], 'required'],
            [['alteradoPor', 'cadastradoPor', 'nome'], 'string', 'max' => 100],
            [['cargo', 'foto', 'login', 'profissao'], 'string', 'max' => 50],
            [['categoria', 'celular', 'fax', 'teleCom', 'teleRes'], 'string', 'max' => 150],
            [['dddCel', 'dddCom', 'dddFax', 'dddRes'], 'string', 'max' => 3],
            [['email', 'id_atribuir'], 'string', 'max' => 250],
            [['nomeResumo'], 'string', 'max' => 40],
            [['senha'], 'string', 'max' => 200],
            [['ramal', 'sexo'], 'string', 'max' => 10],
            [['status'], 'string', 'max' => 20],
            [['pausado'], 'string', 'max' => 1],
            [['rota'], 'string', 'max' => 30],
            [['identificador'], 'unique'],
            [['email'], 'unique'],
            [['login'], 'unique'],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdminEmpresa::className(), 'targetAttribute' => ['empresa_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return 
        [
            'id' => 'ID',
            'ultimasSenhas' => 'Ultimas Senhas',
            'ultimaTrocaSenha' => 'Ultima Troca Senha',
            'acessoAoSistema' => 'Acesso Ao Sistema',
            'alteradoPor' => 'Alterado Por',
            'ausente' => 'Ausente',
            'cadastradoPor' => 'Cadastrado Por',
            'cargo' => 'Cargo',
            'categoria' => 'Categoria',
            'celular' => 'Celular',
            'dataAlteracao' => 'Data Alteracao',
            'dataCriacao' => 'Data Criacao',
            'dataExpiracao' => 'Data Expiracao',
            'dataNascimento' => 'Data Nascimento',
            'departamento' => 'Departamento',
            'dddCel' => 'Ddd Cel',
            'dddCom' => 'Ddd Com',
            'dddFax' => 'Ddd Fax',
            'dddRes' => 'Ddd Res',
            'email' => 'Email',
            'empresa_id' => 'Empresa ID',
            'fax' => 'Fax',
            'foto' => 'Foto',
            'horasContratadas' => 'Horas Contratadas',
            'identificador' => 'Identificador',
            'login' => 'Login',
            'nivel' => 'Nivel',
            'nome' => 'Nome',
            'nomeResumo' => 'Nome Resumo',
            'obs' => 'Obs',
            'perfil_id' => 'Perfil ID',
            'permissaoEmail' => 'Permissao Email',
            'profissao' => 'Profissao',
            'restrito' => 'Restrito',
            'senha' => 'Senha',
            'ramal' => 'Ramal',
            'sexo' => 'Sexo',
            'statusativo' => 'Statusativo',
            'usuarioAD' => 'Usuario Ad',
            'validarSuporte' => 'Validar Suporte',
            'status' => 'Status',
            'teleCom' => 'Tele Com',
            'teleRes' => 'Tele Res',
            'valorHora' => 'Valor Hora',
            'idDepartamento' => 'Id Departamento',
            'idCargo' => 'Id Cargo',
            'meta' => 'Meta',
            'pausado' => 'Pausado',
            'id_atribuir' => 'Id Atribuir',
            'rota' => 'Rota',
            'trabalhaForaDeHorario' => 'Trabalha Fora De Horario',
            'qtd_atividades' => 'Qtd Atividades',
        ];
    }

    public function getEmpresa()
    {
        return $this->hasOne(AdminEmpresa::className(), ['id' => 'empresa_id']);
    }
    
    public function getAuthKey(): string {
        return '';
    }

    public function getId() {
        return $this->id;
    }

    public function validateAuthKey($authKey): bool {
        return true;
    }

    public static function findIdentity($id): IdentityInterface 
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null): IdentityInterface {
        
    }
}
