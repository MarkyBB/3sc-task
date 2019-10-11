<?php

namespace Tsc\CatStorageSystem\Classes;

use Tsc\CatStorageSystem\Classes\Directory;

class Menu extends MenuTasks {

    var $filesys;
    var $banner;

    public function __construct(Filesystem $filesys) {
        $this->filesys = $filesys;
        $this->mainMenu();
    }

    public function mainMenu() {
        $this->menuHeader();
        while(1) {    
            echo "1. Manage Directories\n";
            echo "2. Manage Gifs\n";
            echo "3. Exit\n\n";
            
            $line = readline("What would you like to do?: ");
            
            switch ($line) {
                case "1":
                    $this->directoryManagerMenu();
                    break;
                case "2":
                    $this->gifManagerMenu();
                    break;
                case "3":
                    system('clear');
                    echo "Goodbye!\n";
                    exit;
            }
        }
    }

    private function directoryManagerMenu() {
        $this->menuHeader();
        while(1) {
            echo $this->banner;
            echo "\n1. Create a new directory\n";
            echo "2. Rename a directory\n";
            echo "3. Delete a directory\n";
            echo "4. Go Back\n\n";
            $dirOpt = readline("Please select an option: ");
    
            switch ($dirOpt) {
                case "1":
                    $this->banner = $this->createNewDirectory($this->filesys);
                    $this->menuHeader();
                    break;
                case "2":
                    $this->banner = $this->renameDirectoryMenu($this->filesys);
                    $this->menuHeader();
                    break;
                case "3":
                    $this->banner = $this->deleteDirectoryMenu($this->filesys);
                    $this->menuHeader();
                    break;
                case "4":
                    $this->banner = $this->menuHeader();
                    return;
            }
        }
    }
    
    private function gifManagerMenu() {
        $this->menuHeader();
        while(1) {
            echo $this->banner;
            echo "\n1. Create a new file\n";
            echo "2. Update a file\n";
            echo "3. Rename a file\n";
            echo "4. Delete a file\n";
            echo "5. Go Back\n\n";
            $dirOpt = readline("Please select an option: ");

            switch ($dirOpt) {
                case "1":
                    $this->banner = $this->createNewFile($this->filesys);
                    $this->menuHeader();
                    break;
                case "2":
                    $this->banner = $this->updateFile($this->filesys);
                    $this->menuHeader();
                    break;
                case "3":
                    $this->banner = $this->renameFile($this->filesys);
                    $this->menuHeader();
                    break;
                case "4":
                    $this->banner = $this->deleteFile($this->filesys);
                    $this->menuHeader();
                    break;
                case "5";
                $this->menuHeader();
                    return;
            }
        }
    }

    private function menuHeader() {
        system('clear');
        echo "     |\      _,,,--,,_        \n";
        echo "     /,`.-'`'   ._  \-;;,_    \n";
        echo "    |,4-  ) )_   .;.(  `'-'   \n";
        echo "   '---''(_/._)-'(_\_)        \n\n";
        echo "Welcome to the Cat Gif Storage System!\n\n";
        $this->collectStats();
    }

    private function collectStats() {
        $dir = new Directory();
        $dir->setPath(getcwd());
        $dir->setName(basename(getcwd()));
        echo $this->displayStats($dir);
    }

    private function displayStats(Directory $dir) {
        $stats = "Current directory is  : " . getcwd() . " and " . $this->filesys->getDirectorySize($dir) . " bytes in size\n";
        $stats .= "Number of directories : " . $this->filesys->getDirectoryCount($dir) . "\n";
        $stats .= "Number of files in dir: " . $this->filesys->getFileCount($dir) . "\n\n";
        return $stats;
    }
}