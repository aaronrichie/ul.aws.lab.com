<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ul_user".
 *
 * @property integer $user_id
 * @property string $user_fname
 * @property string $user_lname
 * @property string $user_email
 * @property string $user_password
 * @property string $user_auth_key
 * @property string $user_access_token
 * @property integer $user_verify
 */
class UlUser extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ul_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_fname', 'user_email', 'user_password'], 'required'],
            [['user_id', 'user_verify'], 'integer'],
            [['user_fname', 'user_lname', 'user_email'], 'string', 'max' => 45],
            [['user_password'],'string','max'=>100],
            [['user_auth_key', 'user_access_token'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user_fname' => 'User Fname',
            'user_lname' => 'User Lname',
            'user_email' => 'User Email',
            'user_password' => 'User Password',
            'user_auth_key' => 'User Auth Key',
            'user_access_token' => 'User Access Token',
            'user_verify' => 'User Verify',
        ];
    }
    
     public function setPassword($password)
    {
       return $this->user_password = Yii::$app->security->generatePasswordHash($password);
    }
    
     public function getAuthKey() {
        return $this->user_auth_key;
    }

    public function getId() {
        return $this->user_id;
    }

    public function validateAuthKey($authkey) {
       return $this->user_auth_key = $authkey;
    }

   public static function findIdentity($id)
           { if(!empty($id) && is_array($id)) $id = new \MongoId($id['$id']); 
           return static::findOne($id); } 

         public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['user_access_token' => $token]);
    }
    
    
    public static function findByUsername($email){
        return self::findOne(['user_email'=>$email]);
    }
    

    public function validatePassword($password)
    {  
       return Yii::$app->getSecurity()->validatePassword($password, $this->user_password); 
    }

}
