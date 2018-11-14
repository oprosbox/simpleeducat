
<?php
require_once 'library/functions.php';

$youtube=new WSearch();
$youtube->set_key_develop('AIzaSyDx2fe2WW4i09hyV3SQtTarn89Aw49Rh6k')
        ->set_sertificate_ssl('C:\wamp64\bin\php\php7.0.10\extras\ssl\cacert.pem');
$youtube->create();
$part="id,snippet";//
$param=array('channelId' =>'UCPkDvaKV6u6FgM650A0pdCA' , 'maxResults' => 25) ; 

    $videos = '';
    $channels = '';
    $playlists = '';

    $searchResponse=$youtube->get_video_list($part, $param);
    
     // $htmlBody = var_dump($searchResponse['items']);

      
?>

<!doctype html>
<html>
  <head>
    <title>YouTube Search</title>
  </head>
  <body>
<!-- 
<iframe id="ytplayer" type="text/html" width="640" height="360"
  src="http://www.youtube.com/embed/M7lc1UVf-VE?autoplay=1"
  frameborder="0"/>--!>
<?=$htmlBody?>
  </body>
</html>
