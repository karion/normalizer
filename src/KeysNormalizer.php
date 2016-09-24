<?php

namespace karion\Nauka;

class KeysNormalizer implements NormalizerInterface
{
    private $validKeys = ['page', 'sort', 'filters'];
    
    public function normalize(array $input)
    {
        return array_intersect_key($input, array_flip($this->validKeys));
    }
}
