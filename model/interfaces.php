<?php

interface ITableCreate {
    /*
     * @function tables();
     * функция создает таблицы в базе данных
     */

    public function tables();
}

interface ITableInsert {
    /*
     * @function menu(array $themes);
     * функция вставляет новое item menu
     * 
     */

    public function menu(array $themes);
    /*
     * @function data_list_content(array $page_info);
     * функция вставляет новый контент в таблицу 
     */

    public function data_list_content(array $page_info);
    /*
     * @function questions(array $question);
     *  функция вставляет новый запрос в таблицу
     */

    public function questions(array $question);
    /*
     * @function youtube_play_list(array $play_lists);
     * функция вставляет новый плейлист youtube в таблицу
     */

    public function youtube_play_list(array $play_lists);
    /*
     * @function youtube_video(array $video);
     * функция вставляет новое видео youtube в таблицу
     */

    public function youtube_video(array $video);
    /*
     * @function youtube_chanel(array $chanels);
     * функция вставляет новый канал youtube в таблицу
     */

    public function youtube_chanel(array $chanels);
}

interface ITableUpdate {
    /*
     * @function menu(array $themes);
     * функция обновляет выбранные по id записи в таблице menu
     */

    public function menu(array $themes);
    /*
     * @function data_list_content(array $page_info);
     *  функция обновляет выбранные по id записи в таблице c контентом
     */

    public function data_list_content(array $page_info);
    /*
     * @function questions(array $question);
     *  функция обновляет выбранные по id записи в таблице c запросами
     */

    public function questions(array $question);
    /*
     * @function youtube_play_list(array $play_lists);
     * функция обновляет выбранные по id записи в таблице c плейлистами youtube
     */

    public function youtube_play_list(array $play_lists);
    /*
     * @function youtube_video(array $video);
     * функция обновляет выбранные по id записи в таблице c видео youtube
     */

    public function youtube_video(array $video);
    /*
     * @function youtube_chanel(array $chanels);
     * функция обновляет выбранные по id записи в таблице c каналами youtube
     */

    public function youtube_chanel(array $chanels);
}

interface ITableDelete {
    /*
     * @function tables();
     * удаляет таблицы из БД
     */

    public function tables();
    /*
     * @function menu(array $id_themes);
     * удаляет строку item из menu по id
     */

    public function menu(array $id_themes);
    /*
     * @function data_list_content(array $id_page_info);
     * удаляет строку c контентом по id
     */

    public function data_list_content(array $id_page_info);
    /*
     * @function questions(array $id_question);
     * удаляет строку c запросом по id
     */

    public function questions(array $id_question);
    /*
     * @function youtube_play_list(array $id_play_lists);
     * удаляет строку с плайлистом youtube по id
     */

    public function youtube_play_list(array $id_play_lists);
    /*
     * @function youtube_video(array $id_video);
     * удаляет строку с видео youtube по id
     */

    public function youtube_video(array $id_video);
    /*
     * @function youtube_chanel(array $id_chanels);
     * удаляет строку с каналом youtube по id
     */

    public function youtube_chanel(array $id_chanels);
}

interface IYoutubeDataGetUser {
    /*
     * @function menu();
     * функция возвращает полный список item menu
     */

    public function menu();
    /*
     * @function data_list_content($id_item)
     * функция возвращает массив данных по id item menu
     */

    public function data_list_content($id_item);
}

interface IYoutubeDataGetAdmin extends IYoutubeDataGetUser {
    /*
     * @function menu_item(array $id_item);
     * функция возвращает список item menu
     * @param $id_item - массив id_item меню
     */

    public function menu_item(array $id_item);

    /*
     * @function data_lists_of_content(array $id_item);
     * функция возвращает список контента по id item menu
     * @param $id_item - массив id_item меню 
     */

    public function data_lists_of_content(array $id_item);

    /*
     * @function lists_of_content(array $id_list);
     * функция возвращает список контента по его id
     * @param $id_list - массив id контента
     */

    public function lists_of_content(array $id_list);

    /*
     * @function questions(array $id_question);
     * функция возвращает запросы к сайту из таблиц БД
     */

    public function questions(array $id_question);

    /*
     * @function youtube_play_list(array $id_play_lists);
     * функция возвращает из таблицы список плейлистов youtube
     */

    public function youtube_play_list(array $id_play_lists);

    /*
     * @function youtube_video(array $id_video);
     * функция возвращает из таблицы список видео youtube
     */

    public function youtube_video(array $id_video);

    /*
     * @function youtube_chanel(array $id_chanels);
     * функция возвращает из таблицы список каналов youtube
     */

    public function youtube_chanel(array $id_chanels);
}

interface IYoutubeDataSet {
    /*
     * @function get_questions();
     * функция извлекает запросы из таблицы
     */

    public function get_questions();

    /*
     * @function get_info_from_youtube(array $questions);
     * обращается к сайту youtube, получает с сайта информацию о каналах, роликах и листах
     * @param $questions - массив запросов на youtube
     */

    public function get_info_from_youtube(array $questions);

    /*
     * @function add_info_to_table(array $info);
     * пакует информацию в базу данных
     * @param $info - массив информации о каналах, плейлистах и видео youtube
     */

    public function add_info_to_table(array $info);

    /*
     * @release_questions()
     * функция извлекает запросы из таблицы,
     * обращается к сайту youtube, получает с сайта информацию о каналах, роликах и листах 
     * пакует информацию в базу данных
     */

    public function release_questions();
}
