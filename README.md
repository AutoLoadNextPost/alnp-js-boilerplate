# Auto Load Next Post: JS Boilerplate

Boilerplate for writing plugins for Auto Load Next Post JavaScript.

## Requires
* Auto Load Next Post v1.4.8 or above.

## Grunt

To use the Grunt tasks you must have Grunt installed first. `npm install grunt`

### Setup

Open terminal and once in the project folder run `npm install --only=dev`.

#### Commands

`grunt` or `grunt test` will check for text domain issues.

`grunt dev` will do a search and replace and update the POT file.

`grunt update-post` will check for text domain issues and update the POT file.

`grunt zip` will create a deployable plugin zipped up and ready to upload and install on a WordPress installation.
