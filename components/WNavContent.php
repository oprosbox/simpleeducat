<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '/./WControlContent.php';

class WNavChannels extends WControlContent implements IStratCompCreate {

    public function update($pos) {
        if (count(WControlContent::$channels) === $pos) {
            parent::get_channels_from_BD_next();
        }
        $this->update_channels($pos);
    }

    private function line_channels($key, $channel) {
        if(!empty($channel['thumbnails'])){}else return
        ?>   
        <div class="col-3 mx-2 my-3 nav_channel" id="nvch_<?php echo $key ?>" style="min-width: 350px">
            <div class="row bg-secondary p-1">
                <div class="col-4"> 
                    <img class="img-thumbnail" 
                         src="<?php echo $channel['thumbnails']->default->url ?>" 
                         height="<?php echo $channel['thumbnails']->default->height ?>"
                         width="<?php echo $channel['thumbnails']->default->width ?>"></img> 
                </div>
                <div class="col-8"> 
                <h6><?php echo $channel['title'] ?></h6>
                </div>
            </div>  
        </div>  
        <?php
    }

    public function update_channels($pos) {
        $array = array_slice(WControlContent::$channels, $pos, WControlContent::$step, true);
        foreach ($array as $key => $channel)
            $this->line_channels($key, $channel);
    }
}

class WNavPlaylists extends WControlContent implements IStratCompCreate {

    public function update($pos) {
         if(count(WControlContent::$playlists)==$pos)
         {parent::get_playlists_from_BD_next();}
                    $this->update_playlists($pos);
    }

private function line_playlists($key, $playlist) {
    if(!empty($playlist['thumbnails'])){}else return
        ?>  
        <div class="col-3 mx-2 my-3 nav_playlist" id="nvpl_<?php echo $key ?> " style="min-width: 350px">
            <div class="row bg-secondary p-1">
                <div class="col-4">    
                    <img class="img-thumbnail"
                         src="<?php echo $playlist['thumbnails']->default->url ?>" 
                         height="<?php echo $playlist['thumbnails']->default->height ?>"
                         width="<?php echo $playlist['thumbnails']->default->width ?>"></img> 
                </div>
                <div class="col-8"> 
                    <h6><?php echo $playlist['title'] ?> </h6>
                </div> 
            </div>  
        </div>      
        <?php
 }

    public function update_playlists($pos) {
        $array = array_slice(WControlContent::$playlists, $pos, WControlContent::$step, true);
        foreach ($array as $key => $playlist)
            $this->line_playlists($key, $playlist);
    }
}

class WNavVideos extends WControlContent implements IStratCompCreate {

    public function update($pos) {
        if (count(WControlContent::$videos) == $pos) {
            parent::get_videos_from_BD_next();
        }
        $this->update_videos($pos);
    }

    private function line_videos($key, $video) {
        if(!empty($video['thumbnails'])){}else return
        ?> 
        <div class="col-3 mx-2 my-3 nav_video" id="nvvi_<?php echo $key ?>" style="min-width: 350px">
            <div class="row bg-secondary p-1">
                <div class="col-4">  
                    <img class="img-thumbnail"
                         src="<?php echo $video['thumbnails']->default->url ?>" 
                         height="<?php echo $video['thumbnails']->default->height ?>"
                         width="<?php echo $video['thumbnails']->default->width ?>"></img> 
                </div> 
                <div class="col-8"> 
                    <h6><?php echo $video['title'] ?> </h6>
                </div> 
            </div>  
        </div>
        <?php
    }
    
    public function update_videos($pos) {
        $array = array_slice(WControlContent::$videos, $pos, WControlContent::$step, true);
        foreach ($array as $key => $video)
            $this->line_videos($key, $video);
    }
}