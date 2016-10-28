frt = angular.module 'frt'
frt
    .run [ "$templateCache", require './templates' ]  