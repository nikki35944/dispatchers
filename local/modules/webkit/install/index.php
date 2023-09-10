<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Config as Conf;
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Application;
use Bitrix\Main\Entity\Base;
use Bitrix\Main\Config\Option;

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

        Loader::includeModule($this->MODULE_ID);

        if (!Application::getConnection(\Webkit\DispatchersTable::getConnectionName())
            ->isTableExists(Base::getInstance('\Webkit\DispatchersTable')->getDBTableName())
            &&
            !Application::getConnection(\Webkit\ObjectsTable::getConnectionName())
            ->isTableExists(Base::getInstance('\Webkit\ObjectsTable')->getDBTableName())
        )
        {
            Base::getInstance('\Webkit\DispatchersTable')->createDbTable();
            Base::getInstance('\Webkit\ObjectsTable')->createDbTable();
        }


        return true;
    }

    function UnInstallDB($arParams = [])
    {
        Loader::includeModule($this->MODULE_ID);
        Application::getConnection(\Webkit\DispatchersTable::getConnectionName())
            ->queryExecute('drop table if exists ' . Base::getInstance('\Webkit\DispatchersTable')->getDBTableName());
        Application::getConnection(\Webkit\ObjectsTable::getConnectionName())
            ->queryExecute('drop table if exists ' . Base::getInstance('\Webkit\ObjectsTable')->getDBTableName());

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