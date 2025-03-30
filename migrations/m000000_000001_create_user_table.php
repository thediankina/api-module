<?php

use yii\db\Migration;

class m000000_000001_create_user_table extends Migration
{
    public string $table = 'user';
    public string $primaryKey = 'id';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            $this->primaryKey => $this->bigInteger()->unsigned()->notNull(),
            'access_token' => $this->string()->null(),
            'auth_key' => $this->string()->null(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->null(),
            'PRIMARY KEY ([[' . $this->primaryKey . ']])',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
