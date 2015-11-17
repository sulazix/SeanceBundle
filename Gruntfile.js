module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json')
  });

  var path = 'Resources/public/';

  // jshint
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.config('jshint', {
    options: {
      maxerr: 10000
    },
    frontend: [
      path + 'js/config',
      path + 'js/controllers',
      path + 'js/filters',
      path + 'js/models',
      path + 'js/services',
      path + 'js/seanceApp.js',
    ]
  });

  // concat
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.config('concat', {
    options: {
      separator: ';\n'
    },
    dist: {
      src: [
        path + 'js/seanceApp.js',
        path + 'js/config/*.js',
        path + 'js/filters/*.js',
        path + 'js/models/*.js',
        path + 'js/services/*.js',
        path + 'js/controllers/*.js'
      ],
      dest: path + 'dist/frontend.js'
    }
  });


  // uglify
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.config('uglify', {
    options: {
      mangle: {
        except: ['jQuery']
      }
    },
    dist: {
      files: {
        'Resources/public/dist/frontend.min.js': [path + 'dist/frontend.js']
      }
    },
    dist_dev: {
      options: {
        mangle: false,
        beautify: true
      },
      files: {
        'Resources/public/dist/frontend.min.js': [path + 'dist/frontend.js']
      }
    }
  });

  // watch
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.config('watch', {
    options: {

    },
    js: {
      files: [path + "/js/**/*.js"],
      tasks: ['build-dev']
    }
  });


  // Grunt Tasks
  grunt.registerTask('build', ['jshint', 'concat', 'uglify']);
  grunt.registerTask('build-dev', ['jshint', 'concat', 'uglify:dist_dev']);

};