<?php

use yii\db\Migration;

class m161108_095422_create_student extends Migration
{
    const STUDENT = "student";
    const SPECIALITY = "speciality";
    const LEADER = "leader";

    public function safeUp()
    {
        $this->createTable(self::STUDENT, [
            'id' => $this->primaryKey(),
            'last_name' => $this->string()->notNull(),//->comment('Фамилия'),
            'first_name' => $this->string()->notNull(),//->comment('Имя'),
            'parent_name' => $this->string()->notNull(),//->comment('Отчество'),

            'leader_id' => $this->integer(),//->comment('Руководитель'),
            'speciality_id' =>$this->integer()->notNull(),//->comment('Специальность'),
        ]);

        $this->addForeignKey('student__leader', self::STUDENT, 'leader_id', self::LEADER, 'id');
        $this->addForeignKey('student__speciality', self::STUDENT, 'speciality_id', self::SPECIALITY, 'id');
    }

    public function safeDown()
    {
        $this->dropTable(self::STUDENT);
    }
}
