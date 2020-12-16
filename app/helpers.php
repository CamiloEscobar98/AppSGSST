<?php

function checkDocument($user, $document)
{
    return ($user == $document) ? 'selected' : '';
}

function isFirst($num)
{
    return ($num == 1) ? 'active' : '';
}

function checkInput($role)
{
    switch ($role) {
        case 'capacitador':
            return '';
            break;
        case 'capacitante':
            return 'readonly';
            break;
        default:
            return '';
            break;
    }
}
function checkColGame($role)
{
    switch ($role) {
        case 'capacitador':
            return 'col-md-6';
            break;
        case 'capacitante':
            return 'col-md-10';
            break;
        default:
            return 'col-md-6';
            break;
    }
}

function checkColTopic($role)
{
    switch ($role) {
        case 'capacitador':
            return 'col-md-7';
            break;
        case 'capacitante':
            return 'col-md-8';
            break;
        default:
            return 'col-md-7';
            break;
    }
}
function checkColCapsule($role)
{
    switch ($role) {
        case 'capacitador':
            return 'col-xl-8';
            break;
        case 'capacitante':
            return 'col-xl-12';
            break;
        default:
            return 'col-xl-8';
            break;
    }
}

function returnCompleted($role)
{

    if ($role == 1) {
        return "<p class = 'bg-success  my-0 px-2 text-white font-weight-bold'>Completado</p>";
    } else {
        return "<p class = 'bg-danger py-1 my-0 px-2 text-white font-weight-bold'>No completado</p>";
    }
}
function isCompleted($topic)
{
    $user = \App\User::find(Auth()->user()->id);
    $topic = $user->myTopics()->where('title', $topic->title)->get()->first();
    if ($topic) {
        if ($topic->pivot->completed == 1) {
            return "<p class = 'bg-success py-1 my-0 px-2 text-white font-weight-bold'>Completado</p>";
        } else {
            return "<p class = 'bg-danger py-1 my-0 px-2 text-white font-weight-bold'>No completado</p>";
        }
    }
}
function completeTopics($id)
{
    $user = \App\User::find($id);
    return $user->completeTopics();
}
