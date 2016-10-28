em = (val)->
    val / 16

mapInit = (id, coords, scope, compile)->
    style = [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
    
    ## MARKER
    marker = require './marker.coffee'
    
    ## DIRECTIONS
    
    scope.directionsService = new google.maps.DirectionsService
    scope.directionsDisplay = new google.maps.DirectionsRenderer {suppressMarkers: true}
    
    ## CENTER
    
    bounds = new google.maps.LatLngBounds()
    pos = new google.maps.LatLng(coords[0]['lat'],coords[0]['lng'])
    bounds.extend pos
    
    ## INIT
    
    opt = 
        zoom : 18
        center : bounds.getCenter()
        disableDefaultUI : on
        scrollwheel : off
        maxZoom : 20
        minZoom : 3
        mapTypeId : google.maps.MapTypeId.ROADMAP
        backgroundColor : '#c4c4c4'
        noClear : true
        disableDoubleClickZoom: on
        draggable : if mobilecheck() then off else on
    window.map = new google.maps.Map(id, opt)
    poly = new google.maps.Polyline
        strokeColor: '#0086ff'
        strokeOpacity: 1.0
        strokeWeight: 2
    poly.setMap window.map
    scope.directionsDisplay.setMap window.map

    ## MARKERS
    
    overlay = []
    for i in [0...coords.length]
        pos = new google.maps.LatLng(coords[i]['lat'],coords[i]['lng'])
        text =
            desc : coords[i]['desc']
            label : coords[i]['label']    
        overlay[i] = new marker pos, map, i, text, scope, compile
    styleOptions =
        name: 'frt'
    mapType = new google.maps.StyledMapType(style, styleOptions)
    window.map.mapTypes.set('frt', mapType)
    window.map.setMapTypeId('frt')
    window.map.panBy window.innerWidth / 3 / 2, 0
    google.maps.event.addDomListener(window, 'resize', ()->
        google.maps.event.trigger(map, 'resize')
        window.map.setCenter(bounds.getCenter())
        window.map.panBy window.innerWidth / 3 / 2, 0
        for i in [0...coords.length]
            pos = new google.maps.LatLng(coords[i]['lat'],coords[i]['lng'])
            overlay[i].updateBounds(pos)
        return
    )
    return
module.exports = (id, lat, scope, compile)->
    mapInit(id, lat, scope, compile)