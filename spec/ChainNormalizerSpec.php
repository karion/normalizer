<?php

namespace spec\karion\Nauka;

use karion\Nauka\ChainNormalizer;
use karion\Nauka\NormalizerInterface;
use PhpSpec\ObjectBehavior;

class ChainNormalizerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ChainNormalizer::class);
        $this->shouldImplement(NormalizerInterface::class);
    }

    function it_call_seted_normalizer(NormalizerInterface $normalizer)
    {
        $this->addNormalizer($normalizer);

        $normalizer->normalize(['zeta' => 'alfa'])->shouldBeCalled();

        $this->normalize(['zeta' => 'alfa']);
    }

    function it_call_seted_normalizers_in_order(NormalizerInterface $first, NormalizerInterface $last)
    {
        $this->addNormalizer($first);
        $this->addNormalizer($last);

        $first->normalize(['first' => 'last'])->willReturn(["last" => "zombie"])->shouldBeCalled();
        $last->normalize(["last" => "zombie"])->shouldBeCalled();

        $this->normalize(['first' => 'last']);
    }
}