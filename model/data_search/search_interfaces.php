<?php

require_once '/./list_interfaces.php';



interface IFactoryList {

    public function create_composit($content = null);

    public function create_leaf($content = null);
}

interface ISearch {

    public function set_factory_list(IFactoryList $factory);

    public function search_by_idchannel_playlists(WContent $channel);

    public function search_by_idplaylist_videos(WContent $playlist);

    public function search_by_idplaylist_channel(WContent $playlist);

    public function search_by_idvideo_channel(WContent $video);

    public function search_by_idvideo_playlist(WContent $video);

    public function get_statistics(WContent &$content);

    public function search_by_keyword($keyword, $type_content,$count);
}

interface IStratSearch {

    public function set_search_base(ISearch $search_obj);

    public function search_content($param);
}
