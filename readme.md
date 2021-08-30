# gravityforms-traffic-source-tracking

> GravityForms integration that fetches the initial traffic source from cookies and passes it along with entries.

## Requirements

* GravityForms-plugin activated
* Cookies containing the initial traffic source. For example in GTM.

## Features

Each GF submission entry will contain a meta field telling from which source the visitor came to the website.

## API

The cookie should be set like this example:

    Name: __utmzz
    Value: utmcsr=google|utmcmd=organic|utmccn=(not set)|utmcct=(not set)|utmctr=(not provided)

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
