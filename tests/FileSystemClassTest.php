<?php

namespace Tsc\CatStorageSystem\Classes;

use PHPUnit\Framework\TestCase;

class FileSystemClassTest extends TestCase {

    public function test_it_creates_a_new_instance() {

        $stub = $this->createMock(FileSystem::class);
        $this->assertTrue($stub instanceof FileSystem);
    }
}
