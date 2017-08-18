<?php

namespace app\modules\author\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "hg_author".
 *
 * @property integer $author_id
 * @property string $author_name
 * @property string $author_password
 * @property string $author_phone
 * @property string $author_mail
 * @property string $author_token
 * @property string $author_create_at
 * @property string $author_update_at
 * @property integer $author_status
 * @property integer $author_type
 * @property string $author_key
 * @property integer $author_is_delete
 */
class HgAuthor extends ActiveRecord
{
    const STATUS_ACTIVE = 0;
    const STATUS_NOT_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hg_author';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_name', 'author_password', 'author_phone', 'author_mail', 'author_token', 'author_create_at', 'author_update_at', 'author_status', 'author_type'], 'required'],
            [['author_create_at', 'author_update_at'], 'safe'],
            [['author_status', 'author_type', 'author_is_delete'], 'integer'],
            [['author_name', 'author_password', 'author_phone'], 'string', 'max' => 20],
            [['author_mail', 'author_key'], 'string', 'max' => 40],
            [['author_token'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'author_id' => 'Author ID',
            'author_name' => 'Author Name',
            'author_password' => 'Author Password',
            'author_phone' => 'Author Phone',
            'author_mail' => 'Author Mail',
            'author_token' => 'Author Token',
            'author_create_at' => 'Author Create At',
            'author_update_at' => 'Author Update At',
            'author_status' => 'Author Status',
            'author_type' => 'Author Type',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['author_id' => $id, 'author_status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['author_name' => $username, 'author_status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'author_token' => $token,
            'author_status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
//    public static function isPasswordResetTokenValid($token)
//    {
//        if (empty($token)) {
//            return false;
//        }
//        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
//        $parts = explode('_', $token);
//        $timestamp = (int)end($parts);
//        return $timestamp + $expire >= time();
//    }

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
    public function getAuthKey()
    {
        return $this->author_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->author_password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->author_password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->author_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->author_token = null;

    }
}
