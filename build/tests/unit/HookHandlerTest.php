<?php
declare(strict_types = 1);

/**
 * This file is part of N86io/Hook.
 *
 * N86io/Hook is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * N86io/Hook is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with N86io/Hook or see <http://www.gnu.org/licenses/>.
 */

namespace N86io\Hook\Tests\Unit;

use N86io\Hook\HookHandler;
use N86io\Hook\HookNotFoundException;

/**
 * Class HookHandler
 *
 * @author Viktor Firus <v@n86.io>
 */
class HookHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function testException1()
    {
        $this->expectException(HookNotFoundException::class);
        $this->expectExceptionMessage('There are no hooks to trigger.');
        HookHandler::trigger('invHook');
    }

    public function test()
    {
        $checkFlags = new \stdClass();
        $checkFlags->callable1 = false;
        $checkFlags->callable2 = false;
        $checkFlags->runCallable2Before1 = false;

        $callable1 = function (string $param1, int $param2) use ($checkFlags) {
            $checkFlags->callable1 = $param1 === 'param1' && $param2 === 2;
        };
        HookHandler::register('hook1', $callable1, -5);

        $callable2 = function () use ($checkFlags) {
            $checkFlags->callable2 = true;
            $checkFlags->runCallable2Before1 = $checkFlags->callable1 === false;
        };
        HookHandler::register('hook1', $callable2, 5);


        HookHandler::trigger('hook1', 'param1', 2);

        $this->assertTrue($checkFlags->callable1);
        $this->assertTrue($checkFlags->callable2);
        $this->assertTrue($checkFlags->runCallable2Before1);
    }

    public function testException2()
    {
        $this->expectException(HookNotFoundException::class);
        $this->expectExceptionMessage('Can\' found hooks called "invHook".');
        HookHandler::trigger('invHook');
    }
}
