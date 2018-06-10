<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 10/06/18
 * Time: 14:12
 */

namespace Dhv\Domain\Services;

use Dhv\Domain\Services\FileFinder;
use PHPUnit\Framework\TestCase;

class FileFinderTest extends TestCase {

    public function testFileExists() {

        $fileFinder = new FileFinder();

        $filename = 'users.csv';

        $this->assertFileExists($fileFinder->findFile($filename));
    }

    public function testFileNotExists() {

        $fileFinder = new FileFinder();

        $filename = 'abc.csv';

        $this->assertFalse($fileFinder->findFile($filename));
    }

    public function testFilenameInConstruction() {

        $fileFinder = new FileFinder();

        $filename = 'users.csv';

        $this->assertEquals($filename, $fileFinder->filename());
    }

}