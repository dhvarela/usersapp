<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 10/06/18
 * Time: 22:01
 */

namespace Dhv\Infrastructure\Persistence\InMemory\User;

use Dhv\Domain\Services\FileFinder;
use PHPUnit\Framework\TestCase;

class InMemoryUserRepositoryTest extends TestCase
{

    public function testInMemoryUserRepository()
    {
        $ff = new FileFinder();
        $fileUrl = $ff->findFile($ff->filename());

        $inMemoryUserRepo = new InMemoryUserRepository($fileUrl);

        $inMemoryUserRepo->openFile();

        $this->assertEquals($fileUrl, $inMemoryUserRepo->fileUrl());
        $this->assertTrue($inMemoryUserRepo->hasFile());
        $this->assertNotFalse($inMemoryUserRepo->file());
    }

}