<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m161213_101258_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),     
            'created_at' => $this->date()->notNull(),
            'updated_at' => $this->date()->notNull(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32),
            'email_confirm_token' => $this->string(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
        ]);

        
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
