<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main;
use Webkit\Table\DispatchersTable;
use Webkit\Table\ObjectsTable;
use Bitrix\Main\Data\Cache;


if (!Main\Loader::includeModule('webkit'))
    throw new Main\LoaderException('WEBKIT_MODULE_NOT_INSTALLED');


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


function getObjectsAndDispatchers()
{
    $result = [];
    $cacheTtl = 36000;
    $cacheId = 'objects_cache';
    $obCache = Cache::createInstance();

    $query = ObjectsTable::getList([
        'select' => ['ID', 'TITLE', 'ADDRESS', 'COMMENTARY', 'DISPATCHER.ID', 'DISPATCHER.ACTIVITY_START', 'DISPATCHER.COMMENTARY', 'DISPATCHER.B_USER_ID', 'DISPATCHER.ACCESS_LEVEL', 'USER.NAME'],
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
            if (! empty($item['WEBKIT_TABLE_OBJECTS_DISPATCHER_ACTIVITY_START'])) {
                $objTime = $item['WEBKIT_TABLE_OBJECTS_DISPATCHER_ACTIVITY_START'];
                $item['WEBKIT_TABLE_OBJECTS_DISPATCHER_ACTIVITY_START'] = $objTime->format('d-m-Y H:i');
            }
            $result[] = $item;
        }

        $obCache->endDataCache(['result' => $result]);
    }

    return $result;
}

$arResult['DISPATCHERS_AND_OBJECTS'] = getDispatchersAndObjects();
$arResult['OBJECTS_AND_DISPATCHERS'] = getObjectsAndDispatchers();

$this->IncludeComponentTemplate();
