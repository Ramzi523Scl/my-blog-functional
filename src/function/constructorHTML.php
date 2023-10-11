
<?php

function create_tag(string $tag, string $class = "", bool $isTagPaired = true): callable
{
    $designerTag = function(string $content = '', string $newClass = '', string $otherAttributes = '') use ($isTagPaired, $tag, $class): string
    {
        $updateClass = 'class="' . $class . ' ' . $newClass . '"';

        $finalTag = "<$tag $updateClass $otherAttributes";
        $endTag = '/>';

        if (!$isTagPaired) $finalTag .= 'value="' . $content . '"';
        else $endTag = ">$content</$tag>";

        $finalTag .= $endTag;
        return $finalTag;
    };
    return $designerTag;
}
