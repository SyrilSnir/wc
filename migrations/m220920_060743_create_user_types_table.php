<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_types}}`.
 */
class m220920_060743_create_user_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_types}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Название типа пользователя'),
            'slug' => $this->string()->notNull()->comment('Идентификатор типа пользователя'),        
        ]);
        $this->addForeignKey(
            '{{%fk-users-user_type_id}}', 
            '{{%users}}', 
            'user_type_id', 
            '{{%user_types}}', 
            'id',
            'CASCADE');        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('{{%fk-users-user_type_id}}','{{%users}}');
        $this->dropTable('{{%user_types}}');
    }
}
