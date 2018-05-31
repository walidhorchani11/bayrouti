module.exports = function (grunt) {

    require('load-grunt-tasks')(grunt);

    // Project configuration.
    grunt.initConfig({

        jshint: {
            all: ['web/bundles/ecommerce/js/addRemoveButton_productPanier.js',
                'web/bundles/ecommerce/js/panier_show.js']
        },


        uglify: {
            options: {
                mangle: false
            },
            uglify_js: {
                files: {
                    'web/js/may_uglify.js': ['web/jquery/jquery.min.js', 'web/popper/popper.min.js', 'web/js/clean-blog.min.js',
                        'web/bootstrap/js/bootstrap.min.js','web/bundles/ecommerce/js/addRemoveButton_productPanier.js',
                        'web/bundles/ecommerce/js/panier_show.js']
                }
            }
        },


        cssmin: {
            target: {
                files: {
                    'web/css/min.css': ['web/bootstrap/css/bootstrap.min.css',
                    'web/css/clean-blog.min.css','web/css/style.css']
                }
            }
        },


        watch: {
            js: {
                files: ['web/bundles/ecommerce/js/addRemoveButton_productPanier.js',
                    'web/bundles/ecommerce/js/panier_show.js'],
                tasks: ['jshint','uglify'],
                options: {
                    spawn: false
                }
            },

            css: {
                files: ['web/css/style.css'],
                tasks: ['cssmin'],
                options: {
                    spawn: false
                }
            }

        },


        phpcs: {
            application: {
                src: ['src/contact/contactBundle/Service/EmailManager.php']
            },
            options: {
                bin: 'phpcs',
                standard: 'PSR2'
            }
        }

    });

    grunt.registerTask('default', ['jshint','uglify','cssmin']);

}