<?php

use yii\db\Migration;

/**
 * Handles the creation of table `realty`.
 */
class m180515_084132_create_realty_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('realty', [
            'id' => $this->primaryKey(),
            'created_at' => $this->date()->notNull(),
            'updated_at' => $this->date()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'realty_type_id' => $this->integer()->notNull(),
            'realty_transaction_id' => $this->integer()->notNull(),
            'city' => $this->string(),
            'street' => $this->string(),
            'house' => $this->string(),
            'price' => $this->float()->notNull(),
            'description' => $this->text(),
            'room' => $this->smallInteger(),
            'full_area' => $this->float(),
            'live_area' => $this->float(),
            'kitchen_area' => $this->float(),
            'terra' => $this->float(),
            'floor' => $this->smallInteger(),
            'full_floor' => $this->smallInteger(),
            'realty_image_id' => $this->smallInteger(),
        ]);


        $this->addForeignKey('fk-realty-realty_type_id',
            'realty',
            'realty_type_id',
            'realty_type',
            'id',
            'CASCADE'    
        );

        $this->addForeignKey('fk-realty-realty_transaction_id',
            'realty',
            'realty_transaction_id',
            'realty_transaction',
            'id',
            'CASCADE'    
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-realty-realty_type_id', 'realty');
        $this->dropForeignKey('fk-realty-realty_transaction_id', 'realty');
        $this->dropTable('realty');
    }
}
