<?php

return [
    'encoder' => 'ffmpeg',

    'ffmpeg' => [
        'path' => '/usr/bin/ffmpeg',
        'codecs' => [
            'video' => 'libx264',
            'audio' => 'aac',
        ],
        'options' => [
            'strict' => true,
            'replace' => true,
            'fork' => true,
            'log' => storage_path(),
        ]
    ]
];