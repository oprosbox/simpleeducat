
<?php
require_once 'model/index.php';
require_once 'components/index.php';
require_once 'library/functions.php';

WSingletonConnect::create();
//$htmlBody= WMenu::create_menu();

/**$youtube_search = new WSearchBase();
$youtube_search->set_key_develop('AIzaSyDx2fe2WW4i09hyV3SQtTarn89Aw49Rh6k')
        ->set_sertificate_ssl(__DIR__ . '/ssl/cacert.pem');
$youtube_search->create();
$youtubeDataSet = new WYoutubeDataSet();
$youtube_question=new WQuestionBD();
$keyword = 'Владимир Соловьев';
$strat_save = new WStratSaveContent;
$strat_view = new WStratView;
$strat_save->create();
$youtubeDataSet->set_strat_search($youtube_search);
$youtubeDataSet->set_strat_questions($youtube_question);
$youtubeDataSet->set_strat_save($strat_save);
$youtubeDataSet->set_strat_view($strat_view);
$youtubeDataSet->release_questions(array('max_count'=>2));
$htmlBody = $youtubeDataSet->view_current_list();
*/

include_once '/./view/viewer.php';
?>


