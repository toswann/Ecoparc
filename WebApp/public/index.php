<?php
//
//This file is part of Ecoparc.
//
//Ecoparc is free software: you can redistribute it and/or modify
//it under the terms of the GNU General Public License as published by
//the Free Software Foundation, either version 3 of the License, or
//(at your option) any later version.
//
//Ecoparc is distributed in the hope that it will be useful,
//but WITHOUT ANY WARRANTY; without even the implied warranty of
//MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//GNU General Public License for more details.
//
//You should have received a copy of the GNU General Public License
//along with Ecoparc.  If not, see <http://www.gnu.org/licenses/>.
//
?>
<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

    define("ZEND_FRAMEWORK_DIR","../library");
    define("MODEL_DIR", ".");
    set_include_path(
      ".".PATH_SEPARATOR.
      MODEL_DIR.PATH_SEPARATOR.
      ZEND_FRAMEWORK_DIR.PATH_SEPARATOR.
      get_include_path()
    );

    // AutoLoad
    require_once 'Zend/Loader/Autoloader.php';
    $autoloader = Zend_Loader_Autoloader::getInstance();

    // Registry init
    Zend_Loader::loadClass("Zend_Registry");

    // Controller init
    Zend_Loader::loadClass('Zend_Controller_Front');
    Zend_Loader::loadClass('Zend_Controller_Router_Rewrite');
    $controller = Zend_Controller_Front::getInstance();

    $controller->setBaseUrl('');
    $controller->setControllerDirectory('../application/controllers');
    $controller->throwExceptions(true);

    // init viewRenderer
    Zend_Loader::loadClass("Zend_View");
    $view = new Zend_View();
    $viewRenderer = Zend_Controller_Action_HelperBroker::
        getStaticHelper('viewRenderer');
    $viewRenderer->setView($view)
                 ->setViewSuffix('phtml');

    //config for DB
//    $config = new Zend_Config_Ini('../application/configs/application.ini', 'general');
    $config = new Zend_Config_Ini('../config/config.ini', 'general');
    $registry = Zend_Registry::getInstance();  
    $registry->set('db_config',$config);
    $db_config = Zend_Registry::get('db_config');
    $db = Zend_Db::factory($db_config->db);
    Zend_Db_Table::setDefaultAdapter($db);

    

    // translate for forms http://framework.zend.com/manual/fr/zend.registry.using.html
    $translate = new Zend_Translate('ini',
                            '../application/views/language',
                             null,
                             array('scan' =>
                             Zend_Translate::LOCALE_FILENAME));
    Zend_Registry::set('Zend_Translate', $translate);

    // call dispatcher
    $controller->dispatch();

?>
