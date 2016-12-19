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
