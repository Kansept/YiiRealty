<?php

use yii\db\Migration;

/**
 * Handles the creation of table `page`.
 */
class m161209_051156_create_page_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('page', [
            'id' => $this->primaryKey(),
            'name' => $this->string(250)->notNull(),
            'content' => $this->text(),
            'status' => $this->boolean()->notNull()->defaultValue(1),
            'alias' => $this->string(250),           
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('page');
    }
}
