<?php

use yii\db\Schema;
use yii\db\Migration;

class m150208_105840_create_contacts_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%contacts}}', [
            'id' => Schema::TYPE_PK,
            'first_name' => Schema::TYPE_STRING . ' NOT NULL',
            'last_name' => Schema::TYPE_STRING . ' NOT NULL',
            'email_address' => Schema::TYPE_STRING . ' NOT NULL',
            'description' => Schema::TYPE_STRING . ' NOT NULL',
        ]);
    }

    public function down()
    {
        echo "m150208_105840_create_contacts_table cannot be reverted.\n";

        return false;
    }
}
