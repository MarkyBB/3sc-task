<?php

namespace Tsc\CatStorageSystem\Classes;

use Tsc\CatStorageSystem\Interfaces\FileInterface;
use Tsc\CatStorageSystem\Interfaces\DirectoryInterface;
use Tsc\CatStorageSystem\Interfaces\FileSystemInterface;

class FileSystem implements FileSystemInterface {

  public function createFile(FileInterface $file, DirectoryInterface $parent) {
      chdir($parent->getPath());
      touch($file->getName(), $file->createdTime->getTimestamp());
      $file->setParentDirectory($parent);
      $file->setPath(getcwd() . "/" . $file->getName());
      return $file;
  }

  public function updateFile(FileInterface $file) {
      $fp = fopen($file->getPath(), 'a');
      fwrite($fp, "Updating the file!");
      fclose($fp);
      return $file;
  }

  public function renameFile(FileInterface $file, $newName) {
      rename($file->getName(), $newName);
      $file->setName($newName);
      return $file;
  }

  public function deleteFile(FileInterface $file) {
      return unlink($file->getPath());
  }

  public function createRootDirectory(DirectoryInterface $directory) {
      mkdir($directory->getPath());
      return $directory;
  }

  public function createDirectory(DirectoryInterface $directory, DirectoryInterface $parent) {
      $fullPath = $parent->getPath() . $directory->getName(); 
      mkdir($fullPath);
      $directory->setPath($fullPath);
      return $directory;
  }

  public function deleteDirectory(DirectoryInterface $directory) {
      return rmdir($directory->getPath());
  }

  public function renameDirectory(DirectoryInterface $directory, $newName) {
      rename($directory->getPath(), $newName);
      $directory->setName($newName);
      $directory->setPath($directory->getPath() . "/" . $newName);
      return $directory;
  }

  public function getDirectoryCount(DirectoryInterface $directory) {
      $numOfDirectories = 0;

      $directories = glob('*', GLOB_ONLYDIR);

      if ($directories) {
          $numOfDirectories = count($directories);
      }
      return $numOfDirectories;
  }

  public function getFileCount(DirectoryInterface $directory) {

      $numOfFiles = 0;
      
      chdir($directory->getPath());
      $files = glob("*.gif");
  
      if ($files) {
          $numOfFiles = count($files);
      }
      return $numOfFiles;
  }

  public function getDirectorySize(DirectoryInterface $directory) {
      $dirSize = $this->directorySize($directory->getPath());
      return $dirSize;
  }

  public function getDirectories(DirectoryInterface $directory) {
      $directories = array();
      $allDirs = glob('*', GLOB_ONLYDIR);
      foreach($allDirs as $dir) {
          $dirObj = new Directory();
          $dirObj->setName($dir);
          $dirObj->getExistingStats();
          array_push($directories, $dirObj);
      }
      return $directories;
  }

  public function getFiles(DirectoryInterface $directory) {
      $files = array();
      chdir($directory->getPath());
      $allFiles = glob("*.*");
      foreach($allFiles as $file) {
          $fileObj = new File();
          $fileObj->setName($file);
          $fileObj->getExistingStats();
          array_push($files, $fileObj);
      }
      return $files;
  }

  public function directorySize($dir) {
    $size = 0;
    foreach (glob(rtrim($dir, '/').'/*', GLOB_NOSORT) as $each) {
        $size += is_file($each) ? filesize($each) : $this->directorySize($each);
    }
    return $size;
  }
}