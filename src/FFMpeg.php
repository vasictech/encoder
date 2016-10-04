<?php

namespace VasicTech\Encoder;

class FFMpeg extends Encoder
{
    public function build()
    {
        $config = config('encoder.ffmpeg');

        $this->encoder = 'ffmpeg';
        $this->config = $config;
        $this->path = $config['path'];

        if (empty($this->vcodec) || empty($this->acodec)) {
            $this->codecs();
        }

        if (!$this->strict) {
            $this->strict();
        }

        if (!$this->replace) {
            $this->replace();
        }

        $this->command = $this->path.' -i '.$this->input.' -c:v '.$this->vcodec.' -c:a '.$this->acodec;

        if(!empty($this->vbitrate)) {
            $this->command .= ' -b:v '.$this->vbitrate;
        }

        if (!empty($this->abitrate)) {
            $this->command .= ' -b:a '.$this->abitrate;
        }

        if (!empty($this->width) || !empty($this->height)) {
            $width = !empty($this->width) ? $this->width : '-1';
            $height = !empty($this->height) ? $this->height : '-1';

            $this->command .= " -vf scale=$width:$height";
        }

        if (!empty($this->replace)) {
            $this->command .= ' -y';
        }
        if ($this->strict) {
            $this->command .= ' -strict -2 ';
        }

        if (!empty($this->format)) {
            $this->command .= ' -f '.$this->format;
        }

        $this->command .= ' '.$this->output;
    }
}
