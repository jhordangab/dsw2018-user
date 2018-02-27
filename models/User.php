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
    
    public $nome;
    
    public $version;
    
    public $is_admin;
    
    public $empresa_id;
    
    public function rules()
    {
        $rules = 
        [
            [['id', 'desc_uid', 'perfil_id', 'nome', 'version', 'is_admin', 'empresa_id'], 'safe'],
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
            'nome' => 'Nome',
            'version' => 'Versão',
            'is_admin' => 'Administrador',
            'empresa_id' => 'Empresa'
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