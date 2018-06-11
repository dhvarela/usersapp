<?php

use Dhv\Domain\Services\FileFinder;
use Dhv\Domain\Model\User\ModelUser;
use Dhv\Domain\Services\FileOperations;
use Dhv\Infrastructure\Persistence\InMemory\User\InMemoryUserRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$ff = new FileFinder();

$fileUrl = $ff->findFile($ff->filename());

$fileOps = new FileOperations($fileUrl);
$fileOps->openFile();

if ($fileOps->hasFile()) {

    $searchEmail = isset($argv[1]) ? $argv[1] : 'bravo@mailinator.com';
    $searchPass = isset($argv[2]) ? $argv[2] : '2133455';

    $userRepository = new InMemoryUserRepository();

    while (($datos = $fileOps->readFile()) !== FALSE) {
        $user = new ModelUser($datos[0], $datos[1]);
        $userRepository->addUser($user);
    }

    if ($userRepository->findByEmail($searchEmail)) {
        echo "User exists \n";
    } else {
        echo "User doesn't exist \n";
    }

    if ($userRepository->findByEmailAndPass($searchEmail, $searchPass)) {
        echo "User pass correct \n";
    } else {
        echo "The user pass is incorrect\n";
    }
} else {
    echo "The file doesn't exist";
}


