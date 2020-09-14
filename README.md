# WordPress Theme Boilerplate

This is a simple boilerplate with webpack configuration. It deregisters jQuery by default and removes other bloat that the WordPress theme enables and injects in the head tag. This boilerplate also use namespaces in favor of function prefixes to resolve conflicting scoping issues that may occure if any two functions have same names for some reason.

## Setup

Before anything else, make sure you have the following extensions installed on your code editor.

1. Prettier
2. ESLint
3. Stylelint
4. EditorConfig

To get this theme up and running, download it or clone it and then run the following command.

```
npm install
```

This will install all the dependencies for the theme. After doing that, you can run three commands, two when you are in development mode and one when you are getting your theme ready for production.

###### Development commands

```
npm start
npm run dev
```

###### Production command

```
npm run build
```

This will give you a minified build of the JavaScript assets and also the Stylesheet assets. These assets are already included by default inside the functions.php file.

### Using Third Party Assets

If you want to use third party assets, make sure you don't download them directly and throw them into the assets file, instead, download the module using npm commands and include that module in your src/index.js file which is the entry point to your webpack. For CSS assets, you can either put the css inside the vendor folder and rename it to .scss or import them into the webpack entry point.

## PHP Theme Setup

The WordPress boilerplate is structured differently compared to many other setups you might have seen. This boilerplate is different as it uses namespaces in favor of function names with prefixes.

### Renaming

Before we go ahead, make sure to rename your theme and replace the word `Boilerplate` or `boilerplate` to your theme's intended name and text domain, this include namespaces, folder names, text domain inside style.css, inside the autoloader function and other places where localization is used, for instance, inside the any functions or classes defined.

### Functions.PHP

This file in the theme won't function as a singular file where all the theme functions are decalared and at the same time used inside the WP hooks. Instead, we have a theme-functions.php file inside the `inc` folder where all the necessary functions are defined under the theme namespace.

### Style.CSS

We only use style.css because the WordPress theme has a certain signature that we have to abide by, in no way will we include our styles inside the style.css file. We are using this file only so that our theme can get the metadata it requires for the theme.

### Classes and AutoLoader

An autoloader has already been implemented inside the functions.php file. Every class defined in our theme should be properly structured and should be inside our inc folder. You can study more on how namespaces and loaders work if you are interested in that.
