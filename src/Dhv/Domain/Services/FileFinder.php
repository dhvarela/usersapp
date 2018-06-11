<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 10/06/18
 * Time: 18:51
 */

namespace Dhv\Domain\Services;

class FileFinder
{
    const DS = DIRECTORY_SEPARATOR;
    const FILENAME = "users.csv";

    private $filename;

    public function __construct()
    {
        $this->filename = self::FILENAME;
    }

    /**
     * @param string $filename
     */
    public function findFile(string $filename)
    {
        $file = __DIR__ . self::DS . ".." . self::DS . ".." . self::DS . "Infrastructure" . self::DS .
            "Persistence" . self::DS . "InFiles" . self::DS . $filename;
        return file_exists($file) ? $file : false;
    }

    public function filename()
    {
        return $this->filename;
    }
}