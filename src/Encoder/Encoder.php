<?php

namespace VasicTech\Encoder\Encoder;

abstract class Encoder {
    public $path;
    public $encoder;
    public $config;
    public $vcodec;
    public $acodec;
    public $vbitrate;
    public $abitrate;
    public $replace;
    public $input;
    public $output;
    public $width;
    public $height;
    public $format;
    public $command;
    public $strict;
    public $fork;
    public $log;

    public function codecs($video = null, $audio = null){
        $this->vcodec = $video ? $video : $this->config['codecs']['video'];
        $this->acodec = $audio ? $audio : $this->config['codecs']['audio'];

        return $this;
    }

    public function bitrate($video = null, $audio = null){
        $this->vbitrate = $video ? $video : isset($this->config['bitrate']['video']) ? $this->config['bitrate']['video'] : '';
        $this->abitrate = $audio ? $audio : isset($this->config['bitrate']['audio']) ? $this->config['bitrate']['audio'] : '';

        return $this;
    }

    public function replace($bool = null){
        $this->replace = $bool ? $bool : $this->config['options']['replace'];

        return $this;
    }

    public function strict($bool = null){
        $this->strict = $bool ? $bool : $this->config['options']['strict'];

        return $this;
    }

    public function fork($bool = null){
        $this->fork = $bool ? $bool : $this->config['options']['fork'];

        return $this;
    }

    public function log($path = null){
        $this->log = $path ? $path : $this->config['options']['log'];

        return $this;
    }

    public function format($format = null){
        $this->format = $format ? $format : $this->config['options']['format'];

        return $this;
    }

    public function input($path){
        $this->input = $path;

        return $this;
    }

    public function output($path){
        $this->output = $path;

        return $this;
    }

    public function size($width = null, $height = null){
        $this->width = $width ? $width : $this->config['size']['width'];
        $this->height = $height ? $height : $this->config['size']['height'];

        return $this;
    }

    abstract function build();

    private function jobId(){
        return md5(time().config('app.key'));
    }

    public function execute(){
        set_time_limit(0);

        $this->build();

        if(!$this->fork) {
            $this->fork();
        }

        if(!$this->log) {
            $this->log();
        }

        $jobId = $this->jobId();

        if($this->fork) {
            if(!empty($this->log)) {
                $this->command = 'nohup '.$this->command.' >'.$this->log.'/'.$jobId.' 2>&1 &';
            } else {
                $this->command = 'nohup '.$this->command.' >/dev/null 2>&1 &';
            }
        }

        exec($this->command);

        return $jobId;
    }
}