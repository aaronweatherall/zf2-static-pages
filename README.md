# Aaron4m - Static Pages
The purpose of this module is to create a simple, zero configuration static pages module for Zend Framework 2

*NOTE: See New Development Version below for details on the new release*

## Installation
Added the following requirement to your projects composer.json file.

```php
"aaron4m/zf2-static-pages": "dev-master"
```

and run

php ./composer.phar update
and finally add StaticPages to the START of your modules list in config/application.php. It's important this comes first as it may override routes setup later.

## Usage
Simply drop a .phtml file into your module/application/view/static-pages folder (or any other module for that matter).

This page can now be viewed from either

/pages/yourfile/ (with or without trailing backslash)
or simply /yourfile/ (with or without trailing backslash)


##New Development Version
Here's the concept:

Rather than just relying on the fallback (which isn't compatible with ACL), I'm testing for the presence of the template then injecting it into the router stack on the bootstrap event. This means that each and every page dynamically has an actual literal route.

I'm still overloading the notFoundAction, however the only way it can possible hit this is if there's a template which has caused the router to send it to that page. Hence, this just returns the view.

I'm still not able to get around this as the ZF2 route listener uses method_exists to check for the presence of the action, which doesn't take any notice of a __call method. Hence, if the action doesn't exist, it will always use the notFoundAction.

I'd love it if you guys could download it and have a play as it's a fairly major change. I'm also keen to work out a way to unit test this. Since it's impossible to check for an action, we should be able to test the route as this is now working. Thoughts?

https://github.com/aaron4m/zf2-static-pages/archive/develop.zip
