<?php

class FileActionsTest extends PHPUnit_Framework_TestCase
{

    public function testShouldCopyOneFile()
    {

        $sourceFolder = dirname(__FILE__)."\\files\\from\\";
        $destFolder = dirname(__FILE__).".\\files\\to\\";
        $file = array(0 => array(
            "name" => "ceva",
            "ext" => "txt"));

        $url = "localhost:8081/licenta/php_manager/pmanager/content/copy.php?src=$sourceFolder&dest=$destFolder&action=copy&file_lst=".serialize($file);

        $curl = curl_init($url);
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1));

       $result =  curl_exec($curl);


        $this->assertNotNull($result);
        echo $result;
        $this->expectOutputString('<BR>Procedure complete');
        $this->assertFileExists($destFolder."ceva.txt");

    }

    public function testShouldCopyMultipleFiles()
    {

        $sourceFolder = dirname(__FILE__)."\\files\\from\\";
        $destFolder = dirname(__FILE__).".\\files\\to\\";
        $file = array(0 => array(
            "name" => "ceva1",
            "ext" => "txt"),
            1 => array(
                "name" => "ceva2",
                "ext" => "txt"));

        $url = "localhost:8081/licenta/php_manager/pmanager/content/copy.php?src=$sourceFolder&dest=$destFolder&action=copy&file_lst=".serialize($file);

        $curl = curl_init($url);
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1));

        $result =  curl_exec($curl);

        $this->assertNotNull($result);
        echo $result;
        $this->expectOutputString('<BR>Procedure complete<BR>Procedure complete');
        $this->assertFileExists($destFolder."ceva1.txt");
        $this->assertFileExists($destFolder."ceva2.txt");

    }

    public function testShouldCopyFolder()
    {

        $this->markTestSkipped("Incomplete");
        $sourceFolder = dirname(__FILE__)."\\files\\from\\";
        $destFolder = dirname(__FILE__).".\\files\\to\\";
        $file = array(0 => array(
            "name" => "fold",
            "ext" => "<dir>"));

        $url = "localhost:8081/licenta/php_manager/pmanager/content/copy.php?src=$sourceFolder&dest=$destFolder&action=copy&file_lst=".serialize($file);

        $curl = curl_init($url);
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1));

        $result =  curl_exec($curl);

        $this->assertNotNull($result);
        echo $result;
        $this->expectOutputString('<BR>Procedure complete');
        $this->assertFileExists($destFolder."ceva.txt");

    }

    public function testShouldMoveOneFile()
    {

        $sourceFolder = dirname(__FILE__)."\\files\\from\\";
        $destFolder = dirname(__FILE__).".\\files\\to\\";

        file_put_contents($sourceFolder."fileToMove.txt","sdfsdfsf");

        $file = array(0 => array(
            "name" => "fileToMove",
            "ext" => "txt"));

        $url = "localhost:8081/licenta/php_manager/pmanager/content/copy.php?src=$sourceFolder&dest=$destFolder&action=move&file_lst=".serialize($file);

        $curl = curl_init($url);
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1));

        $result =  curl_exec($curl);

        $this->assertNotNull($result);
        echo $result;
        $this->expectOutputString('<BR>Procedure complete');
        $this->assertFileExists($destFolder."fileToMove.txt");
        $this->assertFalse(file_exists($sourceFolder."fileToMove.txt"));

    }

    public function testShouldMoveMultipleFiles()
    {
        $this->markTestSkipped("Incomplete");
    }

}
?>