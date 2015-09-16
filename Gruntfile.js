module.exports = function (grunt) {
    grunt.util.linefeed = '\n';

    grunt.initConfig({
        watch: {
            source: {
                files: ['_includes/**/*.html'],
                tasks: ['jekyll:site']
            },
            main: {
                files: ['sass/**/*.sass'],
                tasks: ['sass:main']
            },
            bootstrap: {
                files: ['scss/*.scss'],
                tasks: ['sass:bootstrap']
            },
            livereload: {
                options: {
                    livereload: true
                },
                files: [
                    '_includes/**/*.html',
                    'sass/**/*.sass'
                ],
            }
        },

        sass: {
            options: {
                style: 'compressed',
                lineNumbers: false,
                precision: 5//,
                //update: true
            },
            main: {
                files: {
                    'css/main.css': 'sass/main.sass'
                }
            },
            bootstrap: {
                options: {
                    includePaths: [
                        'bower_components/bootstrap-sass/stylesheets'
                    ]
                },
                files: {
                    'css/bootstrap.css': 'scss/_bootstrap.scss'
                }
            }
        },

        postcss: {
            options: {
                map: true,
                processors: [
                  //require('autoprefixer-core')({ browsers: ['last 2 version'] }),
                  require('cssnano')()
                ]
            },
            dist: {
                src: 'css/*.css'
            }
        },

        jekyll: {
            site: {
                options: {
                   dest: '_site',
                   config: '_config.yml'
                }
            }
        }

    });

    require('load-grunt-tasks')(grunt);

    grunt.registerTask('default', [
        'sass',
        'postcss',
        'jekyll'
    ]);

    grunt.registerTask('watch', [
        'default',
        'watch'
    ]);
};