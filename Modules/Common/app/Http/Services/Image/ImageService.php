<?php

namespace Modules\Common\Http\Services\Image;

use Illuminate\Support\Facades\Config;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ImageService extends ImageToolsService
{
    public function save($image)
    {
        $this->setImage($image);
        $this->provider();
        $driver = new ImageManager();
       if(config('app.debug')) {
            $result = $driver->read($image->getRealPath())->save(public_path($this->getImageAddress()),null,$this->getImageFormat());
       } else {
           $result = $driver->read($image->getRealPath())->save('/home/'.config('app.folderInServer').'/public_html/kar/public/'.$this->getImageAddress(),null,$this->getImageFormat());
       }
        return $result ? $this->getImageAddress() : false;
    }

    public function fitAndSave($image,$width,$height)
    {
        $this->setImage($image);
        $this->provider();
        $driver = new ImageManager();
        $result = $driver->read($image->getRealPath())->resize($width,$height)->save(public_path($this->getImageAddress()),null,$this->getImageFormat());
        return $result ? $this->getImageAddress() : false;
    }

    public function createIndexAndSave($image)
    {
        $imageSizes = Config::get('image.index-image-sizes');
        $this->setImage($image);
        $this->getImageDirectory() ?? $this->setImageDirectory(date('Y').DIRECTORY_SEPARATOR.date('m').DIRECTORY_SEPARATOR.date('d'));
        $this->setImageDirectory($this->getImageDirectory().DIRECTORY_SEPARATOR.time());
        $this->getImageName() ?? $this->setImageName(time());
        $imageName = $this->getImageName();
        $driver = new ImageManager(new Driver());

        $indexArray = [];
        foreach ($imageSizes as $sizeAlias => $imageSize){
            $currentImageName = $imageName.'-'.$sizeAlias;
            $this->setImageName($currentImageName);
            $this->provider();
           if(config('app.debug')) {
                if ($sizeAlias == 'full') {
                    $result = $driver->read($image->getRealPath())->save(public_path($this->getImageAddress()),null,$this->getImageFormat());
                } else {
                    $result = $driver->read($image->getRealPath())->scaleDown($imageSize['width'])->save(public_path($this->getImageAddress()),null,$this->getImageFormat());
                }
           } else {
               if ($sizeAlias == 'full') {
                   $result = $driver->read($image->getRealPath())->save('/home/'.config('app.folderInServer').'/public_html/kar/public/'.$this->getImageAddress(),null,$this->getImageFormat());
               } else {
                   $result = $driver->read($image->getRealPath())->scaleDown($imageSize['width'])->save('/home/'.config('app.folderInServer').'/public_html/kar/public/'.$this->getImageAddress(),null,$this->getImageFormat());
               }
           }
            if ($result){
                $indexArray[$sizeAlias] = $this->getImageAddress();
            } else {
                return false;
            }
        }
        $output =[];
        $output['indexArray'] = $indexArray;
        $output['directory'] = $this->getFinalImageDirectory();
        $output['currentImage'] = Config::get('image.default-current-index-image');
        return $output;
    }

    public function deleteImage($imagePath)
    {
        if (file_exists($imagePath)){
            unlink($imagePath);
        }
    }

    public function deleteIndex($image)
    {
        $directory = public_path($image['directory']);
        $this->deleteDirectoryAndFiles($directory);
    }

    public function deleteDirectoryAndFiles($directory)
    {
        if (!is_dir($directory)){
            return false;
        }
        $files = glob($directory.DIRECTORY_SEPARATOR.'*',GLOB_MARK);
        foreach ($files as $file){
            if (is_dir($file)) {
                $this->deleteDirectoryAndFiles($file);
            } else {
                unlink($file);
            }
        }
        $result = rmdir($directory);
        return $result;
    }

}
