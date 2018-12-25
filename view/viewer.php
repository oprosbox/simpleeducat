
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Заголовок</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="http://simpleeducat.lc:8080/model/data_search/css/style.css">
    </head>
    <body class="">
        <div class="list-group">
            <div class="list-group-item bg-dark">
                <div id="list_channels" class="list-unstyled media" style="overflow-x: auto">  
                </div>
            </div>
            <div class="list-group-item bg-dark">
                <div id="list_playlists" class="list-unstyled media" style="overflow-x: auto">
                 
                </div>
            </div>
            <div class="list-group-item bg-dark">
                <div id="list_videos" class="list-unstyled media" style="overflow-x: auto"> 
                </div>
            </div>
        </div> 
         <div class="list-group bg-dark" id="page_content" style="height: 800px;overflow-y: scroll">
                
         </div>
        <?php  
        //CComponent::create('WMenu');
        //WBody::set_id_item('1');
        //CComponent::create('WBodyChannel');
        ?>
        <div class="big_list"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
     <?php include 'scripts.php';?>
    </body>
</html>
