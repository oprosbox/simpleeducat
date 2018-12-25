<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '/./WControlContent.php';

class WBodyListChannel extends WControlContent implements IStratCompCreate {

    public function update($pos) {
        if(count(WControlContent::$channels)==$pos)WControlContent::get_channels_from_BD_next();
        $array = array_slice(WControlContent::$channels, $pos, WControlContent::$step, true);
        foreach ($array as $key => $channel)
            $this->list_channels($key, $channel);
    }

    private function list_channels($key, $channel) {
        ?>
        <div class="list-group-item mx-3 bg-dark page_channel" id="<?php echo $key ?>" style="min-width: 350px">
            <div class="row" >
                <div class="col-lg-3 col-md-4 col-sm-12 p-2">
                <img class="align-self-start rounded "  alt="<?php echo $channel['title'] ?>" src="<?php echo $channel['thumbnails']->medium->url ?>" 
                                 height="<?php echo $channel['thumbnails']->medium->height ?>"
                                 width="<?php echo $channel['thumbnails']->medium->width ?>"></img>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-12 p-2" style="min-width: 350px">
                    <div class="card bg-secondary">
                        <div class="card-header">
                            <h5><?php echo $channel['title'] ?></h5>
                        <button id="chpl_<?php echo $key ?>" type="button" class="btn btn-primary">Плейлисты</button>
                        </div>
                        <div class="card-body">
                        
                            <h6><?php echo $channel['description'] ?></h6>
                        </div>
                    </div></div>
            </div>
        </div>;  
        <?php
    }

}
