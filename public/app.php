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

    $searchEmail = isset($argv[1]) ? $argv[1] : 'alfa@mailinator.com';
    $searchPass = isset($argv[2]) ? $argv[2] : '123456';

    $userRepository = new InMemoryUserRepository();

    while (($data = $fileOps->readFile()) !== FALSE) {
        $user = new ModelUser($data[0], $data[1]);
        $userRepository->addUser($user);
    }
    $fileOps->closeFile();

    if ($userRepository->findByEmail($searchEmail)) {
        echo "User exists \n";
    } else {
        echo "User doesn't exist \n";
    }

    if ($userRepository->findByEmailAndPass($searchEmail, $searchPass)) {

        echo "User pass correct \n";

        $userFound = new ModelUser($searchEmail,$searchPass);
        $userFound->encryptPassword();

        if ($userRepository->updateUser($userFound)) {

            $fileOps->openToWriteFile();

            foreach ($userRepository->users() as $user)
            {
                $fileOps->writeFile([$user->email(),$user->password()]);
            }

            $fileOps->closeFile();
            echo "User pass has been changed \n";
        }

    } else {
        echo "The user pass is incorrect\n";
    }

} else {
    echo "The file doesn't exist";
}


