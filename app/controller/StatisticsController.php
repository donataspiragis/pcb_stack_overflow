<?php

namespace App\Controller;
use DataBase\Connection;
use PDO;


class StatisticsController extends BaseController {

    public $buttons = [
        ['value' => 'ViewCount > 10000', 'text' => 'Topics Best'],
        ['value' => 'DocTagId = 9', 'text' => 'PHP'],
        ['value' => 'DocTagId = 5', 'text' => 'Java'],
        ['value' => 'DocTagId = 4', 'text' => 'C#'],
        ['value' => 'DocTagId = 11', 'text' => 'Python'],
        ['value' => 'DocTagId = 6', 'text' => 'Android'],
        ['value' => 'DocTagId = 8', 'text' => 'Javascript']
    ];

    public function index() {
        $sql_where = !empty($_POST) ? $_POST['action'] : 'ViewCount > 10000';

        foreach ($this->buttons as &$button) {
            $button['class'] = $button['value'] === $sql_where ? 'btn-success' : 'btn-light';
        }

        $topics = (new Connection)->getData("SELECT * FROM topics WHERE $sql_where LIMIT 10");

        $doc_tag_ids = [];
        foreach ($topics as $topic) {
            $id = $topic['DocTagId'];

            if (!in_array($id, $doc_tag_ids)) {
                $doc_tag_ids[$id] = $id;
            }
        }
        $doc_tag_ids_imploded = implode(',', $doc_tag_ids);

        $languages = (new Connection)->getData("SELECT * FROM languages WHERE id in ($doc_tag_ids_imploded)");
        foreach ($languages as $language) {
            $langs[$language['id']] = $language['Tag'];
        }

        foreach ($topics as &$topic) {
            $topic['Language'] = $langs[$topic['DocTagId']];
        }

        usort($topics, function ($a, $b) {
                return strnatcmp($a['ViewCount'], $b['ViewCount']);
            });

        echo $this->render('statisticsIndex', ['topics' => array_reverse($topics), 'btns' => $this->buttons]);
    }
}

