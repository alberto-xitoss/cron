<?php

/**
 * @author am2tec
 * Date: 23.01.16
 * Time: 12:37
 */
class BusinessModel extends CI_Model
{
    public function test()
    {
        $task = Task::findOne();
        /**
         * @var \am2tec\crontab\TaskInterface $task
         */
        echo $task->getCommand();
        return true;
    }
}
