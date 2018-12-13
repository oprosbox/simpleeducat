<?php

require_once '/./interfaces.php';
require_once '/./mysqlbase/single_connect.php';
/**
 * 
 */
class WYoutubeDataGetUser extends WSingletonConnect implements IYoutubeDataGetUser {
/**
 * 
 * @param mysql_array $result_query[]
 * @return array
 */
    private function convert_to_array_menu($result_query) {
        $menu = [];
        while ($row = $result_query->fetch_array()) {
            $menu[$row['id_item']] = array('id_parent' => $row['id_parent'],
                'title' => $row['title'],
                'description' => $row['description']);
        }
        $result_query->close();
        return $menu;
    }

    private function convert_to_array_sources($result_query) {
        $sources = [];
        while ($row = $result_query->fetch_array()) {
            $sources[$row['id']] = array('id_parent' => $row['id_parent'],
                'title' => $row['title'],
                'description' => $row['description'],
                'type_source' => $row['type_source'],
                'statistics' => json_decode($row['statistics']));
        }
        $result_query->close();
        return $sources;
    }
    
 /**
 * 
 * @param mysql_array $result_query[]
 * @return array
 */
    private function convert_to_array_content($result_query) {
        $content = [];
        while ($row = $result_query->fetch_array()) {
            $content[$row['id_content']] = array('id_item' => $row['id_item'],
                'title' => $row['title'],
                'description' => $row['description']);
        }
        $result_query->close();
        return $content;
    }
/**
 * 
 * @param string $id_item
 * @return string
 */
    public function list_content($id_item) {
        $query = "SELECT * FROM content WHERE id_item=$id_item";
        $result=WLog::mysql_log(self::$link, $query);
        return $this->convert_to_array_content($result);
    }
/**
 * 
 * @param string $id_item
 * @param string $type
 * @param int $num
 * @param int $limit
 * @return array
 */
    public function data_list_content($id_item, $type = null,$num = 0, $limit = null) {
        $limit_str = "";
        $type_str = "";
        if ($limit != null) {
            $pos = $num * $limit;
            $limit_str = "LIMIT $pos,$limit";
        }
        if ($type != null) {
            $type_str = "AND (type_source='$type')";
        }
        $query = "SELECT * FROM sources WHERE (id_content IN(SELECT id_content FROM content WHERE id_item=$id_item) $type_str) $limit_str";
        $result=WLog::mysql_log(self::$link, $query);
        return $this->convert_to_array_sources($result);
    }
/**
 * 
 * @return string[]
 */
    public function menu() {
        $query = "SELECT * FROM menu";
        $result=WLog::mysql_log(self::$link, $query);
        return $this->convert_to_array_menu($result);
    }
  /**
   * 
   * @param string $id_parent
   * @param string $type
   * @param int $num
   * @param int $limit
   * @return array
   */  
    public function sources_by_parent($id_parent, $type = null,$num = 0, $limit = null){
        $limit_str = "";
        $type_str = "";
        if ($limit != null) {
            $pos = $num * $limit;
            $limit_str = "LIMIT $pos,$limit";
        }
        if ($type != null) {
            $type_str = "AND (type_source='$type')";
        }
        $query = "SELECT * FROM sources WHERE ((id_parent='$id_parent') $type_str) $limit_str";
        $result=WLog::mysql_log(self::$link, $query);
        return $this->convert_to_array_sources($result); 
    }
}
/**
 * 
 */
class WYoutubeDataGetAdmin extends WYoutubeDataGetUser implements IYoutubeDataGetAdmin {
/**
 * 
 * @param string $id_item[]
 * @return array
 */
    public function lists_of_content($id_item) {
        $list = implode(',', $id_item);
        $query = "SELECT * FROM content WHERE id_item IN ($list)";
        $result=WLog::mysql_log(self::$link, $query);
        return $this->convert_to_array_content($result);
    }
/**
 * 
 * @param string $id_content[]
 * @param string $type
 * @param int $num
 * @param int $limit
 * @return array
 */
    
    public function data_content_sources($id_content, $type = null, $num = 0, $limit = null) {
        $list = implode(',', $id_content);
        $limit_str = "";
        $type_str = "";
        if ($limit != null) {
            $pos = $num * $limit;
            $limit_str = "LIMIT $pos,$limit";
        }
        if ($type != null) {
            $type_str = "AND (type_source=$type)";
        }
        $query = "SELECT * FROM sources WHERE ((id_content IN($list) $type_str) $limit_str";
        $result=WLog::mysql_log(self::$link, $query);
        return $this->convert_to_array_sources($result);
    }
/**
 * 
 * @param string $id_sources[]
 * @param int $num
 * @param int $limit
 * @return array
 */
    public function data_sources($id_sources, $num = 0, $limit = null) {
        $list = implode(',', $id_sources);
        $limit_str = "";
        if ($limit != null) {
            $pos = $num * $limit;
            $limit_str = "LIMIT $pos,$limit";
        }
        $query = "SELECT * FROM sources WHERE (id IN($list)) $limit_str";
        $result=WLog::mysql_log(self::$link, $query);
        return $this->convert_to_array_sources($result);
    }
}
