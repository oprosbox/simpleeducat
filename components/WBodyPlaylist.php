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
        $key_item=WControlContent::$params['id_item'];
        $key_channel=WControlContent::$params['id_channel'];
        $thumbnail_channel=WControlContent::$channels[$key_channel];
        $key_playlist=WControlContent::$params['id_playlist'];
        $thumbnail_playlist=WControlContent::$playlists[$key_playlist];
        ?> <div class="list-group-item bg-dark page_video" id="<?php echo $key ?>">
            <div class="row">
                <div class="col-lg-4 col-md-5 col-sm-12 p-2 ">
                <iframe id="bv_<?php echo $key ?>" type="text/html" width="320" height="180"
                        src="http://www.youtube.com/embed/<?php echo $key ?>?rel=0&iv_load_policy=3&disablekb=1"
                        frameborder="0" allowfullscreen> </iframe>
                 </div>
                <div class="col-lg-8 col-md-7 col-sm-12 p-2" >
                    <div class="card bg-secondary">
                        <div class="card-header">
                             <div class="d-flex flex-wrap-reverse flex-sm-wrap flex-md-wrap flex-lg-wrap flex-xl-wrap">
                            <img class="mx-3 mb-3"  alt="<?php echo $thumbnail_channel['title'] ?>" 
                                 src="<?php echo $thumbnail_channel['thumbnails']->default->url ?>" 
                                 height="<?php echo $thumbnail_channel['thumbnails']->default->height ?>"
                                 width="<?php echo $thumbnail_channel['thumbnails']->default->width ?>"></img>
                            <img class="mx-3 mb-3"  alt="<?php echo $thumbnail_playlist['title'] ?>" 
                                 src="<?php echo $thumbnail_playlist['thumbnails']->default->url ?>" 
                                 height="<?php echo $thumbnail_playlist['thumbnails']->default->height ?>"
                                 width="<?php echo $thumbnail_playlist['thumbnails']->default->width ?>"></img>
                            <div class="list-group mx-3 mb-3">
                            <button id="vdch_<?php echo $key_item ?>" type="button" class="item-list-group btn btn-primary channels">Каналы</button>
                            <button id="vdpl_<?php echo $key_channel ?>" type="button" class="item-list-group btn btn-primary playlists">Плейлисты</button>
                            <button id="vdin_<?php echo $key ?>" type="button" class="item-list-group btn btn-primary info-video">Подробнее</button>
                        </div></div>
                        <h5><?php echo $video['title'] ?></h5>
                        </div>
                        <div class="card-body" style="max-height:150px;overflow-y: auto">
                            <h6><?php echo $video['description'] ?></h6>
                        </div></div></div>
            </div>
        </div> 
        <?php
    }

}
