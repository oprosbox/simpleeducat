<?php

require_once '/./../search_interfaces.php';

class WLeafContent extends WContent implements ITreeContent {

    public function add($param) {
        
    }

    public function get_content($id) {
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

    protected $content = [];
    protected $pos = 0;

    public function to_begin() {
        $this->pos = 0;
    }

    public function get_next() {
        if (!empty($this->content[$this->pos])) {
            $content = $this->content[$this->pos];
            $this->pos += ($this->pos + 1) % count($this->content);
            return $this->content;
        } else {
            return null;
        }
    }

    public function add($composit) {
        $this->content[] = $composit;
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

class WCompositeRequest extends WCompositeContent implements IRequest {

    public function find_granny(&$search_obj) {
        foreach ($this->content as $key => $value) {
            $tree_youtube = null;
            set_time_limit(300);
            if ($value->type === 'youtube#video') {
                $tree_youtube = $search_obj->search_by_idvideo_channel($value);
            }
            if ($tree_youtube !== null) {
                $this->content[$key] = $tree_youtube;
            }
        }
    }

    public function find_parent(&$search_obj) {
        foreach ($this->content as $key => $value) {
            $tree_youtube = null;
            set_time_limit(300);
            switch ($value->type) {
                case 'youtube#video': {
                        $tree_youtube = $search_obj->search_by_idvideo_playlist($value);
                        break;
                    }
                case 'youtube#playlist': {
                        $tree_youtube = $search_obj->search_by_idplaylist_channel($value);
                        break;
                    }
                default : {
                        continue;
                    }
            }
            if ($tree_youtube !== null) {
                $this->content[$key] = $tree_youtube;
            }
        }
    }

    public function update_statistics(&$search_obj) {
        $search_obj->get_statistics($this);
        foreach ($this->content as $key => $value) {
            $value->update_statistics($search_obj);
        }
    }

    public function build_tree(&$search_obj) {
        $search_obj->get_statistics($this);
        foreach ($this->content as $key => $value) {
            $tree_youtube = null;
            set_time_limit(300);
            switch ($value->type) {
                case 'youtube#channel': {
                        $tree_youtube = $search_obj->search_by_idchannel_playlists($value);
                        break;
                    }
                case 'youtube#playlist': {
                        $tree_youtube = $search_obj->search_by_idplaylist_videos($value);
                        break;
                    }
                default : {
                        continue;
                    }
            }
            if ($tree_youtube !== null) {
                $this->content[$key] = $tree_youtube;
                $this->content[$key]->build_tree($search_obj);
            }
        }
    }

    public function view(&$body) {
        $report = '<div class="coll"><div class="row_left">' . $this->id . '</div><div class="row_right">';
        foreach ($this->content as $value) {
            $value->view($report);
        }
        $body .= $report . '</div></div>';
    }

}

class WLeafRequest extends WLeafContent implements IRequest {

    public function find_granny(&$search_obj) {
        
    }

    public function find_parent(&$search_obj) {
        
    }

    public function update_statistics(&$search_obj) {
        $search_obj->get_statistics($this);
    }

    public function build_tree(&$search_obj) {
        $search_obj->get_statistics($this);
    }

    public function view(&$body) {
        $body .= '<div class="row_end">' . $this->id . '</div>';
    }

}
