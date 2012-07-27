#Jet Console

> The Jet Console package help you to create simple, reliable and testable command line utilities for your application
> You can easily create command line elements for your taks, deployment and more.

##Why ?

I created this simple console package to simplify the creation of command line app. It's not like Symfony Console component, it's more simple, faster and flexible.

##Installation

Just download the git repository and get and autoload. Or load file manually. But I realy recommand to get an autoload file (realy, it's just crazy to load all file manualy).

##How to use

To use this console package, you just need to create your command :

```php
<?php

namespace Your\Namespace;

use Jet\Console\Command\AbstractCommand;

class ExampleCommand extends AbstractCommand
{
    public function init()
    {
        $this
            ->setName('example')
            ->setDescription('An example command')
            ->addArgument('hello', Argument::OPTIONAL, null, 'description');
    }

    public function execute()
    {
        if ($this->hasArgument('hello')) {
            return $this->someMethod();
        }

        $this->display('No argument found');
    }

    public function someMethod()
    {
        $argument = $this->getArgument('hello);
        $this->display("hello {$argument}");
    }
}
```

Now, to use your command, you need to create the file to run it (in a bin directory) ! (if you are a Windows user, remove the first line)

```php
#!/usr/bin/env php
<?php

//include your autoloader
include_once __DIR__ . '/../../autoload.dist.php';

Use Jet\Console\Console;
Use Your\Namespace;

$console = new Console('name', 'version');
$console->addCommand(new ExampleCommand);
$console->run();

```

Let's run !

```
bin/test example --hello you
```

Feel free to contribute!
------------------------

* Fork
* Report bug
* Help in development
* Buy me a new mac (what ?)

Licence
-------

Released under a [BSD license](http://en.wikipedia.org/wiki/BSD_licenses)