<?php declare(strict_types = 1);
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
     * Array, where hooks are stored.
     *
     * @var array
     */
    private static $hooks = [];

    /**
     * Debug activating flag.
     *
     * @var bool
     */
    private static $debug = false;

    /**
     * If debug is activated, trigger will throw the N86io\Hook\HookNotFoundException exception, if no hooks registered
     * or hook with given name not registered.
     */
    public static function activateDebug()
    {
        static::$debug = true;
    }

    /**
     * Deactivate debug. See activateDebug().
     */
    public static function deactivateDebug()
    {
        static::$debug = false;
    }

    /**
     * Register a hook.
     *
     * @param string   $name     The hook name.
     * @param callable $callable A valid PHP callable (http://php.net/manual/language.types.callable.php).
     * @param int      $priority Priority of hook-calling of hooks with same name.
     */
    public static function register(string $name, callable $callable, int $priority = 0)
    {
        if (empty(static::$hooks) === true) {
            static::$hooks[$name] = [];
        }
        if (empty(static::$hooks[$name][$priority]) === true) {
            static::$hooks[$name][$priority] = [];
        }
        static::$hooks[$name][$priority][] = $callable;
    }

    /**
     * Trigger a registered hook.
     *
     * @param string $name      The hook name.
     * @param array  ...$params Parameters who are should pass to the callable.
     *
     * @throws HookNotFoundException
     */
    public static function trigger(string $name, ...$params)
    {
        if (empty(static::$hooks) === true) {
            if (static::$debug === true) {
                throw new HookNotFoundException('There are no hooks to trigger.');
            }

            return;
        }
        if (empty(static::$hooks[$name]) === true) {
            if (static::$debug === true) {
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
