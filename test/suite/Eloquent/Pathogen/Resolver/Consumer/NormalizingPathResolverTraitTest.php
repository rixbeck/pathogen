<?php

/*
 * This file is part of the Pathogen package.
 *
 * Copyright © 2013 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Pathogen\Resolver\Consumer;

use Phake;
use PHPUnit_Framework_TestCase;

class NormalizingPathResolverTraitTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        parent::setUp();

        if (!defined('T_TRAIT')) {
            $this->markTestSkipped('Requires trait support');
        }

        $this->consumer = $this->getObjectForTrait(
            __NAMESPACE__ . '\NormalizingPathResolverTrait'
        );
    }

    public function testSetPathResolver()
    {
        $pathResolver = Phake::mock(
            'Eloquent\Pathogen\Resolver\PathResolverInterface'
        );
        $this->consumer->setPathResolver($pathResolver);

        $this->assertSame($pathResolver, $this->consumer->pathResolver());
    }

    public function testPathResolver()
    {
        $pathResolver = $this->consumer->pathResolver();

        $this->assertInstanceOf(
            'Eloquent\Pathogen\Resolver\NormalizingPathResolver',
            $pathResolver
        );
        $this->assertSame($pathResolver, $this->consumer->pathResolver());
    }
}