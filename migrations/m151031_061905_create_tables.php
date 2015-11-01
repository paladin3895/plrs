<?php

use yii\db\Schema;
use yii\db\Migration;

class m151031_061905_create_tables extends Migration
{
    public function up()
    {
        $this->createTable('operator', [
            'id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING . ' NOT NULL UNIQUE',
            'auth_key' => Schema::TYPE_STRING . ' NOT NULL',
            'password' => Schema::TYPE_STRING . ' NOT NULL',
        ]);

        $this->createTable('patient', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'email' => Schema::TYPE_STRING . ' NOT NULL',
            'passcode' => Schema::TYPE_STRING . ' NOT NULL',
        ]);

        $this->createTable('report', [
            'id' => Schema::TYPE_PK,
            'patient_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'operator_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'date' => Schema::TYPE_DATE . ' NOT NULL',
        ]);

        $this->createTable('test', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'description' => Schema::TYPE_TEXT . ' NOT NULL',
        ]);

        $this->createTable('report_test', [
            'id' => Schema::TYPE_PK,
            'report_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'test_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'result' => Schema::TYPE_STRING . ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('report_test');
        $this->dropTable('report');
        $this->dropTable('test');
        $this->dropTable('operator');
        $this->dropTable('patient');
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
