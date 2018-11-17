<?php

require_once '/./youtube/WSearchByChannel.php';
require_once '/./youtube/WSearchByVideoChanel.php';
require_once '/./youtube/WSearchByVideoGroup.php';
require_once '/./youtube/WSearchByVideolist.php';

interface IStratSearch {

    public function search_content($param);
}

class WContent {
    public $video_id;
    public $video_title;
    public $video_description;
    public $video_statistic;
    public $playlist_id;
    public $playlist_title;
    public $playlist_description;
    public $playlist_statistic;
    public $channel_id;
    public $channel_title;
    public $channel_description;
    public $channel_statistic;
}


