<?php

use yii\db\Migration;

class m151031_082910_create_test_operator extends Migration
{
    public function up()
    {
        $this->insert('operator', [
            'username' => 'admin',
            'auth_key' => uniqid('', true),
            'password' => hash_hmac('sha1', 'password@123', ''),
        ]);
    }

    public function down()
    {

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
