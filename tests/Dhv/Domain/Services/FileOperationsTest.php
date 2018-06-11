<?php

namespace Dhv\Domain\Services;

use PHPUnit\Framework\TestCase;

class FileOperationsTest extends TestCase {

    public function testFileOperationsService()
    {
        $ff = new FileFinder();
        $fileUrl = $ff->findFile($ff->filename());

        $fileOps = new FileOperations($fileUrl);
        $fileOps->openFile();

        $this->assertTrue($fileOps->hasFile());
        $this->assertEquals($fileUrl,$fileOps->fileUrl());
        $this->assertNotFalse($fileOps->file());
    }

}