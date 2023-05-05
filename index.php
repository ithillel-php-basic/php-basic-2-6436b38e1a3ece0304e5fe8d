<?php

require 'helpers.php';

print renderTemplate('layout.php',
    [
        'page_title' => 'Головна',
        'body_content' => 'main.php'
    ]
);