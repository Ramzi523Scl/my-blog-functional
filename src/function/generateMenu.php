<style>
    .list {
        margin: 0;
        padding: 0;
        display: flex;
    }

    .item {
        list-style-type: none;
        margin-right: 25px;

    }
    .link {
        color: black;
        text-decoration: none;
        cursor: pointer;
        font-size: 18px;
        padding-bottom: 11px;

    }
    .link:hover {
        color: #548EAA;
    }
    .active {
        color: #548EAA;
        border-bottom: 3px solid #548EAA;
    }
</style>

<?php
include(__DIR__ . '/constructorHTML.php');
function generateMenu(array $menuLinks)
{
    $create_nav = create_tag('nav');
    $create_ul = create_tag('ul');
    $create_li = create_tag('li');
    $create_a = create_tag('a');

    $list = '';

    for ($i = 0; $i < count($menuLinks); $i++) {

        $href = 'href=' . $menuLinks[$i]['link'];
        $class = 'link';
        if ($menuLinks[$i]['active']) $class .= ' active';

        $a = $create_a($menuLinks[$i]['name'], $class, $href);
        $li = $create_li($a, 'item');
        $list .= $li;
    }
    $ul = $create_ul($list, 'list');
    $nav = $create_nav($ul, 'menu');

    return $nav;
}
