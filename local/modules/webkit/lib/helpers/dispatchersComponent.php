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
        $result = [];

        $query = \Webkit\Table\DispatchersTable::getList([
            'select' => ['ACCESS_LEVEL', 'COMMENTARY', 'OBJECT.ID', 'OBJECT.TITLE', 'USER.NAME', 'USER.LAST_NAME', 'USER.LAST_LOGIN'],
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

        $resultArr = $query->fetchAll();

        foreach ($resultArr as $item) {
            if (! empty($item['WEBKIT_TABLE_DISPATCHERS_USER_LAST_LOGIN'])) {
                $objTime = $item['WEBKIT_TABLE_DISPATCHERS_USER_LAST_LOGIN'];
                $item['WEBKIT_TABLE_DISPATCHERS_USER_LAST_LOGIN'] = $objTime->format('d-m-Y H:i');
            }
            $result[] = $item;
        }

        return $result;
    }


    public function executeComponent()
    {
        $this->checkModules();

        $this-> arResult = $this->getDispatchersAndObjects();

        $this->includeComponentTemplate();
    }

}