<?php
namespace am2tec\crontab_tests;

use am2tec\crontab\TaskInterface;
use am2tec\crontab\TaskLoader;
use am2tec\crontab\TaskRunner;

/**
 * @author am2tec
 * Date: 07.02.16
 * Time: 14:15
 */
class TaskRunnerTest extends \PHPUnit_Framework_TestCase
{
    public function testCheckAndRunTasks()
    {
        $task_inactive = TaskMock::createNew();
        $task = TaskMock::createNew();
        $task->setStatus(TaskInterface::TASK_STATUS_ACTIVE);
        $task->setTime('* * * * *');
        TaskRunner::checkAndRunTasks(array($task, $task_inactive));
    }

    public function testGetRunDates()
    {
        $result = TaskRunner::getRunDates('* * * * *');
        $this->assertTrue(is_array($result));
        $this->assertEquals(10, count($result));
    }

    public function testGetRunDatesException()
    {
        $result = TaskRunner::getRunDates('wrong expression');
        $this->assertTrue(is_array($result));
        $this->assertEquals(0, count($result));
    }

    public function testParseAndRunCommand()
    {
        $result = TaskRunner::parseAndRunCommand('am2tec\crontab_tests\ActionMock::returnResult()');
        $this->assertTrue($result);

        $result = TaskRunner::parseAndRunCommand('am2tec\crontab_tests\ActionMock::wrongMethod()');
        $this->assertFalse($result);

        TaskLoader::setClassFolder(__DIR__ . '/runner_mocks');
        $result = TaskRunner::parseAndRunCommand('RunnerMock::anyMethod()');
        $this->assertFalse($result);
    }
}
