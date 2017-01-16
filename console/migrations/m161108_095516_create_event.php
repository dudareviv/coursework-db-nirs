<?php

use yii\db\Migration;

class m161108_095516_create_event extends Migration
{
    const EVENT = "event";
    const WORK = "work";

    public function safeUp()
    {
        $this->createTable(self::EVENT, [
            'id' => $this->primaryKey(),
            'work_id' => $this->integer()->notNull(),//->comment('Работа'),
            'title' => $this->string()->notNull(),//->comment('Заголовок'),
            'description' => $this->text()->notNull(),//->comment('Описание'),
            'money' => $this->float(2),//->comment('Деньги'),
            'date' => $this->date(),//->comment('Дата события'),
            'created_at' => $this->dateTime(),//->comment('Дата создания'),
            'updated_at' => $this->dateTime(),//->comment('Дата редактирования'),
        ]);

        $this->addForeignKey('event__work', self::EVENT, 'work_id', self::WORK, 'id');
    }

    public function safeDown()
    {
        $this->dropTable(self::EVENT);
    }
}
