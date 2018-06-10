<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 10/06/18
 * Time: 14:12
 */

namespace Dhv\Infrastructure\InFiles;

use Dhv\Domain\Services\FileFinder;
use PHPUnit\Framework\TestCase;

class FilesTest extends TestCase {

    public function testFileExists() {

        $fileFinder = new FileFinder();

        $filename = 'users.csv';

        $this->assertEquals(true, $fileFinder->findFile($filename));
        //$this->assertFileExists("/src/Domain/Files/".$filename);
    }

}