<?php

function route($path = '') {
    return rtrim(BASE_URL, '/') . '/' . ltrim($path, '/');
}

function asset($path = '') {
    return route('assets/' . ltrim($path, '/'));
}