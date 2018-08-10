<?php

namespace Dhv\Domain\Services;

use Dhv\Domain\Model\User\ModelUser;
use PHPUnit\Framework\TestCase;

class FileOperationsTest extends TestCase {

    /**
     * @dataProvider getFileUrl
     */
    public function testFileOperationsService($fileUrl)
    {
        $fileOps = new FileOperations($fileUrl);
        $fileOps->openFile();

        $this->assertTrue($fileOps->hasFile());
        $this->assertEquals($fileUrl,$fileOps->fileUrl());
        $this->assertNotFalse($fileOps->file());
        $fileOps->closeFile();

    }

    /**
     * @dataProvider getFileUrl
     */
    public function testHasNotFileOperationsService($fileUrl)
    {
        $fileOps = new FileOperations($fileUrl."extraUrl");
        $fileOps->openFile();

        $this->assertFalse($fileOps->hasFile());

        if ($fileOps->hasFile()) {
            $fileOps->closeFile();
        }

    }

    /**
     * @dataProvider getFileUrl
     */
    public function testCloseFile($fileUrl)
    {
        $fileOps = new FileOperations($fileUrl);
        $fileOps->openFile();
        $fileOps->closeFile();

        $this->assertFalse($fileOps->file());
    }

    /**
     * @dataProvider getFileUrl
     */
    public function testOpenToWriteFile($fileUrl)
    {
        $fileOps = new FileOperations($fileUrl);
        $fileOps->openToWriteFile();

        $this->assertTrue($fileOps->hasFile());

        // rewrite csv file
        $users = [
            ['alfa@mailinator.com','123456'],
            ['bravo@mailinator.com','123qwe'],
            ['charlie@mailinator.com','poipoi']
        ];

        foreach ($users as $user) {
            $fileOps->writeFile([$user[0], $user[1]]);
        }

        $fileOps->closeFile();
    }

    public function getFileUrl()
    {
        $ff = new FileFinder();
        $fileUrl = $ff->findFile($ff->filename());
        yield [$fileUrl];
    }

    /**
     * @dataProvider getFileUrl
     */
    public function testWriteFile($fileUrl)
    {
        $fileOps = new FileOperations($fileUrl);
        $fileOps->openToWriteFile();

        // rewrite csv file
        $users = [
            ['alfa@mailinator.com','123456'],
            ['bravo@mailinator.com','123qwe'],
            ['charlie@mailinator.com','poipoi']
        ];

        foreach ($users as $user) {
            $writted = $fileOps->writeFile([$user[0], $user[1]]);
            $this->assertNotFalse($writted);
            $this->assertNotNull($writted);
        }

        $fileOps->closeFile();
    }

    /**
     * @dataProvider getFileUrl
     */
    public function testReadingFile($fileUrl)
    {
        $fileOps = new FileOperations($fileUrl);
        $fileOps->openFile();

        $this->assertTrue($fileOps->hasFile());
        $data = $fileOps->readFile();

        $this->assertNotFalse($data);
        $this->assertEquals(2,count($data));
        $fileOps->closeFile();
    }
}