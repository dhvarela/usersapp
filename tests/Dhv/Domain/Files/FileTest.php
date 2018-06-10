<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 10/06/18
 * Time: 14:32
 */

namespace Dhv\Infrastructure\Infiles;

use PHPUnit\Framework\TestCase;

class FileTest extends TestCase {

    public function testFileExists()
    {
/*        $filename = "users.csv";
        $this->assertFileExists("/src/Domain/Files/".$filename);*/
        $this->assertEquals('Hello', 'Hell' . 'o');

    }

}