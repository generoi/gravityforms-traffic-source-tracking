# wp-plugin-boilerplate

> GravityForms integration that fetches the initial traffic source from cookies and passes it along with entries.

## Requirements

* GravityForms-plugin activated
* Cookies containing the initial traffic source. For example in GTM.

## Features

Each GF submission entry will contain a meta field telling from which source the visitor came to the website.

## API

The cookies needed:

    __utmcsr__ : *campaign source*
    __utmcmd__ : *campaign medium*
    __utmccn__ : *campaign name*
    __utmcct__ : *campaign content*
    __utmctr__ : *campaign term*

## Development

Install dependencies

    composer install
    npm install

Run the tests

    npm run test

Build assets

    # Minified assets which are to be committed to git
    npm run production

    # Development assets while developing the plugin
    npm run dev

    # Watch for changes and re-compile while developing the plugin
    npm run watch

Bump versions

    # Bump patch release
    robo version:bump

    # Bump minor release
    robo version:bump --stage=minor

    # Bump major release
    robo version:bump --stage=major

Setup new plugin

    robo rename
