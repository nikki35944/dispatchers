<?php

use Bitrix\Main\Application;
use Bitrix\Main\Entity\Base;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

Loc::loadMessages(__FILE__);

class webkit extends CModule
{

    var $MODULE_ID;

    public function __construct()
    {
        $arModuleVersion = [];

        include(__DIR__ . '/version.php');

        $this->MODULE_ID = "webkit";
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];

        $this->MODULE_NAME = 'Список диспетчеров';
        $this->MODULE_DESCRIPTION = 'Описание модуля';
    }


    function InstallDB($install_wizard = true)
    {
        global $DB, $APPLICATION;

        $errors = null;

        Loader::includeModule($this->MODULE_ID);

        if (!Application::getConnection(\Webkit\Table\ObjectsTable::getConnectionName())
                ->isTableExists(Base::getInstance('\Webkit\Table\ObjectsTable')
                    ->getDBTableName())
            &&
            !Application::getConnection(\Webkit\Table\DispatchersTable::getConnectionName())
                ->isTableExists(Base::getInstance('\Webkit\Table\DispatchersTable')->getDBTableName())
        )
        {
            Base::getInstance('\Webkit\Table\ObjectsTable')->createDbTable();
            Base::getInstance('\Webkit\Table\DispatchersTable')->createDbTable();

            //fks and indexes
            $errors = $DB->RunSQLBatch($_SERVER["DOCUMENT_ROOT"]."/local/modules/webkit/install/db/mysql/install.sql");

            $errors = $DB->RunSQLBatch($_SERVER["DOCUMENT_ROOT"]."/local/modules/webkit/install/db/mysql/demo_data.sql");

            if (!empty($errors))
            {
                $APPLICATION->ThrowException(implode("", $errors));
                return false;
            }

        }


        return true;
    }

    function UnInstallDB($arParams = [])
    {
        Loader::includeModule($this->MODULE_ID);
        Application::getConnection(\Webkit\Table\DispatchersTable::getConnectionName())
            ->queryExecute('drop table if exists ' . Base::getInstance('\Webkit\Table\DispatchersTable')->getDBTableName());
        Application::getConnection(\Webkit\Table\ObjectsTable::getConnectionName())
            ->queryExecute('drop table if exists ' . Base::getInstance('\Webkit\Table\ObjectsTable')->getDBTableName());

        return true;
    }

    function InstallEvents()
    {
        return true;
    }

    function UnInstallEvents()
    {
        return true;
    }

    function InstallFiles()
    {

        return true;
    }

    function UnInstallFiles()
    {
        return true;
    }

    function DoInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
        $this->InstallDB(false);
    }

    function DoUninstall()
    {
        $this->UnInstallDB(false);
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }
}

?>