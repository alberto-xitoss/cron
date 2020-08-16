<?php
namespace am2tec\crontab_tests;

use am2tec\crontab\TaskLoader;

/**
 * @author am2tec
 * Date: 07.02.16
 * Time: 13:49
 */
class TaskLoaderTest extends \PHPUnit_Framework_TestCase
{
    public function testSetClassFolder()
    {
        $set = TaskLoader::setClassFolder(__DIR__);
        $this->assertTrue(is_array($set));
    }

    /**
     * @throws \am2tec\crontab\TaskManagerException
     */
    public function testGetAllMethods()
    {
        $result = TaskLoader::getAllMethods(
            array(__DIR__ . '/..', __DIR__, __DIR__ . '/correct_mocks'),
            array(null, 'am2tec\\crontab_tests\\')
        );
        $this->assertTrue(is_array($result));
    }

    /**
     * @throws \am2tec\crontab\TaskManagerException
     */
    public function testGetAllMethodsExceptions()
    {
        $this->setExpectedException('am2tec\crontab\TaskManagerException');
        TaskLoader::getAllMethods('/mocks/');
    }

    /**
     * @throws \am2tec\crontab\TaskManagerException
     */
    public function testGetControllerMethodsExceptions()
    {
        $this->setExpectedException('am2tec\crontab\TaskManagerException');
        TaskLoader::getControllerMethods('/mocks/');
    }

    /**
     * @throws \am2tec\crontab\TaskManagerException
     */
    public function testLoadControllerExceptionsFile()
    {
        $this->setExpectedException('am2tec\crontab\TaskManagerException');
        TaskLoader::setClassFolder(__DIR__ . '/wrong_mocks');
        TaskLoader::loadController('FileWithoutClass');
    }

    /**
     * @throws \am2tec\crontab\TaskManagerException
     */
    public function testLoadControllerExceptions()
    {
        $this->setExpectedException('am2tec\crontab\TaskManagerException');
        TaskLoader::setClassFolder(__DIR__);
        TaskLoader::loadController('MockClass');
    }
}
