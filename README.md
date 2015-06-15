[![Codeship Status](https://www.codeship.io/projects/d57af290-cff9-0132-6afb-7637bc41f5cd/status)](https://www.codeship.io/projects/76883)

# Introduction

This package provides utilities required for signing and authenticating calls to public URLs.

## Usage

`SalesChamp\Webhooks\Authenticator::sign` expects raw HTTP request body as argument in order to provide a signature used for authentication, `SalesChamp\Webhooks\Authenticator::verify` expects signature received in `X-SalesChamp-Signature` HTTP header and raw HTTP request body in order to verify the request.

## Tests

Can be run via `./vendor/bin/tester tests`.

## Versioning

Library follows [semantic versioning](http://semver.org/). Make sure to update to tag commits accordingly.