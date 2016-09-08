module.exports = function(grunt) {

    grunt.loadNpmTasks('grunt-postcss');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-concat-css');
    grunt.loadNpmTasks('grunt-babel');
    grunt.loadNpmTasks('grunt-newer');

    var App = {};
    App.path        = 'public/resource/';
    App.src         = App.path + 'src/';
    App.src_js      = App.src + 'js/';
    App.src_css     = App.src + 'css/';
    App.build       = App.path + 'build/';
    App.build_js    = App.build + 'js/';
    App.build_css   = App.build + 'css/';
    App.vendor      = App.path + 'vendor/';

    grunt.initConfig({

        App : App,

        babel: {

            options: {
                sourceMap: true,
                plugins: ['transform-react-jsx']
            },

            app: {
                files: [{
                    expand: true,
                    cwd : '<%= App.src_js %>',
                    src: '**/*.jsx',
                    dest: '<%= App.src_js %>',
                    ext: '.js'
                }]
            }

        },


        sass: {

            app: {
                files: [{
                    expand: true,
                    cwd : '<%= App.src_css %>',
                    src: '**/*.scss',
                    dest: '<%= App.src_css %>',
                    ext: '.css'
                }]
            }

        },


        postcss: {

            options: {
                map: false,
                processors: [
                    require('autoprefixer')({
                        browsers: ['last 2 versions']
                    })
                ]
            },

            app: {
                src : '<%= App.build_css %>**/*.css'
            }

        },


        cssmin: {

            app : {
                files : [{
                    expand: true,
                    cwd: '<%= App.src_css %>',
                    src: '**/*.css',
                    dest: '<%= App.build_css %>',
                    ext: '.css'
                }]
            },

        },


        uglify: {

            app : {
                files : [{
                    expand: true,
                    cwd: '<%= App.src_js %>',
                    src: '**/*.js',
                    dest: '<%= App.build_js %>',
                    ext: '.js'
                }]
            },

        },


        concat: {

            options: {
                separator: ';\n',
            },

            app : {
                src : '<%= App.build_js %>**/*.js',
                dest : '<%= App.path %>bundle-app.js',
            },

            vendor : {
                src : [
                    '<%= App.vendor %>react/react.min.js',
                    '<%= App.vendor %>react/react-dom.min.js',
                    '<%= App.vendor %>underscore/underscore-min.js',
                ],
                dest : '<%= App.path %>bundle-vendor.js'
            },

            vendor_and_app : {
                 src : [
                    '<%= App.path %>bundle-vendor.js',
                    '<%= App.path %>bundle-app.js',
                ],
                dest : '<%= App.path %>bundle.js'
                
            }

        },


        concat_css: {

            app : {
                src : '<%= App.build_css %>**/*.css',
                dest: '<%= App.path %>bundle-app.css',
            },

            vendor : {
                src : [
                ],
                dest : '<%= App.path %>bundle-vendor.css'
            },

            vendor_and_app : {
                 src : [
                    '<%= App.path %>bundle-vendor.css',
                    '<%= App.path %>bundle-app.css',
                ],
                dest : '<%= App.path %>bundle.css'
                
            }

        },


        watch: {

            js : {
                files : ['<%= App.src_js %>**/*.js'],
                tasks : ['newer:babel','newer:uglify:app','concat:app','concat:vendor_and_app']
            },

            jsx : {
                files : ['<%= App.src_js %>**/*.jsx'],
                tasks : ['newer:babel']
            },

            css : {
                files : ['<%= App.src_css %>**/*.css'],
                tasks : ['newer:cssmin:app','newer:postcss','concat_css:app','concat_css:vendor_and_app']
            },

            sass : {
                files : ['<%= App.src_css %>**/*.scss'],
                tasks : ['newer:sass']
            }

        },

    });

    grunt.registerTask('default', ['babel','sass','cssmin','postcss','uglify','concat','concat_css']);

};
