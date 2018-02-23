<?php

namespace app\modules\user\models\forms;

use Yii;
use yii\base\Model;

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
        return [
            [["email", "password"], "required"],
        ];
    }

    public function attributeLabels()
    {
        return
        [
            "email" => 'Email',
            "password" => "Senha",
        ];
    }
    
    public function login($post)
    {
        if ($this->validate()) 
        {
            $user = $this->getUser($post);
            Yii::$app->session['user'] = $post;
            return Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        
        return false;
    }
    
    public function getUser($post)
    {
        if ($this->user === false)
        {
            $user = new \app\modules\user\models\User();
            $user->setAttributes($post);
            $this->user = $user;
        }
        
        return $this->user;
    }
}