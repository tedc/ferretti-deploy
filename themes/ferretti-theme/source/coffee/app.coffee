angular = require 'angular'
require 'angular-resource'
require 'angular-sanitize'
require 'angular-cookies' 
require 'angular-animate' 
require 'angular-touch'
frt = angular.module 'frt', ['ngResource', 'ngAnimate', 'ngTouch', 'ngSanitize', 'ngCookies']
require './angular/resources/index.coffee'
require './angular/directives/index.coffee'


