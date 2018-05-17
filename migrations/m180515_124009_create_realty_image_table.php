<?php

use yii\db\Migration;

/**
 * Handles the creation of table `realty_image`.
 */
class m180515_124009_create_realty_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('realty_image', [
            'id' => $this->primaryKey(),
            'path' => $this->string()->notNull(),
            'realty_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-realty_image-realty_id',
            'realty_image',
            'realty_id',
            'realty',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-realty_image-realty_id', 'realty_image');
        $this->dropTable('realty_image');
    }
}
