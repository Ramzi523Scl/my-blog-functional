
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>

        .my__btns {
            padding: 0 20px;
        }
        .my__btn {
            margin-right: 5px;
        }
    </style>

<?php
include("../function/constructorHTML.php");

function Buttons(array $buttons, string $buttonType, array $buttonLinks = [])
{
    $buttonText = [
        'clear' => 'Очистить',
        'delete' => 'Удалить',
        'edit' => 'Редактировать',
        'save' => 'Сохранить',
        'publish' => 'Опубликовать',
    ];
    $buttonClass = [
        'clear' => 'btn-danger',
        'delete' => 'btn-danger',
        'edit' => 'btn-info',
        'save' => 'btn-warning',
        'publish' => 'btn-success',
    ];


    $create_div = create_tag('div');


    if ($buttonType === 'a') {
        $create_button = create_tag('a', 'my__btn btn');
        $otherAttributes = 'role="button"';
    }
    else {
        $create_button = create_tag('input','my__btn btn', false);
        $otherAttributes = 'type="submit"';
    }


    $entire_layout = '';
    $divCount = count($buttons);

    for($i = 0; $i < $divCount; $i++) {
        $button_layout = '';

        foreach ($buttons[$i] as $button) {

            $newAttributes = '';
            if ($buttonType === 'a' && $buttonLinks) {
                $href = 'href="' . $buttonLinks[$button] . '"';
                $newAttributes .= $href;
            }
            if ($buttonType === 'input') {
                $inputName = 'name="' . "$button" . '"';
                $newAttributes .= $inputName;
            }

            $button_layout .= $create_button($buttonText[$button], $buttonClass[$button], "$otherAttributes $newAttributes");
        }
        $entire_layout .= $create_div($button_layout);
    }

    $div_content = $create_div($entire_layout, 'my__btns d-flex justify-content-between');
    echo $div_content;
}