<?php

namespace Webkit\Table;

use Bitrix\Main\Entity;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Query\Join;
use Bitrix\Main\Type;

class DispatchersTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'dispatchers';
    }

    public static function getUfId()
    {
        return 'DISPATCHERS';
    }

    public static function getMap()
    {
        return [
            new Entity\IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
            ]),
            new Entity\DatetimeField('ACTIVITY_START', [
                'default_value' => new Type\Date,
            ]),
            new Entity\BooleanField('IS_ACTIVE'),
            new Entity\DatetimeField('ACTIVITY_END', [
                'nullable' => true,
            ]),
            new Entity\TextField('COMMENTARY'),
            new Entity\IntegerField('ACCESS_LEVEL', [
                'validation' => function() {
                    return [
                        function ($value) {
                            if ($value >= 1 && $value <= 12)
                            {
                                return true;
                            }
                            else
                            {
                                return 'Должно быть число от 1 до 12';
                            }
                        }
                    ];
                }
            ]),
            new Entity\IntegerField('B_USER_ID'),
            new IntegerField('OBJECT_ID'),
        ];

    }
}