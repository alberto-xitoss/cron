<?php

use yii\db\Migration;

class m160222_112000_install_task_manager extends Migration
{
    public function up()
    {
        $this->db->createCommand(\am2tec\crontab\DbHelper::tableTasksSql())->execute();
        $this->db->createCommand(\am2tec\crontab\DbHelper::tableTaskRunsSql())->execute();
    }

    public function down()
    {
        $this->dropTable('tasks');
        $this->dropTable('task_runs');
    }
}
