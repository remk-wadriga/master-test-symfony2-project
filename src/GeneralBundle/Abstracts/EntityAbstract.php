<?php

namespace GeneralBundle\Abstracts;


/**
 * Created by PhpStorm.
 * User: rem
 * Date: 10.09.14
 * Time: 17:23
 */
class EntityAbstract
{
    protected $_error;

    public function getFilePath()
    {
        return __DIR__.'/../../../../web';
    }

    public function getFileWebPath()
    {
        return '/bundles/general/img/';
    }

    public function getAbsoluteFilePath()
    {
        return $this->getFilePath().$this->getFileWebPath();
    }

    public function setAttributes(array $attributes)
    {
        foreach($attributes as $name => $value){
            $method = 'set'.ucfirst($name);
            if(method_exists($this, $method))
                $this->$method($value);
        }
    }

    public static function randomWord()
    {
        $length = 30;
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }

    protected function cropImage($image, $cropParams)
    {
        $cropParams = (object)$cropParams;
        $x_o = isset($cropParams->x) ? $cropParams->x : 0;
        $y_o = isset($cropParams->y) ? $cropParams->y : 0;
        $w_o = isset($cropParams->width) ? $cropParams->width : 100;
        $h_o = isset($cropParams->height) ? $cropParams->height : 100;

        try{
            $imageMagick = new \Imagick($image);
            $imageMagick = $imageMagick->coalesceImages();

            $i = 0;
            foreach($imageMagick as $frame){
                $frame->cropImage($w_o, $h_o, $x_o, $y_o);
                $frame->thumbnailImage($w_o, $h_o);
                $frame->setImagePage($w_o, $h_o, 0, 0);
                $i++;
            }

            if($i > 1)
                $this->_animation = true;

            $imageMagick = $imageMagick->deconstructImages();
            $result = $imageMagick->writeImages($image, true);
        }catch(\Exception $e){
            $this->_error =$e->getMessage();
            $result = false;
        }

        return $result;
    }
}