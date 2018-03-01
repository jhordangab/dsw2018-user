<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\IdentityInterface;

class User extends Model implements IdentityInterface
{
    public $id;
    
    public $desc_uid;
    
    public $perfil_id;
    
    public $perfil_nome;
    
    public $nome;
    
    public $empresa_id;
    
    public $empresa_nome;
    
    public $version;
    
    public function rules()
    {
        $rules = 
        [
            [['id', 'desc_uid', 'perfil_id', 'perfil_nome', 'nome', 'empresa_id', 'empresa_nome', 'version'], 'safe'],
        ];

        return $rules;
    }

    public function attributeLabels()
    {
        return 
        [
            'id' => 'ID',
            'desc_uid' => 'UID',
            'perfil_id' => 'Perfil',
            'perfil_nome' => 'Perfil',
            'nome' => 'Nome',
            'empresa_id' => 'Empresa',
            'empresa_nome' => 'Empresa',
            'version' => 'Versão'
        ];
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
        $model = new User();
        $model->setAttributes(Yii::$app->session['user']);
         
        return $model;
    }

    public static function findIdentityByAccessToken($token, $type = null): IdentityInterface {
        
    }
}