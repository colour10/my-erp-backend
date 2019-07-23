<?php

use Phalcon\DI\FactoryDefault\CLI as CliDI,
    Phalcon\CLI\Console as ConsoleApp;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Logger;
use Phalcon\Events\Manager;
use Phalcon\Logger\Adapter\File as FileLogger;

define('VERSION', '1.0.0');



//Using the CLI factory default services container
$di = new CliDI();

define('APP_PATH', dirname(dirname(__FILE__)));

$config = new \Phalcon\Config\Adapter\Php(APP_PATH . "/app/config/config.php");

/**
* Register the autoloader and tell it to register the tasks directory
*/
$loader = new \Phalcon\Loader();
$loader->registerNamespaces(
    array(
        "Asa\Erp" => APP_PATH . '/app/models/erp',
        "Asa\Erp\Behavior" => APP_PATH . '/app/models/erp/behavior',
        // 新增测试临时表模型
        "Asa\Models\Temp" => APP_PATH . '/app/models/temp',
    )
);
$loader->registerDirs(
    array(
        APP_PATH . '/app/tasks/'
    )
)->register();

//require_once(APPLICATION_PATH."/models/vendor/autoload.php");

//Create a console application
$console = new ConsoleApp();
$console->setDI($di);

// Set the database service
$di['db'] = function() use($config) {
    if($config->mode=='develop') {
        $eventsManager = new EventsManager();

        $logger = new FileLogger($config->app->log_path . "/sql.log");

        // Listen all the database events
        $eventsManager->attach('db', function ($event, $connection) use ($logger) {
            if ($event->getType() == 'beforeQuery') {
                $logger->log(\Phalcon\Logger::INFO, $connection->getSQLStatement());
            }
        });

        $connection = new DbAdapter($config->database->db->toArray());

        $connection->execute("SET CHARSET 'UTF8'");

        $connection->setEventsManager($eventsManager);
        return $connection;
    }
    else {

        $connection = new DbAdapter($config->database->db->toArray());

        $connection->execute("SET CHARSET 'UTF8'");
        return $connection;
    }
};

$di->setShared('language', function () use ($config, $di) {
    $language = $config->language;
    //$system_language = new \Phalcon\Config\Adapter\Php(APP_PATH . "/app/config/languages/{$language}.php");
    return new \Phalcon\Config\Adapter\Php(APP_PATH . "/app/config/languages/{$language}.php");
});

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