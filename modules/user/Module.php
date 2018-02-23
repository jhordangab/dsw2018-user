<?php

namespace app\modules\user;

use Yii;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;

class Module extends \yii\base\Module
{
    protected $version = "5.0.6";

    public $alias = "@user";

    public $requireEmail = true;

    public $requireUsername = false;

    public $useEmail = true;

    public $useUsername = false;

    public $loginEmail = true;

    public $loginUsername = false;

    public $loginDuration = 2592000; // 1 month

    public $loginRedirect = null;

    public $logoutRedirect = null;

    public $emailConfirmation = true;

    public $emailChangeConfirmation = true;

    public $resetExpireTime = "2 days";

    public $loginExpireTime = "15 minutes";

    public $emailViewPath = "@user/mail";

    public $forceTranslation = false;

    public $modelClasses = [];

    public function getVersion()
    {
        return $this->version;
    }

    public function init()
    {
        parent::init();

        $this->checkModuleProperties();

        if (empty(Yii::$app->i18n->translations['user'])) 
        {
            Yii::$app->i18n->translations['user'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => __DIR__ . '/messages',
                'forceTranslation' => $this->forceTranslation,
            ];
        }

        $this->modelClasses = array_merge($this->getDefaultModelClasses(), $this->modelClasses);

        $this->setAliases([
            $this->alias => __DIR__,
        ]);
    }

    protected function checkModuleProperties()
    {
        if ($this->requireEmail) 
        {
            $this->useEmail = true;
        }
        
        if ($this->requireUsername) 
        {
            $this->useUsername = true;
        }

        $className = get_called_class();

        if (!$this->requireEmail && !$this->requireUsername) 
        {
            throw new InvalidConfigException("{$className}: \$requireEmail and/or \$requireUsername must be true");
        }
        
        if (!$this->loginEmail && !$this->loginUsername)
        {
            throw new InvalidConfigException("{$className}: \$loginEmail and/or \$loginUsername must be true");
        }
        if (!$this->useEmail && ($this->emailConfirmation || $this->emailChangeConfirmation)) 
        {
            $msg = "{$className}: \$useEmail must be true if \$email(Change)Confirmation is true";
            throw new InvalidConfigException($msg);
        }

        $userComponent = Yii::$app->get('user', false);
        if ($userComponent && !$userComponent instanceof \app\modules\user\components\User) 
        {
            throw new InvalidConfigException('Yii::$app->user is not set properly. It needs to extend \app\modules\user\components\User');
        }
    }

    protected function getDefaultModelClasses()
    {
        if (Yii::$app->get('user', false)) 
        {
            $userClass = Yii::$app->user->identityClass;
        } 
        elseif (class_exists('app\models\User')) 
        {
            $userClass = 'app\models\User';
        } 
        else
        {
            $userClass = 'app\modules\user\models\User';
        }

        return
        [
            'User' => $userClass,
            'Profile' => 'app\modules\user\models\Profile',
            'Role' => 'app\modules\user\models\Role',
            'UserToken' => 'app\modules\user\models\UserToken',
            'UserAuth' => 'app\modules\user\models\UserAuth',
            'ForgotForm' => 'app\modules\user\models\forms\ForgotForm',
            'LoginForm' => 'app\modules\user\models\forms\LoginForm',
            'ResendForm' => 'app\modules\user\models\forms\ResendForm',
            'UserSearch' => 'app\modules\user\models\search\UserSearch',
            'LoginEmailForm' => 'app\modules\user\models\forms\LoginEmailForm',
        ];
    }

    public function model($name, $config = [])
    {
        $config["class"] = $this->modelClasses[ucfirst($name)];
        return Yii::createObject($config);
    }

    public function createController($route)
    {
        $validRoutes  = [$this->defaultRoute, "admin", "auth"];
        $isValidRoute = false;
        foreach ($validRoutes as $validRoute) 
        {
            if (strpos($route, $validRoute) === 0) 
            {
                $isValidRoute = true;
                break;
            }
        }

        return (empty($route) or $isValidRoute)
            ? parent::createController($route)
            : parent::createController("{$this->defaultRoute}/{$route}");
    }

    public function getActions()
    {
        return 
        [
            "/{$this->id}" => "This 'actions' list. Appears only when <strong>YII_DEBUG</strong>=true, otherwise redirects to /login or /account",
            "/{$this->id}/admin" => "Admin CRUD",
            "/{$this->id}/login" => "Login page",
            "/{$this->id}/logout" => "Logout page",
            "/{$this->id}/register" => "Register page",
            "/{$this->id}/login-email" => "Login page v2 (login/register via email link)",
            "/{$this->id}/login-callback?token=zzzzz" => "Login page v2 callback (after user clicks link in email)",
            "/{$this->id}/auth/login?authclient=facebook" => "Register/login via social account",
            "/{$this->id}/auth/connect?authclient=facebook" => "Connect social account to currently logged in user",
            "/{$this->id}/account" => "User account page (email, username, password)",
            "/{$this->id}/profile" => "Profile page",
            "/{$this->id}/forgot" => "Forgot password page",
            "/{$this->id}/reset?token=zzzzz" => "Reset password page. Automatically generated from forgot password page",
            "/{$this->id}/resend" => "Resend email confirmation (for both activation and change of email)",
            "/{$this->id}/resend-change" => "Resend email change confirmation (quick link on the 'Account' page)",
            "/{$this->id}/cancel" => "Cancel email change confirmation (quick link on the 'Account' page)",
            "/{$this->id}/confirm?token=zzzzz" => "Confirm email address. Automatically generated upon registration/email change",
        ];
    }
}
