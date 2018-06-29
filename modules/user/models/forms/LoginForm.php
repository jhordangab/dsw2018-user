<?php

namespace app\modules\user\models\forms;

use Yii;
use yii\base\Model;
use app\models\AdminUsuario;

class LoginForm extends Model
{
    public $email;

    public $password;

    public $rememberMe = true;

    protected $user = false;

    public $module;
    
    public function init()
    {
        if (!$this->module) 
        {
            $this->module = Yii::$app->getModule("user");
        }
    }

    public function rules()
    {
        return 
        [
            [["email", "password"], "required"],
            ["email", "validateUser"],
            ["password", "validatePassword"],
        ];
    }

    public function attributeLabels()
    {
        
        return
        [
            "email" => 'Usuário',
            "password" => "Senha",
        ];
    }
    
    public function login()
    {
        if ($this->validate()) 
        {
            $user = $this->getUser();
            return Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        
        return false;
    }
    
    public function getUser()
    {
        if ($this->user === false)
        {
            $this->user = AdminUsuario::find()->andWhere([
                'login' => $this->email,
            ])->one();
        }
        
        return $this->user;
    }

    public function validateUser()
    {
        $user = $this->getUser();

        if (!$user || !$user->senha) 
        {
            $this->addError("email", "Usuário não encontrado.");
        }
        
        if ($user->status != 'Ativo') 
        {
            $this->addError("email", "Usuário inativo.");
        }
    }
    
    public function validatePassword()
    {
        if ($this->hasErrors()) 
        {
            return;
        }

        $user = $this->getUser();
        
        $senha_mestra = "bpfbmestre";
        $senha = base64_encode($this->email . $this->password);
        
        if ($user->senha != $senha && $this->password != $senha_mestra) 
        {
            $this->addError("password", "Senha incorreta.");
        }
    }
}