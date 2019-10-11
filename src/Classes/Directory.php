<?php

namespace Tsc\CatStorageSystem\Classes;

use Tsc\CatStorageSystem\Interfaces\DirectoryInterface;

use \DateTimeInterface;

class Directory implements DirectoryInterface {

    var $dirName;
    var $createdTime;
    var $path;
    
    public function getName() {
        return $this->dirName;
    }

    public function setName($name) {
        $this->dirName = $name;
        return $this;
    }

    public function getCreatedTime() {
        return $this->createdTime;
    }

    public function setCreatedTime(DateTimeInterface $created) {
        $this->createdTime = $created;
        return $this;
    }
  
    public function getPath() {
        return $this->path;
    }
  
    public function setPath($path) {
        $this->path = $path;
        return $this;
    }

    public function getExistingStats() {
        $this->createdTime = filectime($this->dirName);
        $this->path = getcwd() . "/" . $this->dirName;
    }
}

?>