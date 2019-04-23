<?php

namespace Asa\Erp;

/**
 * 年代季节
 */
class TbAgeseason extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_ageseason');
    }

    public function getRules() {
        return [
            'name' => $this->getValidatorFactory()->year('nianfen'),
            'sessionmark' => $this->getValidatorFactory()->presenceOf('fabuji') 
        ];
    }

    public function toArrayPipe() {
        $fullname = sprintf("%s%s", $this->sessionmark, $this->name);
        $array = $this->toArray();
        $array['fullname'] = $fullname;
        return $array;
    }
}