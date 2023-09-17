<?php

namespace Webkit\Helper;

use Bitrix\Main;

class dispatchersComponent extends \CBitrixComponent
{
    protected function checkModules()
    {
        if (!Main\Loader::includeModule('webkit'))
            throw new Main\LoaderException('WEBKIT_MODULE_NOT_INSTALLED');
    }


    function getDispatchersAndObjects()
    {
        $result = \Webkit\Table\DispatchersTable::getList([
            'select' => ['*', 'OBJECT.ID', 'OBJECT.TITLE', 'OBJECT.ADDRESS', 'OBJECT.COMMENTARY', 'USER.NAME'],
            'filter' => [],
            'runtime' => [
                new \Bitrix\Main\Entity\ReferenceField(
                    'OBJECT',
                    '\Webkit\Table\ObjectsTable',
                    ["=this.OBJECT_ID" => "ref.ID"],
                    ["join_type" => "left"]
                ),
                new \Bitrix\Main\Entity\ReferenceField(
                    'USER',
                    '\Bitrix\Main\UserTable',
                    ["=this.B_USER_ID" => "ref.ID"],
                    ["join_type" => "left"]
                ),
            ]
        ]);


        return $result->fetchAll();
    }


    public function executeComponent()
    {
        $this->checkModules();

        $this-> arResult = $this->getDispatchersAndObjects();

        $this->includeComponentTemplate();
    }

}