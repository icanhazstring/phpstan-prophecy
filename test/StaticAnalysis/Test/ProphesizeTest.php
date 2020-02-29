<?php

declare(strict_types=1);

/**
 * Copyright (c) 2018 Jan Gregor Emge-Triebel
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/Jan0707/phpstan-prophecy
 */

namespace JanGregor\Prophecy\Test\StaticAnalysis\Test;

use JanGregor\Prophecy\Test\StaticAnalysis\Src;
use PHPUnit\Framework;
use Prophecy\Argument;
use Prophecy\Prophecy;

/**
 * @internal
 *
 * @coversNothing
 */
final class ProphesizeTest extends Framework\TestCase
{
    /**
     * @var Prophecy\ObjectProphecy|Src\BaseModel
     */
    private $prophecy;

    protected function setUp(): void
    {
        $this->prophecy = $this->prophesize(Src\BaseModel::class);
    }

    public function testInSetUp(): void
    {
        $this->prophecy
            ->getFoo()
            ->willReturn('bar');

        $this->prophecy
            ->doubleTheNumber(Argument::is(2))
            ->willReturn(5);

        $testDouble = $this->prophecy->reveal();

        self::assertEquals('bar', $testDouble->getFoo());
        self::assertEquals(5, $testDouble->doubleTheNumber(2));
    }

    public function testInTestMethod(): void
    {
        $prophecy = $this->prophesize(Src\BaseModel::class);

        $prophecy
            ->getFoo()
            ->willReturn('bar');

        $prophecy
            ->doubleTheNumber(Argument::is(2))
            ->willReturn(5);

        $testDouble = $prophecy->reveal();

        self::assertEquals('bar', $testDouble->getFoo());
        self::assertEquals(5, $testDouble->doubleTheNumber(2));
    }
}
