<?php

require_once 'WAbstractSearch.php';
require_once 'WFactoryList.php';

class WSearchBase extends WAbstractSearch implements ISearch {

    private $factory_list;

    public function __construct() {
        $this->factory_list = new WFactoryList;
    }

    private function channel_id($retres, WContent $content) {
        $compositeHead = $this->factory_list->create_composit($content);
        $compositeHead->type = "simpledu#channel";
        foreach ($retres as $value) {
            $composite = $this->factory_list->create_composit();
            $composite->type = 'youtube#channel';
            $composite->id = $value['snippet']['channelId'];
            $compositeHead->add($composite);
        }
        return $compositeHead;
    }

    protected function get_statistic_video(WContent &$content) {
        $result = $this->search_video_statistics($content->id);
        //var_dump($result);
        $content->title = $result['snippet']['title'];
        $content->description = $result['snippet']['description'];
        $content->statistics = $result['statistics'];
    }

    protected function get_statistic_videolist(WContent &$content) {
        $result = $this->search_playlist_statistics($content->id);
        $content->title = $result['snippet']['title'];
        $content->description = $result['snippet']['description'];
    }

    protected function get_statistic_channel(WContent &$content) {
        $result = $this->search_channel_statistics($content->id);
        $content->title = $result['snippet']['title'];
        $content->description = $result['snippet']['description'];
        $content->statistics = $result['statistics'];
    }

    private function add_to_array_content(&$result, $type) {
        $compositeHead = $this->factory_list->create_composit();
        $arr_type = explode("#", $type);
        $compositeHead->type = "simpledu#" . $arr_type[1];
        foreach ($result as $key => $value) {
            switch ($type) {
                case "youtube#video": {
                        $leaf = $this->factory_list->create_leaf();
                        $leaf->type = $value['id']['kind'];
                        $leaf->id = $value['id']['videoId'];
                        $leaf->title = $value['snippet']['title'];
                        $compositeHead->add($leaf);
                        break;
                    }
                case "youtube#playlist": {
                        $composite = $this->factory_list->create_composit();
                        $composite->id = $value['id']['playlistId'];
                        $composite->type = $value['id']['kind'];
                        $composite->title = $value['snippet']['title'];
                        $compositeHead->add($composite);
                        break;
                    }
                case "youtube#channel": {
                        if ($key > 0) {
                            return $compositeHead;
                        }
                        $composite = $this->factory_list->create_composit();
                        $composite->id = $value['id']['channelId'];
                        $composite->type = $value['id']['kind'];
                        $composite->title = $value['snippet']['title'];
                        $compositeHead->add($composite);
                    }
            }
        }
        return $compositeHead;
    }

    public function set_factory_list(IFactoryList $factory) {
        if (empty($factory)) {
            return null;
        }
        $this->factory_list = $factory;
        return true;
    }

    public function search_by_idchannel_playlists(WContent $channel) {
        $compositeHead = $this->factory_list->create_composit($channel);

        $retres = $this->search_lists_by_idChannel($channel->id);
        if ($retres === null) {
            return null;
        }
        foreach ($retres as $value) {
            $composite = $this->factory_list->create_composit();
            $composite->type = 'youtube#playlist';
            $composite->description = $value['snippet']['description'];
            $composite->title = $value['snippet']['title'];
            $composite->id = $value['id'];
            $compositeHead->add($composite);
        }
        return $compositeHead;
    }

    public function search_by_idplaylist_videos(WContent $playlist) {
        $compositeHead = $this->factory_list->create_composit($playlist);
        $retres = $this->search_video_by_idPlayList($playlist->id);
        if ($retres === null) {
            return null;
        }
        foreach ($retres as $value) {
            $leaf = $this->factory_list->create_leaf();
            $leaf->type = 'youtube#video';
            $leaf->title = $value['snippet']['title'];
            $leaf->id = $value['contentDetails']['videoId'];
            $compositeHead->add($leaf);
        }
        return $compositeHead;
    }

    public function search_by_idplaylist_channel(WContent $playlist) {
        $retres = $this->search_channel_by_idPlaylist($playlist->id);
        return $this->channel_id($retres, $playlist);
    }

    public function search_by_idvideo_channel(WContent $video) {
        $retres = $this->search_video_statistics($video->id);
        return $this->channel_id($retres, $video);
    }

    public function search_by_idvideo_playlist(WContent $video) {
        $compositeHead = $this->factory_list->create_composit();
        $compositeHead->type = "simpledu#playlist";
        $retres = $this->search_playList_by_idVideo($video->id);
        foreach ($retres as $value) {
            $composite = $this->factory_list->create_composit();
            $composite->type = 'youtube#playlist';
            $composite->id = $value['playlistId'];
            $compositeHead->add($composite);
        }
        return $compositeHead;
    }

    public function get_statistics(WContent &$content) {
        switch ($content->type) {
            case "youtube#video": {
                    return $this->get_statistic_video($content);
                }
            case "youtube#playlist": {
                    return $this->get_statistic_videolist($content);
                }
            case "youtube#channel": {
                    return $this->get_statistic_channel($content);
                }
        }
    }

    public function search_by_keyword($keyword, $type_content) {
        $result = array();
        switch ($type_content) {
            case "youtube#video": {
                    $result = $this->search_video($keyword);
                    break;
                }
            case "youtube#playlist": {
                    $result = $this->search_playlist($keyword);
                    break;
                }
            case "youtube#channel": {
                    $result = $this->search_chanel($keyword);
                    break;
                }
        }
        return $this->add_to_array_content($result, $type_content);
    }

}
