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
  

    protected $content=[];

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
                        //var_dump($value->id);
                       // echo '<p>' . $key . ' youtube#channel count=' . count($tree_youtube) . '</p>';
                        break;
                    }
                case 'youtube#playlist': {
                        $tree_youtube = $search_obj->search_by_idplaylist_videos($value);
                        break;
                        // echo '<p>' . $key . ' youtube#playlist count=' . count($tree_youtube) . '</p>';
                    }
                default : {
                        continue;
                    }
            }
            if ($tree_youtube!==null) {
                $this->content[$key] = $tree_youtube;
                $this->content[$key]->build_tree($search_obj);
            }
        }
    }

  //  public function view(&$body){
 //       $report.='<tr><td rowspan=\"'.count($this->content).'\">'.$this->id.'</td>';
  //      foreach ($this->content as $key => $value) {
  //        $report.='<tr>';
  //        $value->view($report); 
  //        $report.='</tr>';
  //      }
  //      $report=preg_replace("<tr>", " ", $report,1);
  //      $body.=$report;
  //  }
       public function view(&$body){
       $report='<div class="coll"><div class="row_left">'.$this->id.'</div><div class="row_right">';
        foreach ($this->content as $value) {
         $value->view($report); 
      }
      $body.=$report.'</div></div>';
   }
}

class WLeafRequest extends WLeafContent implements IRequest {

    public function update_statistics(&$search_obj) {
        $search_obj->get_statistics($this);
    }

    public function build_tree(&$search_obj) {
        $search_obj->get_statistics($this);
    }

   // public function view(&$body){
   // $body.="<td>$this->id<td>";   
   // }
    
    public function view(&$body){
    $body.='<div class="row_end">'.$this->id.'</div>';   
    }
}

