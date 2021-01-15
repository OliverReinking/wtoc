# Laravel Starter Package

This Laravel starter package consists of the following components:
- Laravel
- Vue
- tailwindcss

## Implementation documentation

### Laravel Installation

    composer global remove laravel/installer 
    composer global require laravel/installer 
    laravel --version

On 01/15/2021 the version was 4.1.1

    laravel new code

laravel/framework had version 8.12 on 15.01.2021

### Database

The following database values were entered in .env

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravelstarterpackage-test
    DB_USERNAME=root
    DB_PASSWORD=12345678

### Configuration

Open the app.php file in the config directory.
Change the following values:

    'timezone' => 'Europe/Berlin',
    'locale' => 'de',
    'fallback_locale' => 'de',
    'faker_locale' => 'de',

### Installation of vue, less and tailwindcss

    npm install
    npm install vue --save-dev
    npm install vue-template-compiler --save-dev
    npm install less --save-dev
    npm install less-loader --save-dev
    npm install tailwindcss --save-dev
    npm install laravel-mix-tailwind --save-dev
    npm install autoprefixer --save-dev
    

Remove the css directory under resources. Create the new directory less under resources/js.
For this new directory create the file app.less with the following content:

    @import "tailwindcss/base"; 
    @import "tailwindcss/components"; 
    @import "tailwindcss/utilities"; 

Now we create the file tailwind.config.js
    npx tailwindcss init

Add the following to tailwind.config.js:
    purge: ["./resources/views/**/*.blade.php", "./resources/js/**/*.vue"],

Now we customize the webpack.mix.js file:

    const mix = require("laravel-mix");
    const tailwindcss = require("tailwindcss");
    require("laravel-mix-tailwind");
    mix.js("resources/js/app.js", "public/js/app.js")
        .less("resources/less/app.less", "public/css/app.css")
        .options({
            postCss: [tailwindcss("./tailwind.config.js")],
        });

## Logo
We create the new directory Pages/Shared/Logo under resources/js.
Here we now create the new file Logo.vue.
We will now use this logo to test if we have installed Vue correctly.

The Logo.vue file has the following structure:

    <template>
        <svg></svg>
    </template>
    <script>
        export default {
            name: "logo.svg",
        };
    </script>

Inside the svg tag we insert the SVG logo.

Now we add the following lines to webpack.mix.js:
    .webpackConfig({
            output: { chunkFilename: "js/[name].js?id=[chunkhash]" },
            resolve: {
                alias: {
                    vue$: "vue/dist/vue.runtime.esm.js",
                    "@": path.resolve("resources")
                }
            }
        });

Now we rebuild the data welcome.blade.php:
    <body>
        <div id="app">
            <app-homepage></app-homepage>
        </div>
    </body>

In the head section we need to include the CSS file app.css and the javascript file app.js.

Now I adjust the app.js file in the resources/js directory:
    require('./bootstrap');
    import Vue from 'vue';
    // Views
    import AppHomepage from "@/js/Pages/Homepage/Views/Home.vue";
    const app = new Vue({
        el: "#app",
        render: h => h(AppHomepage)
    });
    export default app;

And finally we need the file Home.vue in the new directory js/Pages/Homepage/Views.

    <template>
        <div class="container mx-auto h-full">
            <div class="h-full min-h-screen flex items-center">
                <div class="mx-auto">
                    <logo></logo>
                </div>
            </div>
        </div>
    </template>

    <script>
    import Logo from "@/js/Pages/Shared/Logo/Logo";
    //
    export default {
        name: "Home",
        //
        components: {
            Logo,
        },
    };
    </script>


Now make the following modifications in package.json:

    "scripts": {
        "dev": "npm run development",
        "development": "cross-env NODE_ENV=development node_modules/webpack/bin/webpack.js --progress --hide-modules --config=node_modules/laravel-mix/setup/webpack.config.js",
        "watch": "npm run development -- --watch",
        "watch-poll": "npm run watch -- --watch-poll",
        "hot": "cross-env NODE_ENV=development node_modules/webpack-dev-server/bin/webpack-dev-server.js --inline --hot --disable-host-check --config=node_modules/laravel-mix/setup/webpack.config.js",
        "prod": "npm run production",
        "production": "cross-env NODE_ENV=production node_modules/webpack/bin/webpack.js --no-progress --hide-modules --config=node_modules/laravel-mix/setup/webpack.config.js"
    },

And still install:
    npm install cross-env --save-dev

Now run the following command:
    npm run watch

Then call the following address in the browser:
    http://laravelstarterpackage.test/



## License

The Laravel Starter Package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
