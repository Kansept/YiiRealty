<?php

use yii\db\Migration;

class m170112_120145_add_column_category_id_to_page_table extends Migration
{
    public function up()
    {
        $this->addColumn(
            'page', 
            'category_id', 
            $this->integer()->notNull()
        );
        $this->addForeignKey('fk-page-category_id', 
            'page', 
            'category_id',
            'category',
            'id',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropForeingKey('fk-page-category_id', 'page');
        $this->dropColumn('page', 'category_id');

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
