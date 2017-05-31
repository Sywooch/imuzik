<?php

namespace common\libs;

use Solarium\Core\Client\Client;

class Search {

    public static function searchAll($query, $limit = 10, $offset = 0) {
        $client = new Client(\Yii::$app->params['solr']['song']);
        $exec = $client->createQuery($client::QUERY_SELECT);
        $exec->setQuery($query);
        $exec->setRows($limit);
        if ($offset) {
            $exec->setStart($offset);
        }
        $resultset = $client->execute($exec);

        foreach ($resultset as $document) {
            $data['full_items'][] = $document;
        }

        $data['total'] = $resultset->getNumFound();
        return $data;
    }

    public static function nameValidate($keyword, $songs, $offset) {
        if ($songs && $offset == 0) {
            foreach ($songs as $song) {
                if (self::textCompare(strtoupper($keyword), strtoupper($song->song_name)) == 100) {
                    \Yii::$app->session->set($keyword, true);
                    return true;
                }
            }
        }
        return (\Yii::$app->session->get($keyword));
    }

    public static function textCompare($t1, $t2) {
        $t1 = strtoupper(RemoveSign::removeSign($t1));
        $t2 = strtoupper(RemoveSign::removeSign($t2));
        similar_text($t1, $t2, $per);
        return $per;
    }

    public static function searchObject($query, $limit = 0, $offset = 0) {
        $client = new Client(\Yii::$app->params['solr']['song']);
        $exec = $client->createQuery($client::QUERY_SELECT);
        $exec->setQuery($query);
        if ($limit) {
            $exec->setRows($limit);
        }
        if ($offset) {
            $exec->setStart($offset);
        }
        $resultset = $client->execute($exec);
        $data['full_items'] = array();
        foreach ($resultset as $document) {
            $data['full_items'][] = $document;
        }
        $data['total'] = $resultset->getNumFound();
        return $data;
    }

    public static function searchDismax($filterQueries, $pageLimit = 1, $pageNumber = 1) {

        $client = new Client(\Yii::$app->params['solr']['rbt']);
        $query = $client->createSelect();
        $dismax = $query->getDisMax();
        $dismax->setQueryFields("huawei_tone_name^3 huawei_singer_name");
        $dismax->setPhraseFields("huawei_tone_name^6 huawei_singer_name^3");
        $dismax->setTie(0.1);

        $query->setQuery($filterQueries);
        if ($pageLimit) {
            $query->setRows($pageLimit);
        }
        if ($pageNumber) {
            $query->setStart($pageNumber);
        }

        $resultset = $client->select($query);
        $data = array();
        foreach ($resultset as $document) {
            $data['full_items'][] = $document;
        }
        $data['total'] = $resultset->getNumFound();
        return $data;
    }

    public static function searchDismaxSong($filterQueries, $limit = 1, $offset = 0) {
        $client = new Client(\Yii::$app->params['solr']['song']);
        $query = $client->createSelect();
        $dismax = $query->getDisMax();
//        $dismax->setQueryFields("song_name");// khong danh trong so
        $dismax->setQueryFields("song_name");
//        $dismax->setPhraseFields("song_name");
//        $dismax->setQueryFields("song_name^3 singer_alias_song");
//        $dismax->setPhraseFields("song_name^6 singer_alias_song^3");
        $dismax->setTie(0.1);

        $query->setQuery($filterQueries);

        if ($limit) {
            $query->setRows($limit);
        }
        if ($offset) {
            $query->setStart($offset);
        }

        $resultset = $client->select($query);


        $data = array();
        foreach ($resultset as $document) {
            $data['full_items'][] = $document;
        }
        $data['total'] = $resultset->getNumFound();

        return $data;
    }

    public static function searchDismaxVideo($filterQueries, $limit = 1, $pageNumber = 0) {

        $client = new Client(\Yii::$app->params['solr']['song']);
        $query = $client->createSelect();
        $dismax = $query->getDisMax();
        $dismax->setQueryFields("video_name^3 singer_alias_video");
        $dismax->setPhraseFields("video_name^6 singer_alias_video^3");
        $dismax->setTie(0.1);

        $query->setQuery($filterQueries);
//        $query->setRows($pageLimit*$pageNumber);
        if ($limit) {
            $query->setRows($limit);
        }
        if ($pageNumber) {
            $query->setStart($limit * $pageNumber);
        }

        $resultset = $client->select($query);
        $data = array();
        foreach ($resultset as $document) {
            $data['full_items'][] = $document;
        }
        $data['total'] = $resultset->getNumFound();
        return $data;
    }

    public static function searchDismaxAlbum($filterQueries, $limit = 1, $pageNumber = 0) {

        $client = new Client(\Yii::$app->params['solr']['song']);
        $query = $client->createSelect();
        $dismax = $query->getDisMax();
        $dismax->setQueryFields("album_name^3 singer_alias_album");
        $dismax->setPhraseFields("album_name^6 singer_alias_album^3");
        $dismax->setTie(0.1);

        $query->setQuery($filterQueries);
//        $query->setRows($pageLimit*$pageNumber);
        if ($limit) {
            $query->setRows($limit);
        }
        if ($pageNumber) {
            $query->setStart($limit * $pageNumber);
        }

        $resultset = $client->select($query);
        $data = array();
        foreach ($resultset as $document) {
            $data['full_items'][] = $document;
        }
        $data['total'] = $resultset->getNumFound();
        return $data;
    }

    public static function searchDismaxSinger($filterQueries, $limit = 1, $pageNumber = 0) {

        $client = new Client(\Yii::$app->params['solr']['song']);
        $query = $client->createSelect();
        $dismax = $query->getDisMax();
        $dismax->setQueryFields("alias");
        $dismax->setTie(0.1);

        $query->setQuery($filterQueries);
//        $query->setRows($pageLimit*$pageNumber);
        if ($limit) {
            $query->setRows($limit);
        }
        if ($pageNumber) {
            $query->setStart($limit * $pageNumber);
        }

        $resultset = $client->select($query);
        $data = array();
        foreach ($resultset as $document) {
            $data['full_items'][] = $document;
        }
        $data['total'] = $resultset->getNumFound();
        return $data;
    }

    public static function searchDismaxSongName($filterQueries, $limit = 1, $offset = 0) {

        $client = new Client(\Yii::$app->params['solr']['song']);
        $query = $client->createSelect();
        $dismax = $query->getDisMax();
        $dismax->setQueryFields("song_namevn^3 song_name");
        $dismax->setPhraseFields("song_namevn^6 song_name^3");
        $dismax->setTie(0.1);

        $query->setQuery($filterQueries);

        if ($limit) {
            $query->setRows($limit);
        }
        if ($offset) {
            $query->setStart($offset);
        }

        $resultset = $client->select($query);

//        var_dump($dismax);
        $data = array();
        foreach ($resultset as $document) {
            $data['full_items'][] = $document;
        }
        $data['total'] = $resultset->getNumFound();

        return $data;
    }

    public static function searchDismaxSongNameRBT($filterQueries, $limit = 1, $offset = 0) {

        $client = new Client(\Yii::$app->params['solr']['song']);
        $query = $client->createSelect();
        $dismax = $query->getDisMax();
        $dismax->setQueryFields("huawei_tone_name");
//        $dismax->setPhraseFields("huawei_tone_name");
        $dismax->setTie(0.1);

        $query->setQuery($filterQueries);

        if ($limit) {
            $query->setRows($limit);
        }
        if ($offset) {
            $query->setStart($offset);
        }

        $resultset = $client->select($query);


        $data = array();
        foreach ($resultset as $document) {
            $data['full_items'][] = $document;
        }
        $data['total'] = $resultset->getNumFound();

        return $data;
    }

}
