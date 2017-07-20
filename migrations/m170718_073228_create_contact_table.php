<?php

use yii\db\Migration;

/**
 * Handles the creation of table `contact`.
 */
class m170718_073228_create_contact_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('contact', [
            'contact_id' => $this->primaryKey(),
            'contact_phone' => $this->string(20)->notNull()->defaultValue(''),
            'contact_tel' => $this->string(20)->notNull()->defaultValue(''),
            'contact_qq' => $this->integer()->notNull()->defaultValue(0),
            'contact_wechat' => $this->string(100)->notNull()->defaultValue(''),
            'contact_mail' => $this->string(100)->notNull()->defaultValue(''),
            'contact_type' => $this->smallInteger(2)->notNull()->defaultValue(0),
            'contact_target_id' => $this->integer()->notNull()->defaultValue(0),
            'contact_address' => $this->string(200)->notNull()->defaultValue(''),
            'contact_is_delete' => $this->smallInteger(2)->notNull()->defaultValue(0),
            'contact_create_at' => $this->dateTime()->notNull()->defaultValue('1000-01-01 00:00:00'),
            'contact_update_at' => $this->dateTime()->notNull()->defaultValue('1000-01-01 00:00:00'),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('contact');
    }
}
