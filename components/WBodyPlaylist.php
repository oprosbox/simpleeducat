<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '/./WControlContent.php';

class WBodyPlaylist extends WControlContent implements IStratCompCreate {

    public function update($pos) {
        if(count(WControlContent::$videos)==$pos)WControlContent::get_videos_from_BD_next();
        $array = array_slice(WControlContent::$videos, $pos, WControlContent::$step, true);
        foreach ($array as $key => $video)
            $this->item_video($key, $video);
    }

    private function item_video($key, $video) {
        $key_channel=WControlContent::$params['id_channel'];
        $thumbnail_channel=WControlContent::$channels[$key_channel];
        $key_playlist=WControlContent::$params['id_playlist'];
        $thumbnail_playlist=WControlContent::$playlists[$key_playlist];
        ?> <div class="list-group-item mx-3 bg-dark page_video" id="<?php echo $key ?>">
            <div class="row">
                <div class="col-lg-4 col-md-5 col-sm-12 p-2">
                <iframe id="bv_<?php echo $key ?>" type="text/html" width="320" height="180"
                        src="http://www.youtube.com/embed/<?php echo $key ?>?rel=0&iv_load_policy=3&disablekb=1"
                        frameborder="0" allowfullscreen> </iframe>
                 </div>
                <div class="col-lg-8 col-md-7 col-sm-12 p-2" >
                    <div class="card mx-3 bg-secondary">
                        <div class="card-header">
                            <h5><?php echo $video['title'] ?></h5>
                            <img class="align-self-start"  alt="<?php echo $thumbnail_channel['title'] ?>" 
                                 src="<?php echo $thumbnail_channel['thumbnails']->default->url ?>" 
                                 height="<?php echo $thumbnail_channel['thumbnails']->default->height ?>"
                                 width="<?php echo $thumbnail_channel['thumbnails']->default->width ?>"></img>
                            <button id="vdch_<?php echo $key_channel ?>" type="button" class="btn btn-primary mx-2">Каналы</button>
                            <img class="align-self-start"  alt="<?php echo $thumbnail_playlist['title'] ?>" 
                                 src="<?php echo $thumbnail_playlist['thumbnails']->default->url ?>" 
                                 height="<?php echo $thumbnail_playlist['thumbnails']->default->height ?>"
                                 width="<?php echo $thumbnail_playlist['thumbnails']->default->width ?>"></img>
                            <button id="vdpl_<?php echo $key_playlist ?>" type="button" class="btn btn-primary mx-2">Плейлисты</button>
                            <button id="vdvi_<?php echo $key ?>" type="button" class="btn btn-primary mx-2">Подробнее</button>
                        </div>
                        <div class="card-body">
                            <h6><?php echo $video['description'] ?></h6>
                        </div></div></div>
            </div>
        </div> 
        <?php
    }

}
