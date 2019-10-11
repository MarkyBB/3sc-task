<?php

require __DIR__ . '/../vendor/autoload.php';

use Tsc\CatStorageSystem\Classes\Menu;
use Tsc\CatStorageSystem\Classes\FileSystem;
use Tsc\CatStorageSystem\Classes\Directory;

$filesys = new FileSystem();

init($filesys);

$begin = new Menu($filesys);

function init(Filesystem $filesys) {

    if(file_exists("/tmp/cat-storage-app")) {
        $dir = '/tmp' . DIRECTORY_SEPARATOR . 'cat-storage-app';
        $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($it,
             RecursiveIteratorIterator::CHILD_FIRST);
        foreach($files as $file) {
            if ($file->isDir()){
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }
        rmdir($dir);
    }
 
    $storageAppRoot = new Directory();
    $storageAppRoot->setPath('/tmp/cat-storage-app/');
    $storageAppRoot->setName('cat-storage-app');
    $storageAppRoot->setCreatedTime(date_create());

    $imagesDir = new Directory();
    $imagesDir->setPath('/tmp/cat-storage-app/images');
    $imagesDir->setName('images');
    $imagesDir->setCreatedTime(date_create());
    
    $filesys->createRootDirectory($storageAppRoot);
    $filesys->createDirectory($imagesDir, $storageAppRoot);

    $gifs = array();
    $allGifs = glob("images/*.gif");
    foreach($allGifs as $gif) {
        copy($gif, $storageAppRoot->getPath() . $gif);
    }
    
    chdir($storageAppRoot->getPath() . "/images");
}
