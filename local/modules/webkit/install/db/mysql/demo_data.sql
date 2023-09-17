INSERT INTO `objects` (`ID`, `ACTIVITY_START`, `TITLE`, `ADDRESS`, `COMMENTARY`)
VALUES (NULL, '2023-09-15 12:35:28', 'Объект 1', 'ул. Пражская, д. 35', 'Жилой дом'),
       (NULL, '2023-09-16 10:49:21', 'Объект 2', 'ул. Пражская, д. 46', 'Районный Исполнительный комитет'),
       (NULL, '2023-09-17 14:33:28', 'Объект 3', 'ул. Бухарестская, д. 47', 'Торговый центр');

INSERT INTO `dispatchers` (`ID`, `ACTIVITY_START`, `IS_ACTIVE`, `ACTIVITY_END`, `COMMENTARY`, `ACCESS_LEVEL`, `B_USER_ID`, `OBJECT_ID`)
VALUES (NULL, '2023-09-15 14:52:22', 'Y', NULL, 'Тестовый комментарий', '1', '1', '2');