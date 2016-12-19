<?php
declare(strict_types=1);

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

namespace N86io\Hook;

/**
 * Class HookHandler
 *
 * @author Viktor Firus <v@n86.io>
 */
class HookHandler
{
    /**
     * @var array
     */
    private static $hooks = [];

    /**
     * @var bool
     */
    private static $debug = false;

    public static function activateDebug()
    {
        static::$debug = true;
    }

    public static function deactivateDebug()
    {
        static::$debug = false;
    }

    /**
     * @param string   $name
     * @param callable $callable
     * @param int      $priority
     */
    public static function register(string $name, callable $callable, int $priority = 0)
    {
        if (empty(static::$hooks)) {
            static::$hooks[$name] = [];
        }
        if (empty(static::$hooks[$name][$priority])) {
            static::$hooks[$name][$priority] = [];
        }
        static::$hooks[$name][$priority][] = $callable;
    }

    /**
     * @param string $name
     * @param array  ...$params
     *
     * @throws HookNotFoundException
     */
    public static function trigger(string $name, ...$params)
    {
        if (empty(static::$hooks)) {
            if (static::$debug) {
                throw new HookNotFoundException('There are no hooks to trigger.');
            }

            return;
        }
        if (empty(static::$hooks[$name])) {
            if (static::$debug) {
                throw new HookNotFoundException('Can\' found hooks called "' . $name . '".');
            }

            return;
        }
        krsort(static::$hooks[$name]);
        foreach (static::$hooks[$name] as $sortedOnPriority) {
            foreach ($sortedOnPriority as $hook) {
                call_user_func($hook, ...$params);
            }
        }
    }
}
