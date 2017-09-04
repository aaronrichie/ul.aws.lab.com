<?php
namespace app\tests\unit\UserFixtureTest;
use app\tests\codeception\fixtures\UserFixture;
use app\models\SimUser;
use app\models\LoginForm;
use Yii;
class UserFixtureTest extends \yii\codeception\DbTestCase
{
    use \Codeception\Specify;
    
    /**
     * @var \UnitTester
     */
    protected $tester;
    public $appConfig = "@app/tests/codeception/config/unit.php";
    
    public function fixtures()
    {
        return [
            'users' => UserFixture::className(),
        ];
    }
    /**
 	 * Tests that app\models\User::validatePassword correctly validates the password
	 */
	public function testValidatePassword()
	{
            $model = new LoginForm([
            'email' => 'sysadmin@dcm.com',
            'password' => 'Sysadmin123',
        ]);
	}
}