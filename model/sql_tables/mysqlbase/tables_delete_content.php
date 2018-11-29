<?php

require_once '/./single_connect.php';
require_once '/./../interfaces.php';

class WTableDelete extends WSingletonConnect implements ITableDelete {

    private function delete_id($id, $table, $name_column_id) {
        $str = '(' . implode(',', $id) . ')';
        $question = "DELETE FROM $table WHERE $name_column_id IN $str";
        return mysqli_query(self::$link, $question);
    }

    public function data_list_content($id_page_info) {
        return $this->delete_id($id_page_info, 'content', 'id_content');
    }

    public function menu($id_themes) {
        return $this->delete_id($id_themes, 'menu', 'id_item');
    }

    public function questions($id_question) {
        return $this->delete_id($id_question, 'questions', 'id_questions');
    }

    public function tables() {
        $question = "DROP TABLE 'menu','cohtent','questions','channels,playlists','videos'";
        return mysqli_query(self::$link, $question);
    }

    public function youtube_chanel($id_channels) {
        return $this->delete_id($id_channels, 'channels', 'id_channel');
    }

    public function youtube_play_list($id_playlists) {
        return $this->delete_id($id_playlists, 'playlists', 'id_playlist');
    }

    public function youtube_video($id_video) {
        return $this->delete_id($id_video, 'videos', 'id_video');
    }

}
