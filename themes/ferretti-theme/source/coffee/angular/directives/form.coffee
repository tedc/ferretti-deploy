module.exports = ->
    form =
        scope: on
        controller: [ "$scope", "transformRequestAsFormPost", "$http", "$timeout", ($scope, transformRequestAsFormPost, $http, $timeout)->
            $scope.formData = {}
            $scope.onSubmit = (isValid, url)->
                frmdata = $scope.formData
                $scope.isSubmitted = on
                $scope.formData = {}
                $scope.contactForm.$setUntouched()
                $scope.contactForm.$setPristine()
                if isValid
                    $http(
                        {
                            method: 'POST'
                            url: url
                            data: frmdata
                            headers :
                                "Content-type" : "application/x-www-form-urlencoded; charset=utf-8"
                            transformRequest: transformRequestAsFormPost
                        }).then (data)->
                            $scope.isContactSent = on
                            $timeout ->
                                $scope.isSubmitted = off
                                $scope.isContactSent = off
                            , 5000
                            return
                return]