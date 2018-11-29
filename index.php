
<?php
require_once 'model/index.php';

$youtube_search = new WSearchBase();
$youtube_search->set_key_develop('AIzaSyDx2fe2WW4i09hyV3SQtTarn89Aw49Rh6k')
        ->set_sertificate_ssl(__DIR__ . '/ssl/cacert.pem');
$youtube_search->create();
$youtubeDataSet = new WYoutubeDataSet();

$keyword = 'Владимир Соловьев';
$strat_save = new WStratSaveContent;
$strat_view = new WStratView;
//$create=new WTableCreate;
$strat_save->create();
//$create->tables();

$youtubeDataSet->set_strat_search($youtube_search);
$youtubeDataSet->set_strat_save($strat_save);
$youtubeDataSet->set_strat_view($strat_view);
$youtubeDataSet->get_list_from_youtube(array($keyword));
$htmlBody = $youtubeDataSet->view_current_list();
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
        <?= $htmlBody ?>
    </body>
</html>
