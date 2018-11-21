
<?php
require_once 'model/index.php';

$youtube_search=new WSearchBase();
$youtube_search->set_key_develop('AIzaSyDx2fe2WW4i09hyV3SQtTarn89Aw49Rh6k')
        ->set_sertificate_ssl(__DIR__.'/ssl/cacert.pem');
$youtube_search->create();

    $videos = '';
    $channels = '';
    $playlists = '';
   
    $keyword='Владимир Соловьев';
    
    $channel=new WSearchByChannel();
    $channel->set_search_base($youtube_search);
    $channel->search_content($keyword);
    $htmlBody=$channel->get_view();
    //$htmlBody = '<table border="1px">'
    //    . '<tr><td rowspan="3">gfgfgfgfgfgfgf</td><td>fffffffffff</td>'
    //    . '<tr><td>gggggggggg</td></tr>'
    //    . '<tr><td>gggggggggg</td></tr></tr>'
    //    . '</table>'
?>

<!doctype html>
<html>
  <head>
    <title>YouTube Search</title>
    <link rel="stylesheet" type="text/css" href="http://simpleeducat.lc:8080/model/data_search/css/style.css">
  </head>
  <body>
<!--<iframe id="ytplayer" type="text/html" width="640" height="360"
  src="http://www.youtube.com/embed/M7lc1UVf-VE"
  frameborder="0"/>
-->
<?=$htmlBody?>
  </body>
</html>
