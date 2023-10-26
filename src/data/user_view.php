<?php
$db = include(__DIR__ . '/../database/connect_db.php');
include(__DIR__ . '/../database/queriesToDB.php');
include(__DIR__ . '/../function/getSegmentsFromURL.php');
include(__DIR__ . '/../function/goToPage.php');
include(__DIR__ . '/../function/checkAccessToThisPage.php');
include(__DIR__ . '/../function/generateMenu.php');
session_start();

$nick = ($_GET['nick']) ?: $_SESSION['another-nick'];

$userID = readDataToDB($db, 'users_login', ["id"], ['nickname' => $nick]);
$userID = $userID['id'];

$requiredColumns = ['firstname', 'lastname', 'birthday', 'gender'];
$userInfo = readDataToDB($db, 'users_info', $requiredColumns, ['user_login_id' => $userID]);
$userInfo['nick'] = $nick;

$posts = readDataToDB($db, 'public_posts', ['*'], ['author_id' => $userID], true);
$userInfo['posts'] = $posts;
$userInfo['count-posts'] = count($posts);

$menuInfo = [
    ['name' => 'Профиль', 'link' => 'http://my-blog2/src/data/user_view.php/profile', 'active' => false],
    ['name' => 'Публикации', 'link' => 'http://my-blog2/src/data/user_view.php/publications', 'active' => false],
    ['name' => 'Комментарии', 'link' => 'http://my-blog2/src/data/user_view.php/comments', 'active' => false],
    ['name' =>'Друзья', 'link' =>'http://my-blog2/src/data/user_view.php/friends', 'active' => false]
];

$d = getSegmentsFromURL();
$layout = getLayoutBlock($userInfo, $menuInfo, $d);
$_SESSION['layout'] = $layout;

if(checkAccessToThisPage(['index'])) {
    $_SESSION['another-nick'] = $nick;

}
if(checkAccessToThisPage(['user_view'])) {


}
goToPage('user_view');


function getLayoutBlock(array $userInfo, array $menuInfo, string $nameBlock = 'profile'): string
{
    ['firstname' => $firstName, 'lastname' => $lastName, 'birthday' => $birthday, 'gender' => $gender, 'nick' => $nick, 'posts' => $posts, 'count-posts' => $countPosts] = $userInfo;
    $fullName = ($firstName || $lastName) ?  "$firstName $lastName": 'Неуказан';
    $birthday = ($birthday) ? : 'Неуказан';
    $gender = ($gender === 'male') ? 'Мужской' : 'Женский';

    $layout = '';
    if($nameBlock === 'publications') {
        $menuInfo[1]['active'] = true;
        $layout .= "<div class='user__menu user__item'>" . generateMenu($menuInfo) . "</div>";
        $layout .= " <div class='user__post user__item'>Количество постов: $countPosts</div>";

        foreach ($posts as $post) {
            $id = $post['id'];
            $date = $post['post_date'];
            $name = $post['name'];
            $description = $post['description'];
            $image = $post['image'];

            $layout .= "<div class='user__post user__item'>
                   <div class='posts__post post p-1'>
                    <div class='post__item post__author'>
                        <img class='post__ava' src='http://my-blog2/src/images/ava.svg' height='23' alt=''>
                        <a class='post__nick' href='#'>$nick</a>
                        <i class='post__date'>$date</i>
                    </div>
                        <div class='post__item d-flex '>
                            <div class='post__text'>
                                <div class='post__title'>$name</div>
                                <div class='post__description'>$description</div>
                            </div >
                            <div class='post_image'>
                                <div class='post__img'><img class='img-fluid' src='http://my-blog2/src/images/$image' alt=''></div>  
                            </div>
                    </div>
                    <a class='post__btn post__item' href='http://my-blog2/src/pages/read_post.php?id=$id'>Открыть</a>
                </div>
            </div>";
        }

    }
    elseif($nameBlock === 'comments') {
        $menuInfo[2]['active'] = true;
        $layout .= "<div class='user__menu user__item'>" . generateMenu($menuInfo) . "</div>";
        $layout .= " <div class='user__comments user__item'>Количество комментов: Неизвестно</div>";

    }
    elseif($nameBlock === 'friends') {
        $menuInfo[3]['active'] = true;
        $layout .= "<div class='user__menu user__item'>" . generateMenu($menuInfo) . "</div>";
        $layout .= " <div class='user__friends user__item'>Количество друзей: Неизвестно</div>";

    }
    else {
        $menuInfo[0]['active'] = true;

        $layout .= "<div class='user__menu user__item'>" . generateMenu($menuInfo) . "</div>";
        $layout .= "
            <div class='user__profile user__item'>
                <b>ФИО</b>
                <p>$fullName</p>
                <b>Дата рождения</b>
                <p>$birthday</p>
                <b>Пол</b>
                <p>$gender</p>
                <b>Дата регистрации</b>
                <p>Неизвестно</p>
                <b>Последний раз в онлайн</b>
                <p>Сейчас</p>
            </div>";
    }

    return $layout;
}