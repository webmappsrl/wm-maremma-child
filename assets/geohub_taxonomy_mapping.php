<?php

function geohub_taxonomy_mapping($taxonomy_name) {
    $mapping = $array = [
        'a piedi' => '1',
        'tours on foot' => '1',
        'in bicicletta' => '2',
        'a cavallo' => '3'
    ];
    return $mapping[$taxonomy_name];
}