<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '/./WControlContent.php';

class WBodyChannel extends WControlContent implements IStratCompCreate {

    public function update($pos) {
        if(count(WControlContent::$playlists)==$pos)
         {parent::get_playlists_from_BD_next();}
        $array = array_slice(parent::$playlists, $pos, parent::$step, true);
        foreach ($array as $key => $playlist)
            $this->item_playlist($key, $playlist);
    }

    private function item_playlist($key, $playlist) {
        $key_item=WControlContent::$params['id_item'];
        $key_channel=WControlContent::$params['id_channel'];
        $key_playlist=WControlContent::$params['id_playlist'];
        $thumbnail_channel=WControlContent::$channels[$key_channel];
        ?> <div class="list-group-item bg-dark page_playlist" id="<?php echo $key ?>">
            <div class="row">
               <div class="col-lg-3 col-md-4 col-sm-12 p-2 mx-3">
                <iframe id="bp_<?php echo $key ?>" type="text/html" width="320" height="180"
                        src="http://www.youtube.com/embed?listType=playlist&list=<?php echo $key ?>"
                        frameborder="0" allowfullscreen> </iframe>
                   </div>
                <div class="col-lg-8 col-md-7 col-sm-12 p-2 mx-3" >
                    <div class="card bg-secondary">
                        <div class="card-header">
                            <div class="d-flex flex-wrap-reverse flex-sm-wrap flex-md-wrap flex-lg-wrap flex-xl-wrap">
                            <img class="align-self-start"  alt="<?php echo $thumbnail_channel['title'] ?>" 
                                 src="<?php echo $thumbnail_channel['thumbnails']->default->url ?>" 
                                 height="<?php echo $thumbnail_channel['thumbnails']->default->height ?>"
                                 width="<?php echo $thumbnail_channel['thumbnails']->default->width ?>"></img>
                            <div class="list-group" style="max-width:150px;">
                            <button id="plch_<?php echo $key_item ?>" type="button" class="item-list-group btn btn-primary mx-2 channels">Каналы</button>
                            <button id="plvd_<?php echo $key ?>" type="button" class="item-list-group btn btn-primary mx-2 videos">Подробнее</button>
                            </div>
                            </div>
                            <h5 class="my-2"><?php echo $playlist['title'] ?></h5>
                        </div>
                        <div class="card-body" style="max-height:150px;overflow-y: auto">
                            <h6><?php echo $playlist['description'] ?></h6>
                        </div></div></div>
            </div>
        </div> 
        <?php
    }

}


