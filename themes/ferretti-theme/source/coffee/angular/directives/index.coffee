frt = angular.module 'frt'
frt
    .directive 'ngCarousel', [ require './carousel.coffee' ]
#    .directive 'ngPs', [ "$window", require './ps.coffee']
#    .directive 'ngSm', [ "$window", require './sm.coffee']
#    .directive 'frtForm', [ require './form.coffee']
    .directive 'ngMap', [ "$timeout", "loadGoogleMapAPI", "$compile", require './map.coffee']
#    .directive 'ngVideo', [ require './video.coffee']
#    .directive 'ngLoadMore', [ require './posts.coffee']
#    .directive 'ngSearchFilters', [ require './filters.coffee']
    .directive 'ngInstagram', [ require './instagram.coffee']
    .directive 'ngFbReviews', [ require './facebook.coffee']
    