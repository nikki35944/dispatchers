<?php

Bitrix\Main\Loader::registerAutoloadClasses(
    "webkit",
    [
        "\Webkit\Table\DispatchersTable" => "lib/tables/dispatchers.php",
        "\Webkit\Table\ObjectsTable" => "lib/tables/objects.php",
    ]
);

?>