<?php

namespace Dispatchers;

use Bitrix\Main\ORM\Fields;
use Bitrix\Main\ORM\Fields\Relations;
use Bitrix\Main\ORM\Query\Join;
use Bitrix\Main\Type;

class DispatchersTable extends \Bitrix\Main\ORM\Data\DataManager
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
        return array([
            new Fields\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true,
            )),
            new Fields\DatetimeField('ACTIVITY_START', array(
                'default_value' => new Type\Date,
            )),
            new Fields\BooleanField('IS_ACTIVE'),
            new Fields\DatetimeField('ACTIVITY_END'),
            new Fields\TextField('COMMENTARY'),
            new Fields\IntegerField('ACCESS_LEVEL', array(
                'validation' => function() {
                    return array(
                        function ($value) {
                            if ($value <= 12 && $value >= 1)
                            {
                                return true;
                            }
                            else
                            {
                                return 'Должно быть число от 1 до 12';
                            }
                        }
                    );
                }
            )),
            new Fields\IntegerField('USER_ID'),

        ]);
    }
}