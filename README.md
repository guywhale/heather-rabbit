# Hwale
**A boilerplate WordPress theme**

Hwale takes an MVC(-ish) approach and **requires the ACF Pro plugin to be installed**.

TailwindCSS and @wordpress/scripts are included for the frontend.

[Robo](https://robo.li/) can be used while developing to automate the creation of **controller** and corresponding **view** files. Please see below for more info.

## Installation
Clone the folder into /wp-content/themes/.

Navigate to the folder in the terminal and run:

`npm install && composer install`


## Developing
To compile code to the build folder, run:

`npm run start`

If you prefer to have the browser update with your changes automatically, open **package.json**, go to:

    "scripts": {
      "sync": "browser-sync start -p 'hwale-boilerplate.lndo.site' --files '**/*.php' 'build/*.js' 'build/*.css'"
    }

Change **'hwale-boilerplate.lndo.site'** to your local domain.

To have the browser refresh automatically after each change, use:

`npm run preview`


### Creating controller and corresponding view files automatically
There are four **controller** types: **blocks**, **components**, **layouts** and **partials**.

**NOTE:** Partials cannot be created automatically as these are made infrequently, need a bit more consideration when being set up and are best done manually.

To create the other three **controller** types you can use the Robo commands below.

The relevant **controller** and **view** files will be created and populated with a basic code template to get you started. 

New **controller** names must be passed in **UpperCamelCase** to Robo.

#### Blocks
`composer robo make:block NewBlockName`

#### Components
`composer robo make:component NewComponentName`

#### Layouts
`composer robo make:layout NewLayoutName`


## Deploying
Before deploying run:

`npm run build`

Remember, you don't need the /node_modules or /vendor folders on the server.
