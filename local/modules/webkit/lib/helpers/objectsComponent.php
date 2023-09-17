<?php

namespace Webkit\Helper;

use Bitrix\Main;
use Webkit\Table\ObjectsTable;
use Bitrix\Main\Context\Culture;


class objectsComponent extends \CBitrixComponent
{
    protected function checkModules()
    {
        if (!Main\Loader::includeModule('webkit'))
            throw new Main\LoaderException('WEBKIT_MODULE_NOT_INSTALLED');
    }

    function getObjectsAndDispatchers()
    {
        $result = [];

        $query = ObjectsTable::getList([
            'select' => ['ID', 'TITLE', 'ADDRESS', 'COMMENTARY', 'DISPATCHER.ID', 'DISPATCHER.ACTIVITY_START', 'DISPATCHER.COMMENTARY', 'DISPATCHER.B_USER_ID', 'DISPATCHER.ACCESS_LEVEL', 'USER.NAME'],
            'filter' => [],
            'runtime' => [
                new \Bitrix\Main\Entity\ReferenceField(
                    'DISPATCHER',
                    '\Webkit\Table\DispatchersTable',
                    ["=this.ID" => "ref.OBJECT_ID"],
                ),
                new \Bitrix\Main\Entity\ReferenceField(
                    'USER',
                    '\Bitrix\Main\UserTable',
                    ["=this.DISPATCHER.B_USER_ID" => "ref.ID"]
                ),
            ],
        ]);

        $resultArr = $query->fetchAll();

        foreach ($resultArr as $item) {
            if (! empty($item['WEBKIT_TABLE_OBJECTS_DISPATCHER_ACTIVITY_START'])) {
                $objTime = $item['WEBKIT_TABLE_OBJECTS_DISPATCHER_ACTIVITY_START'];
                $item['WEBKIT_TABLE_OBJECTS_DISPATCHER_ACTIVITY_START'] = $objTime->format('d-m-Y H:i');
            }
            $result[] = $item;
        }

        return $result;
    }

    public function executeComponent()
    {
        $this->checkModules();

        $this-> arResult = $this->getObjectsAndDispatchers();

        $this->includeComponentTemplate();
    }
}