<?php

require_once 'WAbstractSearch.php';
require_once 'WFactoryList.php';


class WSearchBase extends WAbstractSearch implements ISearch {

    private $factory_list;
    public $array_search = array('youtube#channel' => array('search' => 'search_by_idchannel_playlists',
                                                            'statistic' => 'get_statistics_channel',
                                                            'maxResult'=>5),
        'youtube#playlist' => array('search' => 'search_by_idplaylist_videos',
                                    'statistic' => 'get_statistics_playlist',
                                    'maxResult'=>5),
        'youtube#video' => array('search' => null,
                                 'statistic' => 'get_statistics_video',
                                 'maxResult'=>5),
        'youtube#keyword#video' => array('search' => 'search_by_keyword_video',
                                         'statistic' => 'search_by_keyword_video',
                                        'maxResult'=>5),
        'youtube#keyword#playlist' => array('search' => 'search_by_keyword_playlist',
                                            'statistic' => 'search_by_keyword_playlist',
                                            'maxResult'=>5),
        'youtube#keyword#channel' => array('search' => 'search_by_keyword_channel',
                                           'statistic' => 'search_by_keyword_channel',
                                            'maxResult'=>5),
        'youtube#keyword#video#channel' => array('search' => 'search_content_video_channel',
                                                 'statistic' => null,
                                                'maxResult'=>5),
        'youtube#keyword#playlist#channel' => array('search' => 'search_content_playlist_channel',
                                                    'statistic' => null,
                                                    'maxResult'=>5),
        'youtube#video#playlist' => array('search' => 'search_by_idvideo_playlist',
                                          'statistic' => null,
                                            'maxResult'=>5),
        'youtube#video#channel' => array('search' => 'search_by_idvideo_channel',
                                         'statistic' => null,
                                         'maxResult'=>5),
        'youtube#playlist#channel' => array('search' => 'search_by_idplaylist_channel',
                                            'statistic' => null,
                                            'maxResult'=>5)
    );

    
    public function __construct() {
        $this->factory_list = new WFactoryList;
    }
    
    public function search(WContent $content) {
        $funct = $this->array_search[$content->type]['search'];
        if (!empty($funct)) {
            return $this->$funct($content, $this->array_search[$content->type]['maxResult']);
        } else
            return null;
    }

    public function get_statistics($content) {
        if (empty($content)){return null;} 
        $funct = $this->array_search[$content[0]->type]['statistic'];
        if (!empty($funct)) {
            $this->$funct($content);
            return true;
        } else
            return false;
    }

    public function set_max_result($type,$max_result){
     $this->array_search[$type]['maxResult']=$max_result;
     return $this;
    } 
            
    public function set_factory_list(IFactoryList $factory) {
        if (empty($factory)) {
            return null;
        }
        $this->factory_list = $factory;
        return true;
    }

    private function channel_id($retres, WContent $content) {
        $compositeHead=null;
        foreach ($retres as $value) {
            $composite = $this->factory_list->create_composit();
            $composite->set_id_parent($content->id);
            $composite->type = 'youtube#channel';
            $composite->id = $value['snippet']['channelId'];
            $compositeHead[]=$composite;
        }
        return $compositeHead;
    }

    private function get_statistic_base(&$content,$funct,$type='all') {
        $id = null;
        foreach ($content as $value) {
            $id[] = $value->id;
        }
        $result = $this->$funct($id);
        if (empty($result)) {
            return null;
        }
        foreach ($result as $value) {
            $id_val = $value['id'];               
            $content_val = array_filter($content, function ($element,$key) use ($id_val) {
                return ($element->id === $id_val);
            },ARRAY_FILTER_USE_BOTH);
            if ($content_val !== null) {
                $content_val= array_shift($content_val);
                $content_val->set_title($value['snippet']['title']);
                $content_val->set_description($value['snippet']['description']);
                if($type!=='playlist'){ $content_val->set_statistics($value['statistics']);}
                $add_arr['default']=$value['snippet']['thumbnails']['default'];
                $add_arr['standard']=$value['snippet']['thumbnails']['standard'];
                $add_arr['maxres']=$value['snippet']['thumbnails']['maxres'];
                $content_val->set_thumbnails($add_arr);
            }
        }
    }

    private function add_to_array_content(&$result, WContent $content) {
        $compositeHead=null;
        foreach ($result as $value) {
            switch ($content->type) {
                case "youtube#keyword#video": {
                        $leaf = $this->factory_list->create_leaf();
                        $leaf->set_id_parent(NULL);
                        $leaf->type = $value['id']['kind'];
                        $leaf->id = $value['id']['videoId'];
                        $leaf->title = $value['snippet']['title'];
                        $compositeHead[]=$leaf;
                        break;
                    }
                case "youtube#keyword#playlist": {
                        $composite = $this->factory_list->create_composit();
                        $composite->set_id_parent(NULL);
                        $composite->id = $value['id']['playlistId'];
                        $composite->type = $value['id']['kind'];
                        $composite->title = $value['snippet']['title'];
                        $compositeHead[]=$composite;
                        break;
                    }
                case "youtube#keyword#channel": {
                        $composite = $this->factory_list->create_composit();
                        $composite->set_id_parent(NULL);
                        $composite->id = $value['id']['channelId'];
                        $composite->type = $value['id']['kind'];
                        $composite->title = $value['snippet']['title'];
                        $compositeHead[]=$composite;
                    }
            }
        }
        return $compositeHead;
    }

    private function search_by_idchannel_playlists(WContent $channel, $count) {
        $compositeHead=null;
        $retres = $this->search_lists_by_idChannel($channel->id);
        if ($retres === null) {
            return null;
        }
        foreach ($retres as $value) {
            $composite = $this->factory_list->create_composit();
            $composite->set_id_parent($channel->id);
            $composite->type = 'youtube#playlist';
            $composite->description = $value['snippet']['description'];
            $composite->title = $value['snippet']['title'];
            $composite->id = $value['id'];
            $compositeHead[]=$composite;
        }
        return $compositeHead;
    }

    private function search_by_idplaylist_videos(WContent $playlist, $count) {
        $compositeHead=null;
        $retres = $this->search_video_by_idPlayList($playlist->id);
        if ($retres === null) {
            return null;
        }
        foreach ($retres as $value) {
            $leaf = $this->factory_list->create_leaf();
            $leaf->set_id_parent($playlist->id);
            $leaf->type = 'youtube#video';
            $leaf->title = $value['snippet']['title'];
            $leaf->id = $value['contentDetails']['videoId'];
            $compositeHead[]=$leaf;
        }
        return $compositeHead;
    }

    private function search_by_idplaylist_channel(WContent $playlist, $count) {
        $retres = $this->search_channel_by_idPlaylist($playlist->id);
        return $this->channel_id($retres, $playlist);
    }

    private function search_by_idvideo_channel(WContent $video) {
        $retres = $this->search_video_statistics($video->id);
        return $this->channel_id($retres, $video);
    }

    private function search_by_idvideo_playlist(WContent $video, $count) {
        $compositeHead=null;
        $retres = $this->search_playList_by_idVideo($video->id);
        foreach ($retres as $value) {
            $composite = $this->factory_list->create_composit();
            $composite->set_id_parent($video->id);
            $composite->type = 'youtube#playlist';
            $composite->id = $value['playlistId'];
            $compositeHead[]=$composite;
        }
        return $compositeHead;
    }

    private function get_statistics_video(&$content) {
        return $this->get_statistic_base($content,'search_video_statistics');
    }

    private function get_statistics_playlist(&$content) {
        return $this->get_statistic_base($content,'search_playlist_statistics','playlist');
    }

    private function get_statistics_channel(&$content) {
        return $this->get_statistic_base($content,'search_channel_statistics');
    }

    private function search_by_keyword_video(WContent $content, $count = 5) {

        $result = $this->search_video($content->description, $count);
        return $this->add_to_array_content($result, $content);
    }

    private function search_by_keyword_playlist(WContent $content, $count = 5) {
        $result = $this->search_playlist($content->description, $count);
        return $this->add_to_array_content($result, $content);
    }

    private function search_by_keyword_channel(WContent $content, $count = 5) {
        $result = $this->search_channel($content->description, $count);
        return $this->add_to_array_content($result, $content);
    }

    private function add_playlist_find($result, $content) {
        $compositeHead=null;
        foreach ($result as $value) {
            $composite = $this->factory_list->create_composit();
            $composite->set_id_parent($content->id);
            $composite->id = $value['id']['playlistId'];
            $composite->type = 'youtube#playlist#channel';
            $composite->title = $value['snippet']['title'];
            $compositeHead[]=$composite;
        }
        return $compositeHead;
    }

    private function add_video_find($result, $content) {
        $compositeHead=null;
        foreach ($result as $value) {
            $composite = $this->factory_list->create_leaf();
            $composite->set_id_parent($content->id);
            $composite->type = 'youtube#video#channel';
            $composite->id = $value['id']['videoId'];
            $composite->title = $value['snippet']['title'];
            $compositeHead[]=$composite;
        }
        return $compositeHead;
    }

    private function search_content_video_channel($param, $count) {
        $result = $this->search_video($content->description, $count);
        return $this->add_video_find($result, $content);
    }

    private function search_content_playlist_channel($param, $count) {
        $result = $this->search_playlist($content->description, $count);
        return  $this->add_playlist_find($result, $content);
    }

}
