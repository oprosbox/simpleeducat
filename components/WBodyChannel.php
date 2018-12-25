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
        $key_channel=WControlContent::$params['id_channel'];
        $thumbnail_channel=WControlContent::$channels[$key_channel];
        ?> <div class="list-group-item mx-3 bg-dark page_playlist" id="<?php echo $key ?>">
            <div class="row">
               <div class="col-lg-4 col-md-5 col-sm-12 p-2">
                <iframe id="bp_<?php echo $key ?>" type="text/html" width="320" height="180"
                        src="http://www.youtube.com/embed?listType=playlist&list=<?php echo $key ?>"
                        frameborder="0" allowfullscreen> </iframe>
                   </div>
                <div class="col-lg-8 col-md-7 col-sm-12 p-2" >
                    <div class="card mx-3 bg-secondary">
                        <div class="card-header">
                            <img class="align-self-start"  alt="<?php echo $thumbnail_channel['title'] ?>" 
                                 src="<?php echo $thumbnail_channel['thumbnails']->default->url ?>" 
                                 height="<?php echo $thumbnail_channel['thumbnails']->default->height ?>"
                                 width="<?php echo $thumbnail_channel['thumbnails']->default->width ?>"></img>
                            <button id="plch_<?php echo $key_channel ?>" type="button" class="btn btn-primary mx-2">Каналы</button>
                            <button id="plvd_<?php echo $key ?>" type="button" class="btn btn-primary mx-2">Видео</button>
                            <h5 class="my-2"><?php echo $playlist['title'] ?></h5>
                        </div>
                        <div class="card-body">
                            <h6><?php echo $playlist['description'] ?></h6>
                        </div></div></div>
            </div>
        </div> 
        <?php
    }

}


