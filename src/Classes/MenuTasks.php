<?php

namespace Tsc\CatStorageSystem\Classes;

use Tsc\CatStorageSystem\Classes\Directory;
use Tsc\CatStorageSystem\Classes\File;

class MenuTasks {

    public function createNewDirectory(Filesystem $filesys) {
        $dirName = readline("Please enter name of directory: ");
        $parent = new Directory();
        $parent->setPath(getcwd());
        $parent->getExistingStats();
        $directory = new Directory();
        $directory->setName($dirName);
        $date = new \DateTime();
        $filesys->createDirectory($directory, $parent)->setCreatedTime($date);
        $banner = "** Directory " . $directory->getPath() . " successfully created on the " . $directory->getCreatedTime()->format('Y-m-d H:i:s') . "\n";
        return $banner;
    }
    
    public function deleteDirectoryMenu(Filesystem $filesys) {
        $availableDirs = $this->displayDirectories($filesys);
        echo "\n";
        $dirToDelete = readline("Please select directory to delete:(Type exit to escape) ");
        if ($dirToDelete === "exit") {
            return;
        }
        $directory = $availableDirs[$dirToDelete -1];
        $filesys->deleteDirectory($directory);
        $banner = "** Directory " . $directory->dirName . " successfully deleted from " . $directory->getPath() . "\n";
        return $banner;
    }
    
    public function renameDirectoryMenu(Filesystem $filesys) {
        $availableDirs = $this->displayDirectories($filesys);
        echo "\n";
        $dirToRename = readline("Please select directory to rename: ");
        $newName = readline("What would you like to rename it to?: ");
        $directory = $availableDirs[$dirToRename -1];
        $oldName = $directory->dirName;
        $filesys->renameDirectory($directory, $newName);
        $banner = "** Directory " . $oldName . " successfully renamed to " . $newName . "\n";
        return $banner;
    }
    
    public function displayDirectories(Filesystem $filesys) {
        $availableDirs = $this->getDirectories($filesys);
        for ($i = 0; $i < sizeof($availableDirs); $i++) {
            echo $i + 1 . ". " . $availableDirs[$i]->getName() . "\n";
        }
        return $availableDirs;
    }
    
    public function getDirectories(Filesystem $filesys) {
        $directory = new Directory();
        $directories = $filesys->getDirectories($directory);
        return $directories;
    }
    
    public function createNewFile(Filesystem $filesys) {
        $fileName = readline("Please enter name of file (.gif will automatically be appended.): ") . ".gif";
        $parent = new Directory();
        $parent->setPath(getcwd());
        $parent->getExistingStats();
        $file = new File();
        $file->setName($fileName);
        $date = new \DateTime();
        $file->setCreatedTime($date);
        $filesys->createFile($file, $parent);
        $banner = "** File " . $file->name . " successfully created on the " . $file->getCreatedTime()->format('Y-m-d H:i:s') . "\n";
        return $banner;
    }

    public function updateFile(Filesystem $filesys) {
        $availableFiles = $this->displayFiles($filesys);
        echo "\n";
        $fileSelection = readline("Please select file to update: ");
        $fileToUpdate = $availableFiles[$fileSelection  -1];
        $filesys->updateFile($fileToUpdate);
        $banner = "** File " . $fileToUpdate->name . " successfully updated!\n";
        return $banner;
    }
    
    public function renameFile(Filesystem $filesys) {
        $availableFiles = $this->displayFiles($filesys);
        echo "\n";
        $fileSelection = readline("Please select file to rename: ");
        $newName = readline("What would you like to rename it to? (.gif will automatically be appended.): ") . ".gif";
        $fileToRename = $availableFiles[$fileSelection  -1];
        $oldName = $fileToRename->name;
        $filesys->renameFile($fileToRename, $newName);
        $banner = "** File " . $oldName . " successfully renamed to " . $newName . "\n";
        return $banner;
    }
    
    public function deleteFile(Filesystem $filesys) {
        $availableFiles = $this->displayFiles($filesys);
        echo "\n";
        $fileSelection = readline("Please select file to delete:(Type exit to escape) ");
        if ($fileSelection === "exit") {
            return;
        }
        $fileToDelete = $availableFiles[$fileSelection -1];
        $filesys->deleteFile($fileToDelete);
        $banner = "** File " . $fileToDelete->name . " successfully deleted from " . $fileToDelete->getPath() . "\n";
        return $banner;
    }
    
    public function displayFiles(Filesystem $filesys) {
        $availableFiles = $this->getFiles($filesys);
        for ($i = 0; $i < sizeof($availableFiles); $i++) {
            echo $i + 1 . ". " . $availableFiles[$i]->getName() . "\n";
        }
        return $availableFiles;
    }
    
    public function getFiles(Filesystem $filesys) {
        $directory = new Directory();
        $directory->setPath(getcwd());
        $files = $filesys->getFiles($directory);
        return $files;
    }
}