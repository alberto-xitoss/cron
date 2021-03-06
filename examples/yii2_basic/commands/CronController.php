<?php
/**
 * @author am2tec
 * Date: 06.02.16
 * Time: 16:52
 */

namespace app\commands;

use app\models\Task;
use am2tec\crontab\TaskRunner;
use yii\console\Controller;

class CronController extends Controller
{
    public function actionCheckTasks()
    {
        TaskRunner::checkAndRunTasks(Task::getAll());
    }
}
