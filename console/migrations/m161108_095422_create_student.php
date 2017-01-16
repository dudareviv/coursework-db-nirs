<?php

use yii\db\Migration;

class m161108_095422_create_student extends Migration
{
    const STUDENT = "student";
    const USER = "user";
    const LEADER = "leader";

    public function safeUp()
    {
        $this->createTable(self::STUDENT, [
            'user_id' => $this->integer()->unique(),
            'leader_id' => $this->integer(),//->comment('Руководитель'),
            'speciality_id' =>$this->integer()->notNull(),//->comment('Специальность'),
        ]);

        $this->addForeignKey('student__user', self::STUDENT, 'user_id', self::USER, 'id');
        $this->addForeignKey('student__leader', self::STUDENT, 'leader_id', self::LEADER, 'user_id');
    }

    public function safeDown()
    {
        $this->dropTable(self::STUDENT);
    }
}
