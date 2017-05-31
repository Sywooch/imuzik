<?php

namespace frontend\controllers;

use common\libs\Search;
use common\models\TopicBase;
use common\models\TopicSongBase;
use common\models\VtFavouriteSongJoinBase;
use common\models\VtSongBase;
use frontend\models\Member;
use frontend\models\VtSong;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\UploadedFile;
use common\libs\CrbtService;

/**
 * Ajax controller
 */
class AjaxController extends AppController {

    public function actionAvatar() {
        $this->layout = false;
        if ($post = \Yii::$app->request->post()) {
            $attr = $post['attr'];
            $width = $post['width'];
            $height = $post['height'];
            $title = $post['title'];
            $member = \Yii::$app->user->identity;
            $fileUpload = new UploadedFile();
            $fileUpload->name = $_FILES['file']['name'];
            $fileUpload->tempName = $_FILES['file']['tmp_name'];
            $fileUpload->type = $_FILES['file']['type'];
            $fileUpload->size = $_FILES['file']['size'];
            $fileUpload->error = $_FILES['file']['error'];
            $member->$attr = $fileUpload;
            if ($file = $member->upload($attr, $width, $height)) {
                $member->$attr = $file;
                if ($member->save(false, [$attr])) {
                    echo json_encode(['error' => 0, 'message' => $member->getAvatar()]);
                    die;
                }
            } else {
                echo json_encode(['error' => 1, 'message' => $member->getErrors()[$attr][0]]);
                die;
            }
        }
        echo json_encode(['error' => 1, 'message' => 'Có lỗi xảy ra! Vui lòng thực hiện lại sau ít phút!']);
        return;
    }

    public function actionSongLike($id) {
        $this->layout = false;
        if (\Yii::$app->user->getId()) {
            $song = \frontend\models\VtSong::getOneById($id);
            if ($song) {
                $liked = \frontend\models\VtFavouriteSongJoin::find()->where(['song_id' => $id, 'member_id' => \Yii::$app->user->getId()])->one();
                if ($liked) {
                    $liked->delete();
                    echo 2;
                    die;
                }
                $like = new \frontend\models\VtFavouriteSongJoin();
                $like->song_id = $id;
                $like->member_id = \Yii::$app->user->getId();
                $like->created_at = new \yii\db\Expression('now()');
                $like->updated_at = new \yii\db\Expression('now()');
                $like->save(false);
                echo 1;
                die;
            }
            echo 0;
            die;
        }
    }

    public function actionRbtLike($id) {
        $this->layout = false;
        if (\Yii::$app->user->getId()) {
            $song = \frontend\models\VtRingBackTone::findOne(['id' => intval($id)]);
            if ($song) {
                $liked = \frontend\models\VtFavouriteRbtJoin::find()->where(['rbt_id' => $id, 'member_id' => \Yii::$app->user->getId()])->one();
                if ($liked) {
                    $liked->delete();
                    echo 2;
                    die;
                }
                $like = new \frontend\models\VtFavouriteRbtJoin();
                $like->rbt_id = $id;
                $like->member_id = \Yii::$app->user->getId();
                $like->created_at = new \yii\db\Expression('now()');
                if ($like->save(false)) {
                    $song->like_number = $song->like_number + 1;
                    $song->save(false, ['like_number']);
                    echo 1;
                    die;
                }
            }
            echo 0;
            die;
        }
    }

    public function actionGetDown() {
        $this->layout = false;
        $type = intval($_GET['type']);
        $data = null;
        switch ($type) {
            case 1:
                $data = \frontend\models\VtRingBackTone::getTopDownMonth();
                break;
            case 2:
                $data = \frontend\models\VtRingBackTone::getDownNow(20);
                break;
            case 3:
                $data = \frontend\models\VtRingBackTone::getTopFree();
                break;
        }
        $html = '';
        $count = 1;
        foreach ($data as $item) {
            $song = $item->song;
            $slug = \yii\helpers\Html::encode($song->slug);
            $name = \yii\helpers\Html::encode($song->name);
            $html .= '<div class="media">
                        <div class="media-left">
                            <a href="/bai-hat/' . $slug . '">
                                <img class="media-object" src="" width="48" alt="...">
                            </a>
                        </div>
                        <div class="media-body">
                            <a href="/bai-hat/' . $slug . '" class="song-name ellipsis">' . $name . '</a>
                            <p class="singer-name ellipsis"><a href="javascript:void(0);"></a></p>
                        </div>
                        <div class="media-right text-danger">' . $count . '</div>
                    </div>';
            $count++;
        }

        echo $html;
        die;
    }

    public function actionSongOfCategory($id) {

        $page = \Yii::$app->request->get('page', 1);
        $this->layout = false;
        $categoryAreaVN = \frontend\models\VtMusicGenre::getCategoryArea($id);
        $areaVN = array();
        foreach ($categoryAreaVN as $k => $v) {
            $areaVN[':' . $k] = $v->id;
        }
        $categoryAreaSongVN = \frontend\models\VtSong::getCategoryAreaSongPage($id, $areaVN, song_page_limit);
        $pages = new Pagination(['totalCount' => $categoryAreaSongVN['total'], 'defaultPageSize' => song_page_limit]);
        $type = 1;

        foreach ($categoryAreaVN as $item) {
            $regions = $item->regions;
        }
        if ($regions == 1)
            $title = 'Việt Nam';
        if ($regions == 2)
            $title = 'Âu Mỹ';
        if ($regions == 3)
            $title = 'Châu Á';

        return $this->render('/ajax/song-of-category', [
                    'categoryAreaVN' => $categoryAreaSongVN['list'],
                    'pages' => $pages,
                    'page' => $page,
                    'type' => $type,
                    'title' => $title,
                    'slug' => $regions
        ]);
    }

    public function actionSongOfCategorySlug($slug) {

        $categoryAreaVN = \frontend\models\VtMusicGenre::getListIDFromSlug($slug);
        $page = \Yii::$app->request->get('page', 1);
        $this->layout = false;
        $areaVN = array();
        foreach ($categoryAreaVN as $k => $v) {
            $areaVN[':' . $k] = $v->id;
        }
        $categoryAreaSongSlug = \frontend\models\VtSong::getCategoryAreaSongPage($slug, $areaVN, song_page_limit);
        $pages = new Pagination(['totalCount' => $categoryAreaSongSlug['total'], 'defaultPageSize' => song_page_limit]);
        $type = 2;
        foreach ($categoryAreaVN as $item) {
            $title = $item->name;
        }
        return $this->render('/ajax/song-of-category', [
                    'categoryAreaSongSlug' => $categoryAreaSongSlug['list'],
                    'pages' => $pages,
                    'page' => $page,
                    'type' => $type,
                    'title' => $title,
                    'slug' => $slug
        ]);
    }

    public function actionSongYouLike() {
        $model = new Member();
        //default lấy danh sách nhạc yêu thích;
        //$id_member = Yii::$app->user->getId();
        $member = Yii::$app->user->identity;
        $id_member = $member->id;
        $page = \Yii::$app->request->get('page', 1);
        $this->layout = false;
        if (!$member)
            return $this->goHome();
        // lay song_id
        $data = VtFavouriteSongJoinBase::getListSongID($id_member);
        foreach ($data as $item) {
            $songId[] = $item->song_id;
        };
        $listSongYouLiked = VtSongBase::getListSongYouLiked($songId, song_page_limit);
        $pages = new Pagination(['totalCount' => $listSongYouLiked['total'], 'defaultPageSize' => song_page_limit]);

        if ($member->load(Yii::$app->request->post())) {
            $avatar = $_FILES["Member"]["name"]["image_path"];
            $member->image_path = \yii\web\UploadedFile::getInstance($member, 'image_path');
            $model->upload($avatar);
        }
        return $this->render('/ajax/song-you-like', [
                    'listSongYouLiked' => $listSongYouLiked['list'],
                    'member' => $member,
                    'pages' => $pages,
                    'page' => $page,
        ]);
    }

    public function actionTopicList() {
        $this->layout = false;
        $page = \Yii::$app->request->get('page', 1);
        $listTopic = TopicBase::getListTopic(film_rbt_list_limit);
        $pages = new Pagination(['totalCount' => $listTopic['total'], 'defaultPageSize' => song_page_limit]);
        return $this->render('/ajax/_item_topic_ajax', [
                    'rbtListFilm' => $listTopic['list'],
                    'pages' => $pages,
                    'page' => $page,
        ]);
    }

    public function actionTopicSongDetail($slug) {
        $this->layout = false;
        $page = \Yii::$app->request->get('page', 1);

        $query = TopicBase::find()->where(['slug' => $slug]);
//        var_dump($query->prepare(Yii::$app->db->queryBuilder)->createCommand()->rawSql);die();
        $topicDetail = $query->one();

        $queryTopicSong = TopicSongBase::find()->where(['topic_id' => $topicDetail->id])->all();

        foreach ($queryTopicSong as $item) {
            $songId[] = $item->song_id;
        }
        //ham lay ra danh sach nhac thuoc chu de
        $rbtListFilmHost = \frontend\models\VtSong::getListSongTopic($songId, song_page_limit);
        $pages = new Pagination(['totalCount' => $rbtListFilmHost['total'], 'defaultPageSize' => song_page_limit]);
        return $this->render('/ajax/_item_topic_detail_ajax', [
                    'topicDetail' => $topicDetail,
                    'rbtListFilmHost' => $rbtListFilmHost['list'],
                    'pages' => $pages,
                    'page' => $page,
                    'slug' => $slug
        ]);
    }

    public function actionSearch($k) {
        $limit = \Yii::$app->request->getQueryParam('page') * song_page_limit;
        $songs = Search::searchDismaxSongName($k, song_page_limit);
        $songid = array();
        foreach ($songs['full_items'] as $song) {
            $songid[] = $song->id;
        }

        if (count($songid) > 0) {
            $songs = VtSong::getListSongById($songid, song_page_limit);
        } else {
            $songs = array();
        }

        $pages = new Pagination(['totalCount' => $songs['total'], 'defaultPageSize' => song_page_limit]);
        $page = \Yii::$app->request->get('page', 1);
        $title = "Có " . $songs['total'] . " kết quả tìm kiếm với từ khóa: " . $k;
        return $this->render('/ajax/_item_search_ajax', [
                    'songs' => $songs['list'],
                    'k' => $k,
                    'pages' => $pages,
                    'page' => $page,
                    'title' => $title,
        ]);
    }

    public function actionCrbt() {
        $this->layout = false;
        try {
            $user = Yii::$app->user->identity;
            if ($user) {
                $check = CrbtService::checkStatusCRBT($user->phonenumber);
                if ($check['statusCRBT'] == 1) {
                    return 1;
                    \Yii::$app->end();
                } elseif ($check['statusCRBT'] == -1) {
                    return -1;
                    \Yii::$app->end();
                }
            }
        } catch (Exception $e) {
            return 0;
        }
        return 0;
        \Yii::$app->end();
    }

    public function actionRegister() {
        $this->layout = false;
        $user = \Yii::$app->user->identity;
        $isRegister = 0;
        if ($user) {
            $check = CrbtService::checkStatusCRBT($user->phonenumber);
            if ($check['statusCRBT'] == 1 || $check['statusCRBT'] == 2) {
                $isRegister = $check['statusCRBT'];
            }
        }
        if (Yii::$app->request->isPost && $user) {
            $brandID = Yii::$app->request->post('brand_id');
            if (!$isRegister) {
                $regRbt = CrbtService::subscribe($user->phonenumber, $brandID);
            } else {
                $regRbt = CrbtService::activeAndPauseService($user->phonenumber, '1');
            }
            \frontend\models\LogRbtService::write($user->id, $user->username, ACTION_REGISTER, $user->phonenumber, $regRbt['crbtReturnCode'], $brandID);
            if ($regRbt['resultCode'] == 0) {
                if (!$isRegister) {
                    echo \Yii::t('frontend', 'Đăng ký dịch vụ thành công!');
                } else {
                    echo \Yii::t('frontend', 'Kích hoạt dịch vụ thành công!');
                }
            } else {
                echo \Yii::t('frontend', 'Đăng ký dịch vụ thất bại, vui lòng thử lại sau!');
            }
            \Yii::$app->end();
        }
        \Yii::$app->end();
    }

    public function actionCheckLogin() {
        if (!Yii::$app->user->isGuest) {
            return 1;
        }
        return 0;
    }

}
