<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m220909_101529_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'login' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string(),
            'auth_key' => $this->string(),
            'password_reset_token' => $this->string()->unique(),
            'fio' => $this->string()->comment('ФИО'),
            'email' => $this->string()->comment('Электронная почта'),
            'phone' => $this->string()->comment('Номер телефона'),
            'birthday' => $this->integer()->unsigned()->comment('Дата рождения'),
            'avatar' => $this->string()->comment('Путь к файлу с аватаром'),
            'description' => $this->text()->comment('Дополнительная информация'),
            'user_type_id' => $this->integer()->notNull()->comment('Тип пользователя'),            
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
            'status' => $this->boolean()->notNull()->defaultValue(true), 
            'deleted' => $this->boolean()->notNull()->defaultValue(false),             
        ]);
        $this->createIndex(
            'idx-users-user_type_id',
            '{{%users}}',
            'user_type_id'
        );        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-users-user_type_id',
            '{{%users}}'
        );        
        $this->dropTable('{{%users}}');
        
    }
}
