INSERT INTO `menu`( `id_item`, `title`, `description`, `id_parent`) VALUES (1,'Владимир Соловьев','Описание Владимир Соловьев',NULL);
INSERT INTO `content`(`id_content`, `tittle`, `description`, `id_item`) VALUES (1,'Вечер с Владимиром Соловьевым',' Описание вечер с Владимиром Соловьевым',1);
INSERT INTO `questions`(`id_question`, `type_quest`, `question`, `title`, `description`, `id_content`) VALUES (1,'youtube#keyword#channel','Владимир Соловьев','Владимир Соловьев','Вечер с Владимиром Соловьевым',1);
