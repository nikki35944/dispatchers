<?php

namespace Webkit\Helper;

use Bitrix\Main;
use Webkit\Table\DispatchersTable;
use Bitrix\Main\Data\Cache;

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
        $cacheTtl = 36000;
        $cacheId = 'dispatchers_cache';
        $obCache = Cache::createInstance();


        $query = DispatchersTable::getList([
            'select' => ['ACCESS_LEVEL', 'COMMENTARY', 'OBJECT.ID', 'OBJECT.TITLE', 'USER.NAME', 'USER.LAST_NAME', 'USER.LAST_LOGIN'],
            'filter' => [],
        ]);

        if ($obCache->initCache($cacheTtl, $cacheId))
        {
            $vars = $obCache->getVars();
            $result = $vars['result'];
        }
        elseif ($obCache->startDataCache())
        {
            $resultArr = $query->fetchAll();

            foreach ($resultArr as $item) {
                if (! empty($item['WEBKIT_TABLE_DISPATCHERS_USER_LAST_LOGIN']))
                {
                    $objTime = $item['WEBKIT_TABLE_DISPATCHERS_USER_LAST_LOGIN'];
                    $item['WEBKIT_TABLE_DISPATCHERS_USER_LAST_LOGIN'] = $objTime->format('d-m-Y H:i');
                }
                $result[] = $item;
            }

            $obCache->endDataCache(['result' => $result]);
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