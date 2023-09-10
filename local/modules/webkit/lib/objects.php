<?php

namespace Webkit;

use Bitrix\Main\Entity;
use Bitrix\Main\Type;

class ObjectsTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'objects';
    }

    public static function getUfId()
    {
        return 'OBJECTS';
    }

    public static function getMap()
    {
        return [
            new Entity\IntegerField('ID',[
                'primary' => true,
                'autocomplete' => true,
            ]),
            new Entity\DatetimeField('ACTIVITY_START', [
                'default_value' => new Type\Date,
            ]),
            new Entity\TextField('TITLE'),
            new Entity\TextField('ADDRESS'),
            new Entity\TextField('COMMENTARY'),

            new Entity\IntegerField('DISPATCHER_ID'),
            new Entity\ReferenceField(
                'DISPATCHER',
                '\Webkit\DispatchersTable',
                ['=this.DISPATCHER_ID', 'ref.ID']
            ),
        ];
    }
}