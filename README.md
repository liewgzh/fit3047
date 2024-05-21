Structure of the repository

Database folder: contains the sql file to be imported into phpMyAdmin
Config folder: contains the files for paths, routing, and plugins
Src folder: Important folder containing the ‘Controller, Model, and View’ folders that define the logic of the entities in the database, as well as code for the website pages.
    Controller folder: Controllers for the appointments, pages, seminars, services, and users entities are stored here.
	Model folder: Folders for the entities and database tables are stored here.
    View folder: Stores the AppView file which contains code for the appointments form layout.
Templates folder: contains the folders for appointments, pages, seminars, services, and users. Each of these contain the layout files for how the page is coded and displayed.
Webroot folder: contains a few important folders- content blocks images, css files, javascript files, user images, and seminar videos.
    Content-blocks/uploads folder: stores the images for the main logo of the website.
    Frontend folder: stores the images used on the main homepage.
    Img folder: stores placeholder images (not important),
    Css/js folders: stores the css and javascript files respectively.
    User_images folder: stores the profile pictures of users of the website.
    Videos folder: stores the seminar videos in mp4 or video format.
Lastly, the repository contains several other files like composer.json and index.php that do not need to be modified.
![image](https://github.com/liewgzh/fit3047/assets/170413539/c8f13a7d-1081-42f7-8eaa-84aff88c9d51)

# CakePHP Application Skeleton

![Build Status](https://github.com/cakephp/app/actions/workflows/ci.yml/badge.svg?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/cakephp/app.svg?style=flat-square)](https://packagist.org/packages/cakephp/app)
[![PHPStan](https://img.shields.io/badge/PHPStan-level%207-brightgreen.svg?style=flat-square)](https://github.com/phpstan/phpstan)

A skeleton for creating applications with [CakePHP](https://cakephp.org) 5.x.

The framework source code can be found here: [cakephp/cakephp](https://github.com/cakephp/cakephp).

## Installation

1. Download [Composer](https://getcomposer.org/doc/00-intro.md) or update `composer self-update`.
2. Run `php composer.phar create-project --prefer-dist cakephp/app [app_name]`.

If Composer is installed globally, run

```bash
composer create-project --prefer-dist cakephp/app
```

In case you want to use a custom app dir name (e.g. `/myapp/`):

```bash
composer create-project --prefer-dist cakephp/app myapp
```

You can now either use your machine's webserver to view the default home page, or start
up the built-in webserver with:

```bash
bin/cake server -p 8765
```

Then visit `http://localhost:8765` to see the welcome page.

## Update

Since this skeleton is a starting point for your application and various files
would have been modified as per your needs, there isn't a way to provide
automated upgrades, so you have to do any updates manually.

## Configuration

Read and edit the environment specific `config/app_local.php` and set up the
`'Datasources'` and any other configuration relevant for your application.
Other environment agnostic settings can be changed in `config/app.php`.

## Layout

The app skeleton uses [Milligram](https://milligram.io/) (v1.3) minimalist CSS
framework by default. You can, however, replace it with any other library or
custom styles.
