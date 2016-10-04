#Laravel Encoder (Alpha) 1.0

[![Build Status](https://travis-ci.org/vasictech/encoder.svg?branch=master)](https://travis-ci.org/vasictech/encoder)

An OOP Laravel package user for encoding video files with [FFMPEG](https://www.ffmpeg.org/)

Package is currently in Alpha stage, with small amount of functions, and it will be constanly upgrade with a lot different features

This library requires a working FFMpeg install.

## Installation

The recommended way to install Encoder is through [Composer](https://getcomposer.org).

```json
{
    "require": {
        "vasictech/encoder": "~1.0"
    }
}
```
 
Register package as service in config/app.php

```php
return [
    VasicTech\Encoder\EncoderServiceProvider::class,
]
```

Execute config publish

```php
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
```

Configure config file

```php
return [
    VasicTech\Encoder\EncoderServiceProvider::class,
]
```

## Basic Usage

```php
$encoder = VasicTech\Encoder\Encoder\FFMpeg();
$jobId = $encoder
    ->input(storage_path('app/public/trailer.mp4'))
    ->output(storage_path('app/public/trailer_enc.mp4'))
    ->execute();
```

Script returns jobID which can be recorded in database to be connected with files. Output log file will be named as jobID

## Documentation


## Codec
You can provide both, or just one parameter, first is video codec, second is audio codec

```php
$encoder->codecs('libx264', 'libfaac');
```

## Bitrate
You can provide both, or just one parameter, first is video bitrate, second is audio bitrate

```php
$encoder->bitrate('1200k', '128k');
```

## Size
You can provide both, or just one parameter, first is video width, second is video height, if one is not provided, video will scale to provided size

```php
$encoder->size(1280, 720);
```

## Replace
If ffmpeg should replace already existing file

```php
$encoder->replace(true);
```

## Strict
If '-strict -2' parameter should be added

```php
$encoder->strict(true);
```

## Fork
If process should be forked

```php
$encoder->fork(true);
```

## Log
If ffmpeg should write to log file

```php
$encoder->log('/path/to/file.log');
```

## Format
Force output format

```php
$encoder->format('mp4');
```

## License

This project is licensed under the [MIT license](http://opensource.org/licenses/MIT).
