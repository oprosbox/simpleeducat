<?php require_once '/./../library/functions.php'; ?>
<script>

    var index = {flg_line_playlist: {flg: true},
        flg_line_channel: {flg: true},
        flg_line_video: {flg: true},
        flg_page_playlist: {flg: true},
        flg_page_channel: {flg: true},
        flg_page_video: {flg: true}};

    function create_lists() {
        str_address = '<?php echo get_home_url() ?>' + '/controller/controller.php';
        $.get(str_address, 'funct=set_item_menu&id=1');
    }

    function add_content(flg_line, funct, class_res, output_teg_id) {
        if (flg_line.flg === false) {
            return;
        }
        flg_line.flg = false;
        str_address = '<?php echo get_home_url() ?>' + '/controller/controller.php';
        pos = $("." + class_res).length;
        $.get(str_address, 'funct=' + funct + '&position=0' + pos)
                .done(function (data) {
                    if (data === '') {
                        flg_line.flg = false;
                    } else {
                        $('#' + output_teg_id).append(data);
                        flg_line.flg = true;
                    }
                }).fail(function (data) {
            flg_line.flg = true;
        });
    }

    function create_content(flg_line, funct, class_res, output_teg_id) {
        if (flg_line.flg === false) {
            return;
        }
        flg_line.flg = false;
        str_address = '<?php echo get_home_url() ?>' + '/controller/controller.php';
        pos = $("." + class_res).length;
        $.get(str_address, 'funct=' + funct + '&position=00')
                .done(function (data) {
                    if (data === '') {
                        flg_line.flg = false;
                    } else {
                        $('#' + output_teg_id).html(data);
                        flg_line.flg = true;
                    }
                }).fail(function (data) {
            flg_line.flg = true;
        });
    }

    function scroll_list_content(flg_line, funct, class_res, output_teg_id) {
        $('#' + output_teg_id).on('scroll', function (event) {
            var element = $('#' + output_teg_id);
            var val = element.get(0).scrollWidth - element.get(0).clientWidth - element.scrollLeft();
            if (val < 3) {
                add_content(flg_line, funct, class_res, output_teg_id);
            }
        });
    }

    function scroll_page_content(flg_line, funct, class_res) {
        $('#page_content').off('scroll');
        $('#page_content').on('scroll', function (event) {
            var element = $('#page_content');
            var val = element.get(0).scrollHeight - element.get(0).clientHeight - element.scrollTop();
            if (val < 3) {
                add_content(flg_line, funct, class_res, 'page_content');
            }
        });
    }

    function click_on_nav_playlist() {
        $("#list_playlists").on('click', '.nav_playlist', function ()
        {
            var id = $(this).attr('id');
            id = id.slice(5);
            str_address = '<?php echo get_home_url() ?>' + '/controller/controller.php';
            $.get(str_address, 'funct=set_playlist&id=' + id).done(function (data) {
                index.flg_line_video.flg = true;
                create_content(index.flg_line_video, 'update_line_videos', 'nav_video', 'list_videos');
                index.flg_page_video.flg = true;
                create_content(index.flg_page_video, 'update_page_videos', 'page_video', 'page_content');
                scroll_page_content(index.flg_page_video, 'update_page_videos', 'page_video');
            });
        });
    }

    function click_on_nav_channel() {
        $("#list_channels").on('click', '.nav_channel', function ()
        {
            var id = $(this).attr('id');
            id = id.slice(5);
            str_address = '<?php echo get_home_url() ?>' + '/controller/controller.php';
            $.get(str_address, 'funct=set_channel&id=' + id).done(function (data) {
                index.flg_line_playlist.flg = true;
                create_content(index.flg_line_playlist, 'update_line_playlists', 'nav_playlist', 'list_playlists');
                index.flg_line_video.flg = true;
                create_content(index.flg_line_video, 'update_line_videos', 'nav_video', 'list_videos');
                index.flg_page_playlist.flg = true;
                create_content(index.flg_page_playlist, 'update_page_playlists', 'page_playlist', 'page_content');
                scroll_page_content(index.flg_page_playlist, 'update_page_playlists', 'page_playlist');
            });
        });
    }

    function click_on_nav_video() {
        $("#list_videos").on('click', '.nav_video', function ()
        {
            var id = $(this).attr('id');
            id = id.slice(5);
            str_address = '<?php echo get_home_url() ?>' + '/controller/controller.php';
            $.get(str_address, 'funct=set_video&id=' + id).done(function (data) {
                index.flg_page_video.flg = true;
                create_content(index.flg_page_video, 'update_page_video', 'page_video', 'page_content');
            });
        });
    }

    $(document).ready(function () {
        create_lists();
        click_on_nav_channel();
        click_on_nav_playlist();
        click_on_nav_video();
        add_content(index.flg_line_channel, 'update_line_channels', 'nav_channel', 'list_channels');
        add_content(index.flg_line_playlist, 'update_line_playlists', 'nav_playlist', 'list_playlists');
        add_content(index.flg_line_video, 'update_line_videos', 'nav_video', 'list_videos');
        add_content(index.flg_page_playlist, 'update_page_playlists', 'page_playlist', 'page_content');
        scroll_list_content(index.flg_line_channel, 'update_line_channels', 'nav_channel', 'list_channels');
        scroll_list_content(index.flg_line_playlist, 'update_line_playlists', 'nav_playlist', 'list_playlists');
        scroll_list_content(index.flg_line_video, 'update_line_videos', 'nav_video', 'list_videos');
        scroll_page_content(index.flg_page_playlist, 'update_page_playlists', 'page_playlist');

    });

</script>