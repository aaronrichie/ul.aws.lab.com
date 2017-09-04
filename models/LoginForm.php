<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\web\Browser\lib\Browser;
use kartik\password\StrengthValidator;


/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */

class LoginForm extends Model
{
    public $email;
    public $password;
    private $_user;
   

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],
         //   [['captcha'], 'required', 'on' => 'newcaptcha'],
            // rememberMe must be a boolean value
           
         //   ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            
//            ['password','match','pattern'=>'$\S*(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$','message'=>'Password must have atleast 1 uppercase and 1 number '],
            [['password'],'string','min'=>8],
  //          [['password'], StrengthValidator::className(), 'preset'=>'normal', 'userAttribute'=>'email'],
            
            //email validation
            ['email','email'],
            ['password', 'exist'],
            
    //        ['captcha', 'captcha', 'captchaAction' => 'site/captcha', 'on' => self::SCENARIO_CAPTCHA],
        ];
    }
 
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
//    public function validatePassword($attribute, $params)
//    {
//        if (!$this->hasErrors()) {
//            $user = $this->getUser();
//
//            if (!$user || !$user->validatePassword($this->password)) {
//                $this->addError($attribute, 'Incorrect Password');
//            }
//        }
//    }
    
    public function exist($attribute, $params)
    {
            $user = $this->getUser();

                if (!$user || !$user->validatePassword($this->password)) {
                    $this->addError($attribute, 'Incorrect credentials entered');
                }
            }
    
    

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            if(Yii::$app->user->login($this->getUser(), 20)){
                $user = UlUser::find()->where(['user_email' => $this->email])->one();
                $user->user_access_token = null;
                $user->save();
                Yii::$app->session->setFlash('success','You are logged in', true);
            }
            return Yii::$app->user->login($this->getUser(), 20);
        }
        return false; 
    }
    
    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === null) {
            $this->_user =UlUser::findByUsername($this->email);
        }
        return $this->_user;
    }
}
