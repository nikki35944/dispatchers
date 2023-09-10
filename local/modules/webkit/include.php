<?php

Bitrix\Main\Loader::registerAutoloadClasses(
    "webkit",
    [
        "Webkit\DispatchersTable" => "lib/dispatchers.php",
    ]
);
Bitrix\Main\Loader::registerAutoloadClasses(
    "webkit",
    [
        "Webkit\ObjectsTable" => "lib/objects.php",
    ]

);

?>