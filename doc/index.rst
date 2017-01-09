Welcome to n86io/hook's documentation!
======================================

A simple way of integrating hooks into your php-code.

Install
=======

In order to use these packages, please read `composer documentation
<https://getcomposer.org/doc>`_ on how to use composer and packages for it.

Package name for this hook package is ``n86io/hook``.

Example
=======

First, create a `callable <http://php.net/manual/language.types.callable.php>`_
like this or similar::

  $callable = function (string $param1, int $param2) {
      ... do something ...
  };

Then register it to ``HookHandler``::

  \N86io\Hook\HookHandler::register('hookName‘, $callable, -5);

Finally, trigger the hook at the right place and pass the required parameters::

  \N86io\Hook\HookHandler::trigger('hookName', 'param1', 2);


API Documentation
=================

Coming soon...
