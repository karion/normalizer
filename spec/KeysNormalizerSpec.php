<?php

namespace spec\karion\Nauka;

use karion\Nauka\KeysNormalizer;
use karion\Nauka\NormalizerInterface;
use PhpSpec\ObjectBehavior;

class KeysNormalizerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(KeysNormalizer::class);
        $this->shouldImplement(NormalizerInterface::class);
    }

    function it_dont_change_values()
    {
        $return = $this->normalize([
            'filters' => ['gamma']
        ]);

        $return->shouldNotHaveKey('page');
        $return->shouldHaveKey('filters');
        $return['filters']->shouldContain('gamma');
        $return->shouldNotHaveKey('sort');
        $return->shouldNotHaveKey('not_valid');
    }

    function it_return_empty_array_for_no_input()
    {
        $return = $this->normalize([]);
        
        $return->shouldBe([]);
    }

    function it_return_only_normalized_keys()
    {
        $return = $this->normalize(array(
            'not_valid' => 'start => 5',
            'filters' => 'gamma'
        ));

        $return->shouldNotHaveKey('page');
        $return->shouldHaveKey('filters');
        $return->shouldNotHaveKey('sort');
        $return->shouldNotHaveKey('not_valid');
    }
}
