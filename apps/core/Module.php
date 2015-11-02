<?php

namespace Phlame\Core;

use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Db\Adapter\Pdo\Sqlite as DbAdapter;
use Phalcon\Mvc\ModuleDefinitionInterface;

use Phlame\Core\Components\Html\Doc;


class Module implements ModuleDefinitionInterface
{
    /**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {

        $loader = new Loader();

        $loader->registerNamespaces(array(
            'Phlame\Core\Controllers' => __DIR__ . '/controllers/',
            'Phlame\Core\Models' => __DIR__ . '/models/',
            'Phlame\Core\Components' => __DIR__ . '/components/',
        ));

        $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {
        /**
         * Read configuration
         */
        $config = include APP_PATH . "/apps/core/config/config.php";

        /**
         * Setting up the view component
         */
        //$di['view'] = function () {
            //$view = new View();
            //$view->setViewsDir(__DIR__ . '/views/');

            //return $view;
        //};

        /**
         * Database connection is created based in the parameters defined in the configuration file
         */
        $di['db'] = function () use ($config) {
            return new DbAdapter($config->database->toArray());
        };
        
        $di->setShared('htmlDoc', function() {
			return new Doc();
		});

    }

}
