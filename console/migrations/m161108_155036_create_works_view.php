<?php

use yii\db\Migration;

class m161108_155036_create_works_view extends Migration
{
    const EVENT = "event";
    const WORK = "work";

    public function safeUp()
    {
        $sql = "
        CREATE VIEW works_view AS
          SELECT
            dbo.[work].id            AS work_id,
            dbo.[work].theme         AS work_theme,
            dbo.[work].justification AS work_justification,
            dbo.[work].student_id    AS student_id,
            dbo.student.last_name    AS student_last_name,
            dbo.student.first_name   AS student_first_name,
            dbo.student.parent_name  AS student_parent_name,
            dbo.[work].leader_id     AS leader_id,
            dbo.leader.last_name     AS leader_last_name,
            dbo.leader.first_name    AS leader_first_name,
            dbo.leader.parent_name   AS leader_parent_name
          FROM dbo.[work]
            INNER JOIN
            dbo.leader ON dbo.[work].leader_id = dbo.leader.id
            INNER JOIN
            dbo.student ON dbo.[work].student_id = dbo.student.id AND dbo.leader.id = dbo.student.leader_id
        ";

        $this->db->createCommand($sql)->execute();
    }

    public function safeDown()
    {
        $sql = "
        DROP VIEW works_view
        ";

        $this->db->createCommand($sql)->execute();
    }
}
