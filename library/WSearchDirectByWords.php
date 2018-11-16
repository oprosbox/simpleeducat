<?php
require_once 'WSearch_base.php';

class WSearchDirectByWords extends WSearch implements IStratSearch {

    protected function get_struct_video($searchResult) {
        $content = new WContent;
        $content->type = 'youtube#video';
        $content->tittle = $searchResult['snippet']['title'];
        $content->description = $searchResult['snippet']['description'];
        $content->id_content = $searchResult['id']['videoId'];
        $content->statistic = $this->search_video_statistics($content->id_content);
        return $content;
    }

    protected function get_struct_chanels($searchResult) {
        $content_list = array();
        $content = new WContent;
        $content->type = 'youtube#channel';
        $content->tittle = $searchResult['snippet']['title'];
        $content->description = $searchResult['snippet']['description'];
        $content->id_content = $searchResult['id']['channelId'];
        array_push($content_list, $content);
        array_push($content_list, $this->search_video_from_idChanel($content->id_content));
        return $content_list;
    }

    protected function get_struct_playList($searchResult) {
        $content = new WContent;
        $content->type = 'youtube#playlist';
        $content->tittle = $searchResult['snippet']['title'];
        $content->description = $searchResult['snippet']['description'];
        $content->id_content = $searchResult['id']['playlistId'];
        array_push($content_list, $content);
        array_push($content_list, $this->search_video_by_idPlayList($content->id_content));
    }

    public function search_content($key_word) {
        if (!empty($this->youtube)) {
            $search_response = $this->search($key_word);
            $content_list = array();
            foreach ($search_response['items'] as $searchResult) {
                switch ($searchResult['id']['kind']) {
                    case 'youtube#video':
                        array_push($content_list, $this->get_struct_video($searchResult));
                        break;
                    case 'youtube#channel':
                        array_push($content_list, $this->get_struct_chanels($searchResult));
                        break;
                    case 'youtube#playlist':
                        array_push($content_list, $this->get_struct_playList($searchResult));
                        break;
                }
            }
        }
    }

}
