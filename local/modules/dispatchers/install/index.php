<?php
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use Bitrix\Main\Entity\Base;

Loc::loadMessages(__FILE__);

Class dispatchers extends CModule
{

    var $MODULE_ID;

    public function __construct()
    {
        $arModuleVersion = array();

        include(__DIR__.'/version.php');

        $this->MODULE_ID = "dispatchers";
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];

        $this->MODULE_NAME = 'Список диспетчеров';
        $this->MODULE_DESCRIPTION = 'Описание модуля';
    }


    function InstallDB($install_wizard = true)
    {
        Loader::includeModule($this->MODULE_ID);

    if (!Application::getConnection(\Dispatchers\DispatchersTable::getConnectionName())
        ->isTableExists(Base::getInstance('\Dispatchers\DispatchersTable')->getDBTableName()
            )
        )
    {
        Base::getInstance('\Dispatchers\DispatchersTable')->createDbTable();
    }
        RegisterModule("dispatchers");

        return true;
    }

    function UnInstallDB($arParams = Array())
    {
        Loader::includeModule($this->MODULE_ID);

        UnRegisterModule("dispatchers");

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

        $this->InstallFiles();
        $this->InstallDB(false);

    }

    function DoUninstall()
    {
        $this->UnInstallDB(false);
    }
}
?>