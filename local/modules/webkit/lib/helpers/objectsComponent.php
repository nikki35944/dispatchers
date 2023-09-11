<?php

namespace Webkit\Helper;

use Bitrix\Main;
use Bitrix\Main\Type;
use Webkit\Table\ObjectsTable;

class objectsComponent extends \CBitrixComponent
{
    protected function checkModules()
    {
        if (!Main\Loader::includeModule('webkit'))
            throw new Main\LoaderException('WEBKIT_MODULE_NOT_INSTALLED');
    }

    function var1()
    {
        $result = ObjectsTable::getList([
            'select' => ['TITLE', 'ADDRESS', 'COMMENTARY']
        ]);

        return $result->fetchAll();
    }

    public function executeComponent()
    {
        $this->checkModules();

        $this-> arResult = $this->var1();

        $this->includeComponentTemplate();
    }
}