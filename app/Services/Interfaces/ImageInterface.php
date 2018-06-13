<?php

namespace App\Services\Interfaces;

/*
 * Interface ImageInterface
 */

interface ImageInterface {
    public function copyImage($srcImage);

    public function uploads($file, $folderUpload, $name = '');

    public function setFolderUpload($folderUpload, $level = 2);

    public function deleteImage($srcImage);
}

?>