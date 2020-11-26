<?php

function checkDocument($user, $document)
{
    return ($user == $document) ? 'selected' : '';
}

function isFirst($num)
{
    return ($num == 1) ? 'active' : '';
}
