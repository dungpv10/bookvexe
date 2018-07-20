<?php

namespace App\Helpers;


use Illuminate\Http\UploadedFile;

class Upload
{
    protected $file;
    protected $path;
    protected $fileName;
    public function __construct(UploadedFile $file, $path, $fileName = [])
    {
        $this->file = $file;
        $this->path = $path;
        $this->fileName = $fileName;
    }

    private function generateFileName()
    {
        return (!$this->fileName ? $this->file->getClientOriginalName() : str_slug(implode('-', $this->fileName))) . '.' . $this->getExtension();
    }

    private function getExtension(){
        return $this->file->getClientOriginalExtension();
    }


    public function upload()
    {
        $fileName = $this->generateFileName();
        $this->file->move(public_path($this->path), $fileName);
        return $this->path . '/' .$fileName;
    }
}

