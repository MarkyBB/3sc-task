<?php

namespace Tsc\CatStorageSystem\Classes;

use Tsc\CatStorageSystem\Interfaces\FileInterface;
use Tsc\CatStorageSystem\Interfaces\DirectoryInterface;

use \DateTimeInterface;

class File implements FileInterface {

    var $name;
    var $fileSize;
    var $createdTime;
    var $modifiedTime;
    var $parentDir;
    var $path;
  
    public function getName() {
        return $this->name;
    }
  
    public function setName($name) {
        $this->name = $name;
        return $this;
    }
  
    public function getSize() {
        return $this->fileSize;
    }
  
    public function setSize($size) {
        $this->fileSize = $size;
        return $this->fileSize;
    }
  
    public function getCreatedTime() {
        return $this->createdTime;
    }
  
    public function setCreatedTime(DateTimeInterface $created) {
        $this->createdTime = $created;
        return $this->createdTime;
    }
  
    public function getModifiedTime() {
        return $this->modifiedTime;
    }
  
    public function setModifiedTime(DateTimeInterface $modified) {
        $this->modifiedTime = $modified;
        return $this->modifiedTime;
    }
  
    public function getParentDirectory() {
        return $this->parentDir;
    }
  
    public function setParentDirectory(DirectoryInterface $parent) {
        $this->parentDir = dirname($parent->getPath());
        return $this->parentDir;
    }

    public function setPath($path) {
        $this->path = $path;
        return $this;
    }
  
    public function getPath() {
        return $this->path;
    }

    public function getExistingStats() {
        $this->fileSize = filesize($this->name);
        $this->createdTime = filectime($this->name);
        $this->modifiedTime = filemtime($this->name);
        $this->parentDir = dirname(getcwd());
        $this->path = getcwd() . "/" . $this->name;
    }
}