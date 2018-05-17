<?php

use yii\db\Migration;

/**
 * Handles the creation of table `menu_type`.
 */
class m161228_053634_create_menu_type_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('menu_type', [
            'id' => $this->primaryKey(),
            'title' => $this->string(50)->notNull(),   
            'description' => $this->string(255),
            'menutype' => $this->string(50)->notNull()->unique(),
            'status' => $this->boolean()->notNull()->defaultValue(1),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('menu_type');
    }
}
