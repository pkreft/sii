module.exports = function(grunt) {

    grunt.initConfig({
        concat: {
            bundle: {
                src: [
                    'app/Resources/public/js/**/*.js',
                    'src/NewsBundle/Resources/public/js/**/*.js',
                ],
                dest: 'web/assets/dest/js/scripts.js'
            },
        },
        watch: {
            js: {
                files: [
                    'app/Resources/public/js/**/*.js',
                    'src/NewsBundle/Resources/public/js/**/*.js',
                ],
                tasks : ['concat:bundle']
            },
        },
        uglify: {
            my_target: {
                files: {
                    'web/assets/dest/js/scripts.min.js': ['web/assets/dest/js/scripts.js']
                }
            }
        }
    });
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.registerTask('default', ['concat:bundle', 'uglify']);
};
