[![Build Status](https://img.shields.io/travis/n86io/hook.svg?style=flat-square)](https://travis-ci.org/n86io/hook)
[![Code Climate](https://img.shields.io/codeclimate/github/n86io/hook.svg?style=flat-square)](https://codeclimate.com/github/n86io/hook)
[![Test Coverage](https://img.shields.io/codeclimate/coverage/github/n86io/hook.svg?style=flat-square)](https://codeclimate.com/github/n86io/hook/coverage)
[![Issue Count](https://img.shields.io/codeclimate/issues/github/n86io/hook.svg?style=flat-square)](https://codeclimate.com/github/n86io/hook/issues)
[![Style Ci](https://styleci.io/repos/76562234/shield?style=flat-square)](https://styleci.io/repos/76562234)
[![Packagist](https://img.shields.io/packagist/l/n86io/hook.svg?style=flat-square)](https://packagist.org/packages/n86io/hook)
![PHP](https://img.shields.io/badge/PHP-7.0%2C%207.1-blue.svg?style=flat-square)

# N86io/Rest

Integrate on simple way hooks into your code.

### Example

    $callable = function (string $param1, int $param2) {
        ... do something ...
    };
    \N86io\Hook\HookHandler::register('hookName‘, $callable, -5);

The hook itself should be a valid PHP callable. See for it in [PHP documentation](http://php.net/manual/language.types.callable.php).

On place, who the hook should be executed, just use the trigger function.

    \N86io\Hook\HookHandler::trigger('hookName', 'param1', 2);