<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m170111_122013_create_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'alias' => $this->string(255),
            'description' => $this->text(),
            'published' => $this->boolean()->notNull()->defaultValue(1),
            'parent_id' => $this->integer()->defaultValue(0),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
            'created_at' => $this->date()->notNull(),
            'updated_at' => $this->date()->notNull(),
        ]);
        
        $this->createIndex('idx-category-lft', 'category', ['lft', 'rgt']);
        $this->createIndex('idx-category-rgt', 'category', ['rgt']);

        $date_time = new \DateTime();

        $this->execute(
            'INSERT INTO category (title, alias, lft, rgt, depth, created_at, updated_at) 
               VALUES
            (:title, :alias, :lft, :rgt, :depth, :created_at, :updated_at)', 
            [
                ':title' => 'Root', 
                ':alias' => 'root', 
                ':lft' => 1, 
                ':rgt' => 2, 
                ':depth' => 0,
                ':created_at' => $date_time->getTimestamp(),
                ':updated_at' => $date_time->getTimestamp(),
            ]
        );
    }

    /**
         * @inheritdoc
         */
    public function down()
    {
        $this->dropTable('category');
    }
}
