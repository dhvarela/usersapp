<?php

use Dhv\Domain\Services\FileFinder;
use Dhv\Infrastructure\Persistence\InMemory\User\InMemoryUserRepository;
use Dhv\Domain\Model\User\ModelUser;

define('DS', DIRECTORY_SEPARATOR);
require_once __DIR__ . '/../vendor/autoload.php';

$ff = new FileFinder();

$fileUrl = $ff->findFile($ff->filename());

$userRepository = new InMemoryUserRepository($fileUrl);

$userRepository->openFile();

if ($userRepository->hasFile()) {
    while (($datos = fgetcsv($userRepository->file(), 255, ";")) !== FALSE) {
        $user = new ModelUser($datos[0], $datos[1]);
        $userRepository->addUser($user);
    }

    $searchEmail = isset($argv[1]) ? $argv[1] : 'bravo@mailinator.com';
    $searchPass = isset($argv[2]) ? $argv[2] : '2133455';

    if ($userRepository->findByEmail($searchEmail)) {
        echo "User exists \n";
    } else {
        echo "User doesn't exist\n";
    }

    if ($userRepository->findByEmailAndPass($searchEmail, $searchPass)) {
        echo "User pass correct \n";
    } else {
        echo "The user pass is incorrect\n";
    }
} else {
    echo "No se ha encontrado el fichero";
}


