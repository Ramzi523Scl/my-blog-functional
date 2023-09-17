<?php
function definePostTable(string $publicOrDraft): string
{
    return ($publicOrDraft === 'public') ? 'public_posts' : 'not_public_posts';
}