<?php

use yii\db\Migration;

class m151031_064118_create_foreign_keys extends Migration
{
    public function up()
    {
        $this->addForeignKey('fk_report_operator_id', 'report', 'operator_id', 'operator', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_report_patient_id', 'report', 'patient_id', 'patient', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_report_test_report_id', 'report_test', 'report_id', 'report', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_report_test_test_id', 'report_test', 'test_id', 'test', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        $this->dropForeignKey('fk_report_operator_id', 'report');
        $this->dropForeignKey('fk_report_patient_id', 'report');
        $this->dropForeignKey('fk_report_test_report_id', 'report_test');
        $this->dropForeignKey('fk_report_test_test_id', 'report_test');
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
