<?php 

function checkDocument($user, $document){
    return ($user == $document) ? 'selected' : '';
}