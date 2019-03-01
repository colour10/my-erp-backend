<?php

use Phalcon\DI\FactoryDefault\CLI as CliDI,
    Phalcon\CLI\Console as ConsoleApp;

use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

define('VERSION', '1.0.0');

//Using the CLI factory default services container
$di = new CliDI();

// Define path to application directory
defined('APPLICATION_PATH')
 || define('APPLICATION_PATH', realpath(dirname(__FILE__)));

/**
* Register the autoloader and tell it to register the tasks directory
*/
$loader = new \Phalcon\Loader();
$loader->registerNamespaces(
    array(
        "Caicai\Taobaoke" => APP_PATH . '/app/models/taobaoke'
    )
);
$loader->registerDirs(
    array(
        APPLICATION_PATH . '/tasks',
        APPLICATION_PATH.'/models/'
    )
);
$loader->register();

require_once(APPLICATION_PATH."/models/vendor/autoload.php");

//Create a console application
$console = new ConsoleApp();
$console->setDI($di);

// Set the database service
$di['db'] = function() {
    $connection = new DbAdapter(array(
        "host"     => "rdsaeafyeaeafye.mysql.rds.aliyuncs.com",
        "username" => "changwei",
        "password" => "changwei_123",
        "dbname"   => "taobaoke"
    ));
    
    $connection->execute("SET CHARSET 'UTF8'");
    return $connection;
};

/**
 * Process the console arguments
 */
$arguments = array();
foreach($argv as $k => $arg) {
    if($k == 1) {
        $arguments['task'] = $arg;
    } elseif($k == 2) {
        $arguments['action'] = $arg;
    } elseif($k >= 3) {
        $arguments[] = $arg;
    }
}

// define global constants for the current task and action
define('CURRENT_TASK', (isset($argv[1]) ? $argv[1] : null));
define('CURRENT_ACTION', (isset($argv[2]) ? $argv[2] : null));

try {
    // handle incoming arguments
    $console->handle($arguments);
}
catch (\Phalcon\Exception $e) {
    echo $e->getMessage();
    exit(255);
}