
<?php
require_once 'model/index.php';

$youtube=new WSearch();
$youtube->set_key_develop('AIzaSyDx2fe2WW4i09hyV3SQtTarn89Aw49Rh6k')
        ->set_sertificate_ssl(__DIR__.'/ssl/cacert.pem');
$youtube->create();

    $videos = '';
    $channels = '';
    $playlists = '';

    //$searchResponse=$youtube->search_all_video("владимир соловьев");
    //$searchResponse=$youtube->search_lists_by_idChanel("PLwJvP0lZee7wGKLURAENUVekHeK0nGO-A");
    //UCPkDvaKV6u6FgM650A0pdCA
    //mC0pGM00rVQ,hzMLfSpIg_M
    //$searchResponse=$youtube->search_lists_by_idChanel("UCPkDvaKV6u6FgM650A0pdCA");
    $searchvideo=$youtube->search_all_video("органическая химия лекции");
    $htmlBody='<p>count video= '. count($searchvideo).'</p>';
     foreach ($searchvideo as $video) {
    $searchResponse=$youtube->search_video_statistics($video['id']['videoId']);
    $htmlBody.='<p>size= '. count($searchResponse).'</p>';
    $htmlBody .='<hr>';
    foreach ($searchResponse as $value) {
    $htmlBody .='<p>tittle= '.$value['snippet']['title'].'</p>';
    $htmlBody .='<p>description= '.$value['snippet']['description'].'</p>';
    $htmlBody .='<p>id= '.$value['snippet']['channelId'].'</p>';
     $htmlBody .='<hr>';}}
      
?>

<!doctype html>
<html>
  <head>
    <title>YouTube Search</title>
  </head>
  <body>
<!--<iframe id="ytplayer" type="text/html" width="640" height="360"
  src="http://www.youtube.com/embed/M7lc1UVf-VE"
  frameborder="0"/>
-->
<?=$htmlBody?>
  </body>
</html>
