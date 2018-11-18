<?php

require_once 'WAbstractSearch.php';
require_once '/./../search.php';

class WSearchBase extends WAbstractSearch implements ISearch {

    private function channel_id($retres, WContent $content) {
        $compositeHead = new WCompositeContent;
        $compositeHead->type="simpledu#channel";
        $composite = new WCompositeContent;
        $leaf = new WLeafContent($playlist);
        $composite->add($leaf);
        $composite->type = 'youtube#channel';
        foreach ($retres as $value) {
            $composite->id = $value['snippet']['channelId'];
            $compositeHead->add($composite);
        }
        return $compositeHead;
    }

    protected function get_statistic_video(WContent &$content) {
        $result = $this->search_video_statistics($content->id);
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

    private function add_to_array_content(&$result,$type) {
        $compositeHead = new WCompositeContent;
        $leaf = new WLeafContent;
        $composite = new WCompositeContent;
        $compositeHead->type="simpledu#$type";
        foreach ($result as $value) 
            {
            switch($type){
                case "youtube#video":{$leaf->type = $value['id']['kind'];
                $leaf->id = $value['id']['videoId'];
                $leaf->title = $value['snippet']['title'];
                $compositeHead->add($leaf);break;}
                case "youtube#playlist":{$composite->id = $value['id']['playlistId'];
                $composite->type = $value['id']['kind'];
                $composite->title = $value['snippet']['title'];
                $compositeHead->add($composite);break;}
                case "youtube#channel":{$composite->id = $value['id']['channelId'];
                $composite->type = $value['id']['kind'];
                $composite->title = $value['snippet']['title'];
                $compositeHead->add($composite);;}
            }
        }
        return $result_list;
    }

    public function search_by_idchannel_playlists(WContent $channel) {
        $compositeHead = new WCompositeContent($channel);
        $composite = new WCompositeContent;
        $composite->type = 'youtube#playlist';
        $retres = $this->search_lists_by_idChanel($channel->id);
        foreach ($retres as $value) {
            $composite->description = $value['snippet']['description'];
            $composite->title = $value['snippet']['title'];
            $composite->id = $value['id'];
            $compositeHead->add($composite);
        }
        return $compositeHead;
    }

    public function search_by_idplaylist_videos(WContent $playlist) {
        $compositeHead = new WCompositeContent($playlist);
        $leaf = new WLeafContent();
        $leaf->type = 'youtube#video';
        $retres = $this->search_video_by_idPlayList($playlist->id);
        foreach ($retres as $value) {
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
        $compositeHead = new WCompositeContent;
        $compositeHead->type = "simpledu#playlist";
        $composite = new WCompositeContent;
        $leaf = new WLeafContent($video);
        $composite->add($leaf);
        $composite->type = 'youtube#playlist';
        $retres = $this->search_playList_by_idVideo($video->id);
        foreach ($retres as $value) {
            $composite->id = $value['playlistId'];
            $compositeHead->add($composite);
        }
        return $compositeHead;
    }

    public function get_statistics(WContent &$content) {
        switch ($content->type) {
            case "youtube#video": {
                    return get_statistic_video($content);
                }
            case "youtube#playlist": {
                    return get_statistic_videolist($content);
                }
            case "youtube#channel": {
                    return get_statistic_channel($content);
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
        return $this->add_to_array_content($result);
    }

}

class WCompositeRequest extends WCompositeContent implements IRequest {

    public function update_statistics(ISearch &$search_obj) {
        $search_obj->get_statistics($this);
        foreach ($this->content as $key => $value) {
            $value->update_statistics($search_obj);
        }
    }

    public function build_tree(ISearch &$search_obj) {
        $search_obj->get_statistics($this);
        foreach ($this->content as $key => $value) {
            switch ($value->type) {
                case 'youtube#channel': {
                        $tree_youtube = $search_obj->search_by_idchannel_playlists($value);
                        break;
                    }
                case 'youtube#playlist': {
                        $tree_youtube = $search_obj->search_by_idplaylist_videos($value);
                    }
            }
            $this->content[$key] = $tree_youtube;
            $this->content[$key]->build_tree($search_obj);
        }
    }
    
    public function test_view(){
        
        foreach ($this->content as $key => $value) {
          $value->test_view();  
        }
    }
}

class WLeafRequest extends WLeafContent implements IRequest {

    public function update_statistics(ISearch &$search_obj) {
        $search_obj->update_statistics($this);
    }

    public function build_tree(ISearch &$search_obj) {
        $search_obj->update_statistics($this);
    }

    public function test_view(){
        
    }
}
