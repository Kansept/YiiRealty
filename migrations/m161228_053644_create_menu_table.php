<?php

use yii\db\Migration;

/**
 * Handles the creation of table `menu`.
 */
class m161228_053644_create_menu_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('menu', [
            'id' => $this->primaryKey(),
            'menutype' => $this->string(50)->notNull(),
            'title' => $this->string(50)->notNull(),
            'link' => $this->string(256)->notNull(),
            'parent_id' => $this->integer()->defaultValue(0),
            'alias' => $this->string(255),
            'component_id' => $this->integer()->notNull()->defaultValue(1),
            'published' => $this->boolean()->notNull()->defaultValue(1),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
        ]);
        
        $this->createIndex('idx-menu-lft', 'menu', ['lft', 'rgt']);
        $this->createIndex('idx-menu-rgt', 'menu', ['rgt']);

        $this->execute(
            'INSERT INTO menu (title, menutype, link, alias, lft, rgt, depth) 
               VALUES
            (:title, :menutype, :link, :alias, :lft, :rgt, :depth)', 
            [
                ':title' => 'Root', 
                ':menutype' => '', 
                ':link' => '/', 
                'alias' => 'root', 
                ':lft' => 1, 
                ':rgt' => 2, 
                ':depth' => 0,
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {

        $this->dropIndex(
            'idx-menu-lft',
            'menu'
        );

        $this->dropIndex(
            'idx-menu-rgt',
            'menu'
        );
        
        $this->dropTable('menu');
    }
}
