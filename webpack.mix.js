const mix = require("laravel-mix");
const path = require("path");
const tailwindcss = require("tailwindcss");

require("laravel-mix-tailwind");

mix.js("resources/js/app.js", "public/js/app.js")
    .copyDirectory(
        "node_modules/font-awesome/fonts",
        "public/fonts/font-awesome"
    )
    .less("resources/less/app.less", "public/css/app.css")
    .options({
        postCss: [tailwindcss("./tailwind.config.js")]
    })
    .extract()
    .version();
