<?php

require_once '/./../data_search/index.php';
require_once '/./../../config.php';

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

    public function menu($themes);
    /*
     * @function data_list_content(array $page_info);
     * функция вставляет новый контент в таблицу 
     */

    public function data_list_content($page_info);
    /*
     * @function questions(array $question);
     *  функция вставляет новый запрос в таблицу
     */

    public function questions($question);
    /*
     * @function youtube_play_list(array $play_lists);
     * функция вставляет новый плейлист youtube в таблицу
     */

    public function sources($items_list);
    
}

interface ITableUpdate {
    /*
     * @function menu(array $themes);
     * функция обновляет выбранные по id записи в таблице menu
     */

    public function menu($themes);
    /*
     * @function data_list_content(array $page_info);
     *  функция обновляет выбранные по id записи в таблице c контентом
     */

    public function data_list_content($page_info);
    /*
     * @function questions(array $question);
     *  функция обновляет выбранные по id записи в таблице c запросами
     */

    public function questions($question);
    /*
     * @function youtube_play_list(array $play_lists);
     * функция обновляет выбранные по id записи в таблице c плейлистами youtube
     */

   public function sources($items_list);
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

    public function menu($id_themes);
    /*
     * @function data_list_content(array $id_page_info);
     * удаляет строку c контентом по id
     */

    public function data_list_content($id_page_info);
    /*
     * @function questions(array $id_question);
     * удаляет строку c запросом по id
     */

    public function questions($id_question);
    /*
     * @function youtube_play_list(array $id_play_lists);
     * удаляет строку с плайлистом youtube по id
     */

    public function youtube_play_list($id_play_lists);
    /*
     * @function youtube_video(array $id_video);
     * удаляет строку с видео youtube по id
     */

    public function youtube_video($id_video);
    /*
     * @function youtube_chanel(array $id_chanels);
     * удаляет строку с каналом youtube по id
     */

    public function youtube_chanel($id_chanels);
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

    public function data_list_content($id_item,$num, $limit,$type);
}

interface IYoutubeDataGetAdmin extends IYoutubeDataGetUser {

    public function lists_of_content($id_item);

    public function data_content_sources($id_content,$num, $limit, $type); 
    
    public function data_sources($id_sources,$num, $limit); 
}

interface IYoutubeDataSet {

    public function save_content();

    public function set_strat_search(ISearch $strat);

    public function set_strat_save(IStrategySave $strat);

    public function set_strat_questions(IQuestions $strat);

    public function get_list_from_youtube($questions, $count);

    public function view_current_list();

    public function get_and_save_content($questions, $count);

    public function release_questions($param);
}

interface IQuestions {

    public function questions();
}
