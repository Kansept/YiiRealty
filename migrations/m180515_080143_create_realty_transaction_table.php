<?php

use yii\db\Migration;

/**
 * Handles the creation of table `realty_transaction`.
 */
class m180515_080143_create_realty_transaction_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('realty_transaction', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()
        ]);

        $this->insert('realty_transaction', [
            'name' => 'Продажа',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('realty_transaction');
    }
}
