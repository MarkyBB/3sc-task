<?php

namespace Tsc\CatStorageSystem\Classes;

use PHPUnit\Framework\TestCase;

class FileClassTest extends TestCase {

    public function test_it_creates_a_new_instance() {

        $stub = $this->createMock(File::class);
        $this->assertTrue($stub instanceof File);
    }

    public function test_setting_name() {
        
        $file = new File();
        $value = 'testing';
        $file->setName($value);
        $this->assertEquals($value, $file->getName());
    }

    public function test_setting_size() {
        $file = new File();
        $value = 2000;
        $file->setSize($value);
        $this->assertEquals($value, $file->getSize());
    }

    public function test_setting_time() {
        $file = new File();
        $date = new \DateTime();
        $file->setCreatedTime($date);
        $this->assertEquals($date, $file->getCreatedTime());
    }
}
