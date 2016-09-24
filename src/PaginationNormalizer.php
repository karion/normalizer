<?php

namespace karion\Nauka;

class PaginationNormalizer implements NormalizerInterface
{
    private $default = array('page' => ["limit" => 20, "start" => 0]);

    public function __construct($default = null)
    {
        if ($default) {
            $this->default = ['page' => $default];
        }
    }

    public function normalize(array $input)
    {
        if (array_key_exists('page', $input)) {
            $output['page'] = array_replace($this->default['page'], $input['page']);
        } else {
            $output['page'] = $this->default['page'];
        }

        return $output;
    }
}
