<?php

use yii\db\Migration;

/**
 * Handles the creation of table `realty_type`.
 */
class m180515_081403_create_realty_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('realty_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()
        ]);

        $this->insert('realty_type', [
            'name' => 'Квартира'
        ]);

        $this->insert('realty_type', [
            'name' => 'Дом'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('realty_type');
    }
}
