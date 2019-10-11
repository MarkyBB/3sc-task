<?php

namespace Tsc\CatStorageSystem\Classes;

use PHPUnit\Framework\TestCase;

class DirectoryClassTest extends TestCase {

    public function test_it_creates_a_new_instance() {

        $stub = $this->createMock(Directory::class);
        $this->assertTrue($stub instanceof Directory);
    }

    public function test_setting_name() {
        
        $dir = new Directory();
        $value = 'testing';
        $dir->setName($value);
        $this->assertEquals($value, $dir->getName());
    }

    public function test_setting_time() {
        $dir = new File();
        $date = new \DateTime();
        $dir->setCreatedTime($date);
        $this->assertEquals($date, $dir->getCreatedTime());
    }
}
