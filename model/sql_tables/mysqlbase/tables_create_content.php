<?php



require_once '/./../interfaces.php';
require_once '/./../../library/functions.php';

class WTableCreate implements ITableCreate {

    private $link;

    private function create() {
        $this->link = mysqli_connect(HOST_MYSQL, LOGIN_MYSQL, PASSWORD_MYSQL);
        return $this->link;
    }

    private function destroy() {
        if (!empty($this->link))
            mysqli_close($this->link);
    }

    public function tables() {
        if (empty($this->create())) {
            return null;
        }
        $query = file_get_contents(get_home_url() . '/SQLQuestions/createTables.sql');
        $result = mysqli_query($this->link, $query);
        $this->destroy();
        return $result;
    }

}
