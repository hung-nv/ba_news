<?php
/**
 * Created by PhpStorm.
 * User: linh
 * Date: 11/7/17
 * Time: 11:28 AM
 */

namespace App\Services\Production;

use App\Services\Interfaces\ImageInterface;
use Illuminate\Support\Facades\File as File;

class ImageService implements ImageInterface
{
    public function copyImage($srcImage)
    {
        if ($srcImage && File::exists(public_path($srcImage))) {
            // get folder to upload
            $folderUpload = getFolderUpload($srcImage);

            // set folder to save
            $folderPath = $this->setFolderUpload($folderUpload);

            // get and create container folder if needed
            if (!is_dir(public_path($folderPath))) {
                File::makeDirectory(public_path($folderPath), intval(0755, 8), true);
            }

            $fileName = date('YmdHis', time()) . '-' . getImageNameByPath($srcImage);

            if(File::copy(public_path($srcImage), public_path($folderPath).$fileName)) {
                return $folderPath.$fileName;
            } else {
                return false;
            }
        }
    }

    public function uploads($file, $folderUpload, $name = '') {

        //name of uploaded file
        $pathinfo = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        //extension
        $extension = $file->getClientOriginalExtension();

        //set folder to save
        $folderPath = $this->setFolderUpload($folderUpload);

        //get and create container folder if needed
        if (!is_dir(public_path($folderPath))) {
            File::makeDirectory(public_path($folderPath), intval(0755, 8), true);
        }

        if(isset($name) && $name) {
            $fileName = $name;
        } else {
            $fileName = date('YmdHis', time()) . '-' . str_slug($pathinfo) . '.' . $extension;
        }

        //save image to path
        if ($file->move(public_path($folderPath), $fileName)) {
            return $folderPath.$fileName;
        } else {
            return false;
        }
    }

    public function setFolderUpload($folderUpload, $level = 2) {

        //remove special char
        $folder = str_replace(' ', '-', $folderUpload); // Replaces all spaces with hyphens.
        $imagePath = '/uploads/'.strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $folder)).'/';

        switch ($level) {
            case 1:
                $folderPath = $imagePath . date('Y', time()) . '/';
                break;
            case 2:
                $folderPath = $imagePath . date('Y', time()) . '/' . date('m', time()) . '/';
                break;
            case 3:
                $folderPath = $imagePath . date('Y', time()) . '/' . date('m', time()) . '/'. date('d', time()).'/';
                break;
            default:
                $folderPath = $imagePath . date('Y', time()) . '/' . date('m', time()) . '/'. date('d', time()).'/';
        }

        return $folderPath;
    }

    public function deleteImage($srcImage) {

        if ($srcImage && file_exists(public_path($srcImage))) {
            File::delete(public_path($srcImage));
        }
    }
}