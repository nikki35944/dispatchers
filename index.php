<?php
use \Webkit\Helper\dispatchersComponent;
use Webkit\Helper\objectsComponent;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Демонстрационная версия продукта «1С-Битрикс: Управление сайтом»");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");

CModule::IncludeModule('webkit');
$dispatchers = new dispatchersComponent();
$objects = new objectsComponent();
$objectsArr = $objects->getObjectsAndDispatchers();
$dispatchersArr = $dispatchers->getDispatchersAndObjects();
?>
<!--bootstrap-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <section class="dispatchers mt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="border-bottom-0">Список активных диспетчеров</h2>
                    <table class="table table-hover mt-3">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Имя</th>
                            <th scope="col">Фамилия</th>
                            <th scope="col">Уровень доступа</th>
                            <th scope="col">Дата и время последнего входа в систему</th>
                            <th scope="col">Комментарий к диспетечеру</th>
                            <th scope="col">Назначен на объект</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; foreach ($dispatchersArr as $dispatcher):  ?>
                            <tr>
                                <th><?= $i; ?></th>
                                <td><?= $dispatcher['WEBKIT_TABLE_DISPATCHERS_USER_NAME'] ?></td>
                                <td><?= $dispatcher['WEBKIT_TABLE_DISPATCHERS_USER_LAST_NAME'] ?></td>
                                <td><?= $dispatcher['ACCESS_LEVEL'] ?></td>
                                <td><?= $dispatcher['WEBKIT_TABLE_DISPATCHERS_USER_LAST_LOGIN'] ?></td>
                                <td><?= $dispatcher['COMMENTARY'] ?></td>
                                <td><?= $dispatcher['WEBKIT_TABLE_DISPATCHERS_OBJECT_TITLE'] ?></td>
                            </tr>
                            <?php $i++; endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <section class="objects">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h2 class="border-bottom-0">Список активных объектов и кто на них работает</h2>
                    <table class="table table-hover mt-3">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Название</th>
                            <th scope="col">Адрес</th>
                            <th scope="col">Комментарий к объекту</th>
                            <th scope="col">Имя ответственного диспетчера</th>
                            <th scope="col">Дата назначения на объект</th>
                            <th scope="col">Уровень доступа</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; foreach ($objectsArr as $object):  ?>
                            <tr>
                                <th><?= $i; ?></th>
                                <td><?= $object['TITLE'] ?></td>
                                <td><?= $object['ADDRESS'] ?></td>
                                <td><?= $object['COMMENTARY'] ?></td>
                                <td><?= $object['WEBKIT_TABLE_OBJECTS_USER_NAME'] ?></td>
                                <td><?= $object['WEBKIT_TABLE_OBJECTS_DISPATCHER_ACTIVITY_START'] ?></td>
                                <td><?= $object['WEBKIT_TABLE_OBJECTS_DISPATCHER_ACCESS_LEVEL'] ?></td>
                            </tr>
                            <?php $i++; endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>