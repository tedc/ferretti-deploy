frt = angular.module 'frt'
frt
    .service 'loadGoogleMapAPI', ['$window', '$q', ($window, $q)->
            deferred = $q.defer()
            loadScript = ->
                script = document.createElement 'script'
                script.id = 'mapJS'
                script.src = "https://maps.googleapis.com/maps/api/js?v=3.exp&callback=initialize&key=#{google_api}"
                document.body.appendChild script
                return
            window.initialize = ->
                deferred.resolve()
                return
            loadScript()
            return deferred.promise
        ]
    .factory 'storageService', ->
        storage =
            get : (key)->
                localStorage.getItem key
            save : (key, data)->
                localStorage.setItem key, JSON.stringify data
            remove : (key)->
                localStorage.removeItem key
            clear : (key)->
                localStorage.clearAll key
    .factory 'sessionService', ->
        storage =
            get : (key)->
                sessionStorage.getItem key
            save : (key, data)->
                sessionStorage.setItem key, JSON.stringify data
            remove : (key)->
                sessionStorage.removeItem key
            clear : (key)->
                sessionStorage.clearAll key
    .factory 'cacheService', ['storageService', (storageService)->
        cache =
            getData : (key)->
                return off if not key? and typeof key is "undefined"
                if Modernizr.localstorage
                    stored = JSON.parse storageService.get key
                    if not stored?
                        return off
                    else
                        now = new Date()
                        exp = stored.expiration
                        if now.getTime() > exp
                            return off
                        else
                            return stored
                else
                    return off
                return
            setData : (key, data)->
                return off if (not key? and typeof key is "undefined") or (not data? and typeof data is "undefined")
                if Modernizr.localstorage
                    storageService.save key, data
                else
                    return off
                return
            removeData : (key, data)->
                return off if (not key? and typeof key is "undefined") or (not data? and typeof data is "undefined")
                if Modernizr.localstorage
                    storageService.remove key, data
                else
                    return off
                return
        ]
    .factory 'cacheSessionService', ['sessionService', (sessionService)->
        cache =
            getData : (key)->
                return off if not key? and typeof key is "undefined"
                if Modernizr.sessionstorage
                    stored = JSON.parse sessionService.get key
                    if not stored?
                        return off
                    else
                        now = new Date()
                        exp = stored.expiration
                        if now.getTime() > exp
                            return off
                        else
                            return stored
                else
                    return off
                return
            setData : (key, data)->
                return off if (not key? and typeof key is "undefined") or (not data? and typeof data is "undefined")
                if Modernizr.sessionstorage
                    sessionService.save key, data
                else
                    return off
                return
            removeData : (key, data)->
                return off if (not key? and typeof key is "undefined") or (not data? and typeof data is "undefined")
                if Modernizr.sessionstorage
                    sessionService.remove key, data
                else
                    return off
                return
        ]
    .factory 'transformRequestAsFormPost', [ require './form.coffee']
    .factory 'InstagramPosts', [ "$resource", "cacheService", require './instagram.coffee']
    .factory 'FacebookReviews', [ "$resource", "cacheService", require './facebook.coffee']
    .factory 'getPosts', [ "$resource", "cacheService", require './more.coffee']
    .factory 'getSearch', [ "$resource", require './search.coffee']