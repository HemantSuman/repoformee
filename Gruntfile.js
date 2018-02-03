module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    sass: {
      dist: {
        files: {
          'plugins/front/css/dist/style.css' : 'plugins/front/css/build/style.scss'
        }
      }
    },
    cssmin: {
      target: {
        files: [{
          expand: true,
          cwd: 'plugins/front/css/dist',
          src: ['*.css', '!*.min.css'],
          dest: 'plugins/front/css/dist',
          ext: '.min.css'
        }]
      }
    },
    watch: {
      css: {
        files: '**/*.scss',
        tasks: ['sass', 'cssmin']
      }
    }
  });

  // Load the plugin
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-watch');

  // Default task(s).
  grunt.registerTask('default', ['watch']);

};
