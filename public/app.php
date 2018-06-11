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

if (!$fileOps->hasFile()) {

    echo "The file doesn't exist";

} else {

    $searchEmail = isset($argv[1]) ? $argv[1] : 'alfa@mailinator.com';
    $searchPass = isset($argv[2]) ? $argv[2] : '123456';

    $userRepository = new InMemoryUserRepository();

    while (($data = $fileOps->readFile()) !== FALSE) {
        $userRepository->addUser(new ModelUser($data[0], $data[1]));
    }

    $fileOps->closeFile();

    $result = $userRepository->findByEmail($searchEmail) ? "User exists \n" : "User doesn't exist \n";

    if ($userRepository->findByEmailAndPass($searchEmail, $searchPass)) {

        $result .= "The user password is correct \n";

        $userFound = new ModelUser($searchEmail, $searchPass);
        $userFound->encryptPassword();

        if ($userRepository->updateUserPassword($userFound)) {

            $fileOps->openToWriteFile();

            foreach ($userRepository->users() as $user) {
                $fileOps->writeFile([$user->email(), $user->password()]);
            }

            $fileOps->closeFile();
            $result .= "User pass has been changed \n";
        }

    } else {
        $result .= "The user pass is incorrect\n";
    }

    echo $result;

}


