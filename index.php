
<?php
require_once 'model/index.php';
require_once 'components/index.php';
require_once 'library/functions.php';

WSingletonConnect::create();
//$htmlBody= WMenu::create_menu();

//$youtube_search = new WSearchBase();
//$youtube_search->set_key_develop('AIzaSyDx2fe2WW4i09hyV3SQtTarn89Aw49Rh6k')
//        ->set_sertificate_ssl(__DIR__ . '/ssl/cacert.pem');
//$youtube_search->create();
//$youtubeDataSet = new WYoutubeDataSet();
//$keyword = 'Владимир Соловьев';
//$strat_save = new WStratSaveContent;
//$strat_view = new WStratView;
//$strat_save->create();
//$youtubeDataSet->set_strat_search($youtube_search);
//$youtubeDataSet->set_strat_save($strat_save);
//$youtubeDataSet->set_strat_view($strat_view);
//$youtubeDataSet->get_list_from_youtube(array($keyword));
//$htmlBody = $youtubeDataSet->view_current_list();

?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Заголовок</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="http://simpleeducat.lc:8080/model/data_search/css/style.css">
    </head>
    <body>
  <!--<iframe id="ytplayer" type="text/html" width="640" height="360"
    src="http://www.youtube.com/embed/M7lc1UVf-VE"
    frameborder="0"/>
        -->
        <?php WMenu::create(); ?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>
