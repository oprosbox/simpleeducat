<?php

require_once '/./youtube/WSearchByChannel.php';
require_once '/./youtube/WSearchByVideoChanel.php';
require_once '/./youtube/WSearchByVideoGroup.php';
require_once '/./youtube/WSearchByVideolist.php';





interface IStratSearch {

    public function search_content($param);
}

class WContent {

    public $type;
    public $id;
    public $title;
    public $description;
    public $statistics;

    public function setHeader(WContent $content) {
        $this = $content;
    }

}

interface ISearch {  
    public function search_by_idchannel_playlists(WContent $channel);
    public function search_by_idplaylist_videos(WContent $playlist);
    public function search_by_idplaylist_channel(WContent $playlist);
    public function search_by_idvideo_channel(WContent $video);
    public function search_by_idvideo_playlist(WContent $video);
    public function get_statistic(WContent &$content);
    public function search_by_keyword($keyword, $type_content);      
}

interface ITreeContent {

    public function add($param);

    public function remove($id);

    public function get_content($id);
}



class WLeafContent extends WContent implements ITreeContent {
    
    protected function add($param) {
        
    }

    protected function get_content($id) {
        if ($this->id === $id)
            return $this;
        else
            return null;
    }

    public function remove($id) {
        if ($this->id === $id)
            return true;
        else
            return false;
    }

}

class WCompositeContent extends WContent implements ITreeContent {

    protected $content = array();

    public function add($composite) {
        $this->content[] = $composite;
    }

    public function get_content($id) {
        foreach ($this->content as $key => $value) {
            $content = $value->get_content($id);
            if ($content !== null) {
                return $content;
            }
        }
        return null;
    }

    public function remove($id) {
        foreach ($this->content as $key => $value) {
            if ($value->remove($id) === true) {
                unset($this->content[$key]);
                if (count($this->content) === 0)
                    return true;
            }
        }
        return false;
    }
}


interface IRequest extends ITreeContent {
    public function update_statistics(ISearch &$search_obj);
    public function build_tree(ISearch &$search_obj);
    public function test_view(ISearch &$search_obj);
}