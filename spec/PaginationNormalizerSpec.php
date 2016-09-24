<?php

namespace spec\karion\Nauka;

use karion\Nauka\NormalizerInterface;
use karion\Nauka\PaginationNormalizer;
use PhpSpec\ObjectBehavior;

class PaginationNormalizerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(PaginationNormalizer::class);
        $this->shouldImplement(NormalizerInterface::class);
    }

    function it_has_default_page_value()
    {
        $return = $this->normalize(array());

        $return->shouldHaveKey('page');
        $return['page']->shouldHaveKeyWithValue('start',0);
        $return['page']->shouldHaveKeyWithValue('limit',20);
    }

    function it_can_be_constructed_with_default_values()
    {
        $this->beConstructedWith(['start' => 12, "limit" => 100]);
        $return = $this->normalize(array());

        $return->shouldHaveKey('page');
        $return['page']->shouldHaveKeyWithValue('start',12);
        $return['page']->shouldHaveKeyWithValue('limit',100);
    }

    function it_dont_use_default_value_if_input_have_it()
    {
        $return = $this->normalize(array(
            'page' => ['start' => 5, "limit" => 10]
        ));
        
        $return->shouldHaveKey('page');
        $return['page']->shouldHaveKeyWithValue('start',5);
        $return['page']->shouldHaveKeyWithValue('limit',10);
    }
    
    function it_use_default_values_if_some_page_vaule_is_missing()
    {
        $return = $this->normalize(array(
            'page' => ['start' => 5]
        ));
        
        $return->shouldHaveKey('page');
        $return['page']->shouldHaveKeyWithValue('start',5);
        $return['page']->shouldHaveKeyWithValue('limit',20);
    }
}
