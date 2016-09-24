<?php

namespace karion\Nauka;

class ChainNormalizer implements NormalizerInterface
{
    protected $normalizers = [];

    public function addNormalizer(NormalizerInterface $normalizer)
    {
        $this->normalizers[] = $normalizer;
    }

    public function normalize(array $input)
    {
        foreach ($this->normalizers as $normalizer) {
            $input = $normalizer->normalize($input);
        }
        
        return $input;
    }
}
