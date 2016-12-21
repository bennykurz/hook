Welcome to n86io/hook's documentation!
======================================

Integrate on simple way hooks into your php-code.

Install
=======

For using this packages, please read `composer documentation
<https://getcomposer.org/doc>`_ how to use composer and packages for it.

Package name for this hook package is ``n86io/hook``.

Example
=======

Create first a `callable <http://php.net/manual/language.types.callable.php>`_
like this or similar::

  $callable = function (string $param1, int $param2) {
      ... do something ...
  };

Then register it to ``HookHandler``::

  \N86io\Hook\HookHandler::register('hookName‘, $callable, -5);

Finally trigger the hook at right place and pass needed parameters::

  \N86io\Hook\HookHandler::trigger('hookName', 'param1', 2);


API Documentation
=================

Coming soon...
