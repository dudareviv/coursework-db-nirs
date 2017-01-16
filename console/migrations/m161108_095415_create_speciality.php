<?php

use yii\db\Migration;

class m161108_095415_create_speciality extends Migration
{
    const SPECIALITY = "speciality";

    public function safeUp()
    {
        $this->createTable(self::SPECIALITY, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),//->comment('Название'),
            'number' => $this->string()->notNull(),//->comment('Номер'),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable(self::SPECIALITY);
    }
}
