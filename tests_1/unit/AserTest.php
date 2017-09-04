<?php

use app\models\SimUser;
use app\models\LoginForm;
use Codeception\Specify;
class AserTest extends \Codeception\Test\Unit
{
    
    protected $tester;

    // executed before each test
    protected function _before()
    {
    }

    // executed after each test
    protected function _after()
    {
    }

    // TODO add test methods here
     public function testValidateEmail()
    {
        $user = new \app\models\SimUser();

        $user->findByUsername('sysadmin@dcm.com');
        $this->assertFalse($user->user_email == "sysadmin@dcm.com");
        unset($user);
    }
    
    public function testValidatePassword()
   {
        $user = SimUser::find()->where(['user_id'=> 1])->one();
        $this->assertInstanceOf('app\models\SimUser', $user);
        $this->assertTrue(
                $user->validatePassword('Sysadmin13'));  
  }    
    
//    public function testValidate()
//    {
//        $this->specify('email and password required', function(){
//            $user = new SimUser;
//            //Verify our Validation fails as we didn't provide any attributes
//            $this->assertFalse($user->validate());
//            
//            //Verify that email and password properties are required
//            $this->assertTrue($user->hasErrors('user_email'));
//            $this->assertTrue($user->hasErrors('user_password_hash'));
//            $user->user_email = 'sysadmin@dcm.com';
//            $user->user_password_hash = user_password_hash('Sysadmin123',PASSWORD_BCRYPT_DEFAULT_COST);
//            $this->assertTrue($user->validate());
//            
//        });
//    }
     use Specify;

    protected function tearDown()
    {
        Yii::$app->user->logout();
        parent::tearDown();
    }

    public function testLoginNoUser()
    {
        $model = new LoginForm([
            'email' => 'not_existing_username',
            'password' => 'not_existing_password',
        ]);

        $this->specify('user should not be able to login, when there is no identity', function () use ($model) {
            expect('model should not login user', $model->login())->false();
            expect('user should not be logged in', Yii::$app->user->isGuest)->true();
        });
    }

    public function testLoginWrongPassword()
    {
        $model = new LoginForm([
            'email' => 'sysadmin@dcm.com',
            'password' => 'wrong_password',
        ]);

        $this->specify('user should not be able to login with wrong password', function () use ($model) {
            expect('model should not login user', $model->login())->false();
            expect('error message should be set', $model->errors)->hasKey('password');
            expect('user should not be logged in', Yii::$app->user->isGuest)->true();
        });
    }

    public function testLoginCorrect()
    {
        $model = new LoginForm([
            'email' => 'sysadmin@dcm.com',
            'password' => 'Sysadmin123',
        ]);

        $this->specify('user should be able to login with correct credentials', function () use ($model) {
            expect('model should login user', $model->login())->true();
            expect('error message should not be set', $model->errors)->hasntKey('password');
            expect('user should be logged in', Yii::$app->user->isGuest)->false();
        });
    }
          
}
