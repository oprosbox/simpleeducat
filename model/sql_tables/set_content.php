<?php

require_once 'interfaces.php';
require_once 'strat_save.php';
require_once 'strat_questions.php';

class WYoutubeDataSet implements IYoutubeDataSet {

    protected $list_search;
    protected $strat_questionsBD;

    public function save_content() {
        foreach ($this->list_search as $list)
            $list->save_content();
        return $this;
    }

    public function set_strat_search(ISearch $strat) {
        WCompositeRequest::set_strat_search($strat);
        return $this;
    }

    public function set_strat_save(IStrategySave $strat) {
        WCompositeRequest::set_strat_save($strat);
        return $this;
    }

    public function set_strat_view(IStrategyView $strat) {
        WCompositeRequest::set_strat_view($strat);
        return $this;
    }

    public function set_strat_questions(IQuestions $strat) {
        $this->strat_questionsBD = $strat;
        return $this;
    }

    public function get_list_from_youtube($questions, $count=2) {
        unset($this->list_search);
        foreach ($questions as $quest) {
            $list = new WCompositeRequest;
            $list->set_type('youtube#keyword#channel');
            $list->set_description($quest);
            WCompositeRequest::$search_obj->set_maxResult('youtube#keyword#channel', $count);
            $list->build_tree($param);
            $list->save();
            $this->list_search[] = $list;
        }
    }

    public function view_current_list() {
        $page = '';
        foreach ($this->list_search as $tree) {
            $page .= $tree->view();
        }
        return $page;
    }

    public function get_and_save_content($questions, $count = 2) {
        foreach ($questions as $quest) {
            $list = new WCompositeRequest;
            $list->set_type('youtube#keyword#channel');
            $list->set_description($quest);
            WCompositeRequest::$search_obj->set_maxResult('youtube#keyword#channel', $count);
            $list->build_tree($param);
            $list->save();
        }
    }

    public function release_questions($param) {
        $questions = $this->strat_questionsBD->questions($param);
        $this->get_and_save($questions, 5);
    }

}
