const mix = require("laravel-mix");
const path = require("path");
const tailwindcss = require("tailwindcss");

require("laravel-mix-tailwind");

mix.js("resources/js/app.js", "public/js/app.js")
    .less("resources/less/app.less", "public/css/app.css")
    .options({
        postCss: [tailwindcss("./tailwind.config.js")],
    })
    .webpackConfig({
        output: { chunkFilename: "js/[name].js?id=[chunkhash]" },
        resolve: {
            alias: {
                vue$: "vue/dist/vue.runtime.esm.js",
                "@": path.resolve("resources"),
            },
        },
    });
