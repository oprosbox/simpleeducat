<?php

require_once '/./../data_search/index.php';
require_once '/./../../config.php';


/**
 * ITableCreate interface
 */
interface ITableCreate {
    /**
     * tables
     */
    public function tables();
}

    /**
    * ITableInsert Interface
    */
interface ITableInsert {

    /**
     * menu
     * 
     * @param type $themes
     */
    public function menu($themes);

    /**
     * data_list_content
     * 
     * @param type $page_info
     */
    public function data_list_content($page_info);

    /**
     * questions
     * 
     * @param type $question
     */
    public function questions($question);

    /**
     * sources
     * 
     * @param type $items_list
     */
    public function sources($items_list);
}

interface ITableUpdate {

    /**
     * menu
     * 
     * @param type $themes
     */
    public function menu($themes);

    /**
     * data_list_content
     * 
     * @param type $page_info
     */
    public function data_list_content($page_info);

    /**
     * questions
     * 
     * @param type $question
     */
    public function questions($question);

    /**
     * sources
     * 
     * @param array $items_list
     */
    public function sources($items_list);
}

interface ITableDelete {
    /**
     * tables
     */
    public function tables();

    /**
     * menu
     * 
     * @param type $id_themes
     */
    public function menu($id_themes);

    /**
     * data_list_content
     * 
     * @param type $id_page_info
     */
    public function data_list_content($id_page_info);

    /**
     * questions
     * 
     * @param type $id_question
     */
    public function questions($id_question);

    /**
     * youtube_play_list
     * 
     * @param type $id_play_lists
     */
    public function youtube_play_list($id_play_lists);

    /**
     * youtube_video
     * 
     * @param type $id_video
     */
    public function youtube_video($id_video);

    /**
     * youtube_chanel
     * 
     * @param type $id_chanels
     */
    public function youtube_chanel($id_chanels);
}

    /**
     * IYoutubeDataGetUser Interface
     */
interface IYoutubeDataGetUser {

    /**
     * menu
     */
    public function menu();

    /**
     * data_list_content
     * 
     * @param type $id_item
     * @param int $num
     * @param type $limit
     * @param type $type
     */
    public function data_list_content($id_item, $num, $limit, $type);

    /**
     * sources_by_parent
     * 
     * @param type $id_parent
     * @param type $num
     * @param type $limit
     * @param type $type
     */
    public function sources_by_parent($id_parent, $num, $limit, $type);
}

interface IYoutubeDataGetAdmin extends IYoutubeDataGetUser {

    /**
     * lists_of_content
     * 
     * @param type $id_item
     */
    public function lists_of_content($id_item);

    /**
     * data_content_sources
     * 
     * @param type $id_content
     * @param type $num
     * @param type $limit
     * @param type $type
     */
    public function data_content_sources($id_content, $num, $limit, $type);

    /**
     * data_sources
     * 
     * @param type $id_sources
     * @param type $num
     * @param type $limit
     */
    public function data_sources($id_sources, $num, $limit);
}

/**
 * IYoutubeDataSet Interface
 */
interface IYoutubeDataSet {

    /**
     * save_content
     */
    public function save_content();

    /**
     * set_strat_search
     * 
     * @param ISearch $strat
     */
    public function set_strat_search(ISearch $strat);

    /**
     * set_strat_save
     * 
     * @param IStrategySave $strat
     */
    public function set_strat_save(IStrategySave $strat);

    /**
     * set_strat_questions
     * 
     * @param IQuestions $strat
     */
    public function set_strat_questions(IQuestions $strat);

    /**
     * view_current_list
     */
    public function view_current_list();

    /**
     * get_and_save_content
     * 
     * @param type $questions
     * @param type $count
     */
    public function get_and_save_content($questions, $count);

    /**
     * release_questions
     * 
     * @param type $param
     */
    public function release_questions($param);
}

    /**
     * IQuestions Interface
     */
interface IQuestions {

    /**
     * questions
     * реализация обращения к источнику запроса 
     */
    public function questions();
}
