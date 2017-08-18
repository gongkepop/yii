<?php
namespace app\modules\author\models\form;

use app\modules\author\models\HgAuthor;
use Yii;
use app\modules\author\models\User;
use yii\base\Model;

/**
 * Signup form
 */
class Signup extends Model
{
    public $username;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => 'mdm\admin\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'mdm\admin\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $author = new HgAuthor();
            $author->author_name = $this->username;
            $author->author_mail = $this->email;
            $author->setPassword($this->password);
            $author->generateAuthKey();
            if ($author->save()) {
                return $author;
            }
        }

        return null;
    }
}
