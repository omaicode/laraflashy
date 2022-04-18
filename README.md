# LARAFLASHY

This repository will help you build a project faster, simpler and flexible.

![alt text](https://github.com/omaicode/laraflashy/blob/master/screenshot.png?raw=true)

## Introduce

When building projects, I find it very time consuming to have to build the project structure and integrate external libraries myself. So I created this repository.

## What's in this repository ?

This repository is a collection of basic libraries for building projects from scratch:
- [Laravel Admin & Extensions (thanks to z-song and contributors)](https://github.com/z-song/laravel-admin)
- [Laravel Modules (thanks to nwidart and contributors)](https://github.com/nWidart/laravel-modules)

We cloned and changed a little in codes to make it compatible.

## Installation

Clone this repository to your project.

```bash
git clone https://github.com/omaicode/laraflashy.git
```

Config your composer.json

```json
{
  ...
  "require": {
    ...
    "omaicode/modules-maker": "*@dev",
    "omaicode/repository-maker": "*@dev",
    "omaicode/repository-validation": "*@dev",
    "omaicode/laravel-admin": "*@dev",
    "omaicode/laravel-admin-config": "*@dev",
    "omaicode/laravel-admin-log-viewer": "*@dev",
    "omaicode/laravel-admin-media-manager": "*@dev",
    "omaicode/laravel-admin-multi-language": "*@dev"
  },
  "autoload": {
        "psr-4": {
            ...
            "Modules\\": "modules/"
            ...
        }
  },
  "repositories": [
    {
      "type": "path",
      "url": "./laraflashy/*"
    }    
  ]
}
```

Run composer update
```bash
composer update
```
## Usage
Laravel Admin documentation: [Laravel Admin](https://laravel-admin.org/docs/en/)
Laravel Modules documentation: [Laravel Modules](https://nwidart.com/laravel-modules/v6/introduction)

First install admin: 

```bash
php artisan admin:publish
php artisan admin:install
```

Second create your first module (optional)
```bash
php artisan module:make User
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)