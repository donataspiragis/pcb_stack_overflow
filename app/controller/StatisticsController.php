<?php

namespace App\Controller;
use DataBase\Connection;
use PDO;


class StatisticsController extends BaseController {

    public function index() {
        $topics = (new Connection)->getData("SELECT * FROM topics WHERE ViewCount > 10000");
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



        // sort alphabetically by name
        usort($topics, function($a, $b) {
            return strnatcmp($a['ViewCount'], $b['ViewCount']);
        });

        echo $this->render('statisticsIndex', ['data' => array_reverse($topics)]);
    }
}

