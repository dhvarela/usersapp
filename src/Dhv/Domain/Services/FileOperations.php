<?php

namespace Dhv\Domain\Services;

class FileOperations
{
    /**
     * @file
     */
    private $file;

    /**
     * @string
     */
    private $fileUrl;

    public function __construct(string $fileUrl)
    {
        $this->setFileUrl($fileUrl);
    }

    /**
     * @param string $fileUrl
     */
    private function setFileUrl($fileUrl)
    {
        $this->fileUrl = $fileUrl;
    }

    public function readFile()
    {
        return fgetcsv($this->file, 0, ";");
    }

    public function writeFile($row)
    {
        return fputcsv($this->file,$row,";");
    }

    public function openFile()
    {
        $this->file = fopen($this->fileUrl, "r");
    }

    public function openToWriteFile()
    {
        $this->file = fopen($this->fileUrl, 'w+');
    }

    public function closeFile()
    {
        if (fclose($this->file)) {
            $this->file = false;
        }
    }

    public function file()
    {
        return $this->file;
    }

    public function fileUrl()
    {
        return $this->fileUrl;
    }

    public function hasFile()
    {
        return $this->file() ? true : false;
    }


}