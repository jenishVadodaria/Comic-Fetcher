<?php

function comic_data()
{
    $max_number = max_number();
    $xkcd_url = 'https://xkcd.com/' . rand(1, $max_number) . '/info.0.json';

    $data = file_get_contents($xkcd_url);
    if ($data == true) {
        return $data;
    }
    return false;
}

function max_number()
{
    $data = file_get_contents('https://xkcd.com/info.0.json');
    $comic_data = json_decode($data);

    return $comic_data->num;
}
