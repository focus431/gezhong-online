const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .vue({ version: 3 }) // 指定使用 Vue 3
   .js('resources/js/bootstrap.js', 'public/js')
   .vue(); // 如果有其他使用 Vue 2 的部分，可以繼續使用 Vue 2

    