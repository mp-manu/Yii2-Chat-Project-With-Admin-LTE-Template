<?php

namespace app\models;

use Yii;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use \yii\db\Query;

/**
 * This is the model class for table "user".
 *
 * @property int $user_id
 * @property string $username
 * @property string $user_password
 * @property string $user_type
 * @property int $is_block
 * @property string $avatar
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 *
 * @property LoginDetails[] $loginDetails
 * @property User $createdBy
 * @property User[] $users
 * @property User $updatedBy
 * @property User[] $users0
 * @property User[] $fio
 * @property User[] $telefon
 * @property User[] $email
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $current_pass,$new_pass,$retype_pass;
    public $create_password, $confirm_password, $admin_user;
    const STATUS_ACTIVE = 0;
    const STATUS_BLOCK = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'user_password', 'user_type'], 'required'],
            [['created_at', 'updated_at', 'photo', 'fio', 'telefon'], 'safe'],
            [['is_block', 'created_by', 'updated_by'], 'integer'],
            ['current_pass','checkOldPassword','on'=>'change','message'=>''],
            [['new_pass', 'retype_pass'], 'match', 'pattern' => '/^(?=.*\d)(?=.*[a-z])(?!.*\s).*$/', 'message'=>'Password should consist of chars and number!'],
            ['retype_pass', 'compare','compareAttribute'=>'new_pass'],
            [['username'], 'string', 'max' => 65],
            [['new_pass'], 'string', 'min' => 6,],
            [['retype_pass'], 'string', 'min' => 6,],
            [['user_password'], 'string', 'max' => 150],
            [['username'], 'unique'],
            [['email'], 'email'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'user_id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'user_id']],
            [['secret_key'], 'unique'],
            [['photo'], 'file',  'extensions' => 'jpg, png, svg, jpeg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'UID'),
            'username' => 'Login',
            'user_password' => 'Password',
            'user_type' => 'Тип',
            'is_block' => 'Is block',
            'created_at' => 'Registrated At',
            'created_by' => Yii::t('app', 'Registrated By'),
            'updated_at' => Yii::t('app', 'Updated Time'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'current_pass' => Yii::t('app','Current Password'),
            'new_pass' => Yii::t('app','New Password'),
            'retype_pass' => Yii::t('app', 'Retype Password'),
            'admin_user' => Yii::t('app', 'Admin Username'),
            'create_password' => Yii::t('app', 'Admin Password'),
            'confirm_password' => Yii::t('app', 'Confirm Password'),
        ];
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }



    public static function findByEmail($email)
    {
        return static::findOne([
            'email' => $email
        ]);
    }

    public static function findBySecretKey($key)
    {
        // if (!static::isSecretKeyExpire($key))
        // {
        //     return null;
        // }
        return static::findOne([
            'secret_key' => $key,
        ]);
    }


    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();

    }

    /**
     * @inheritdoc
     */
    // public function getAuthKey()
    // {
    //     return $this->authKey;
    // }

    /**
     * @inheritdoc
     */
    // public function validateAuthKey($authKey)
    // {
    //     return $this->authKey === $authKey;
    // }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->user_password === md5($password.$password);
    }

    // Generates "remember me" authentication key
    // public function generateAuthKey()
    // {
    //     $this->auth_key = Security::generateRandomKey();
    // }

    // Generates new password reset token
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomKey() . '_' . time();
    }

    // Removes password reset token
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdmissionLetters()
    {
        return $this->hasMany(AdmissionLetter::className(), ['created_by' => 'user_id']);
    }


    /**
     *  @ check old password is correct or wrong.
     */
    public function checkOldPassword($attribute,$params)
    {
        $record = User::find()->where(['user_password'=>md5($this->current_pass.$this->current_pass)])->one();

        if($record === null) {
            $this->addError($attribute, 'Invalid or Wrong password');
        }
    }

    public static function getUserType($user_id)
    {
        $query = new Query();
        $type = $query->select(['user.user_type'])
            ->from('user')
            ->where(['user.user_id' => $user_id])
            ->one();
        return $type;
    }

    public static function getUserList(){
        $users = User::find()->all();
        return $users;
    }



    public function generateSecretKey()
    {
        $this->secret_key = Yii::$app->security->generateRandomString().'_'.time();
    }

    public function removeSecretKey()
    {
        $this->secret_key = null;
    }

    public static function isSecretKeyExpire($key)
    {
        if (empty($key))
        {
            return false;
        }
        $expire = Yii::$app->params['secretKeyExpire'];
        $parts = explode('_', $key);
        $timestamp = (int) end($parts);

        return $timestamp + $expire >= time();
    }

    /**
     * Генерирует хеш из введенного пароля и присваивает (при записи) полученное значение полю password_hash таблицы user для
     * нового пользователя.
     * Вызываеться из модели RegForm.
     */
    public function setPassword($password)
    {
        $this->user_password = md5($password.$password);
    }

    /**
     * Генерирует случайную строку из 32 шестнадцатеричных символов и присваивает (при записи) полученное значение полю auth_key
     * таблицы user для нового пользователя.
     * Вызываеться из модели RegForm.
     */
    public function generateAuthKey(){
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Сравнивает полученный пароль с паролем в поле password_hash, для текущего пользователя, в таблице user.
     * Вызываеться из модели LoginForm.
     */
    // public function validatePassword($password)
    // {
    //     return Yii::$app->security->validatePassword($password, $this->password_hash);
    // }

    /* Аутентификация пользователей */
    public static function findIdentity($id)
    {
        return static::findOne([
            'user_id' => $id,
            'is_block' => self::STATUS_ACTIVE
        ]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }


    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public static function getUsers(){
      return  self::find()->where(['is_block' => 0])->asArray()->all();
    }

    public static function getUserFioById($uid){
        return self::find()->where(['user_id' => $uid])->asArray()->one()['fio'];
    }
}
