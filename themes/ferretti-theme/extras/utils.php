<?php
    include( locate_template( 'extras/vendor/autoload.php', false, false) );
    use Facebook\FacebookRequest;
    function fb_init($opts) {
        $fb = new Facebook\Facebook([
            'app_id' => $opts['facebook_app_id'],
            'app_secret' => $opts['facebook_app_secret']
        ]);
        return $fb;
    }
    // FB INIT
    function extend_access_token($opts) {
        if(!isset($opts['facebook_access_token']) || $opts['facebook_access_token'] == '') {
            return $opts;
        }
        $fb = fb_init($opts);
        $fbApp = fb_init($opts)->getApp();
        $fbClient = fb_init($opts)->getClient();
        $extend = new Facebook\Authentication\OAuth2Client(
            $fbApp,
            $fbClient
        );
        $extend_response = $extend->getLongLivedAccessToken($opts['facebook_access_token']);
        $extend_result = $extend_response->getValue();
        $request = new Facebook\FacebookRequest(
            $fbApp,
            $extend_result,
            'GET',
            '/'. $opts['facebook_page_id'] . '/?fields=access_token'
        );
        try {
            $response = $fb->getClient()->sendRequest($request);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
             $opts['facebook_error_message'] = 'Graph returned an error: ' . $e->getMessage();
            return $opts;
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            $opts['facebook_error_message'] = 'Facebook SDK returned an error: ' . $e->getMessage();
            return $opts;
            exit;
        }
        $response = $fb->getClient()->sendRequest($request);
        $result = $response->getGraphObject()->asArray();
        $pageToken = $result['access_token'];
        $opts['facebook_extended_at'] = $pageToken;
        return $opts;
    }

    function facebook_ratings() {
        $options = get_option('facebook_settings');
        $page_id = $options['facebook_page_id'];
        if(!isset($options) || !array_key_exists('facebook_extended_at', $options) || $options['facebook_extended_at'] == '') {
            return $options;
        }
        $fb = fb_init($options);
        $fbApp = $fb->getApp();
        $fbClient = $fb->getClient();

        // EXTENDING THE ACCESS TOKEN
        //            
       
        $token = $options['facebook_extended_at'];
        
        #return print_r($request);
        #return $extend_response->isLongLived();
        $pageRequest = new Facebook\FacebookRequest(
            $fbApp,
            $token,
            'GET',
            '/'. $page_id . '/ratings?limit=5'
        );
        //$facebookSession = new FacebookSession($pageToken);
        try {
            $pageResponse = $fb->getClient()->sendRequest($pageRequest);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        $graphNode = $pageResponse->getGraphEdge()->asArray();
        return $graphNode;
    }


    /// GOOGLE MAPS
    /**
 * enqueue scripts and styles 
 *
 */

function my_acf_init() {
	
	acf_update_setting('google_api_key', 'AIzaSyBApKiXpzEiN38SYWUl64qjhfzwTBdLs8Y');
}

add_action('acf/init',  __NAMESPACE__.'\\my_acf_init');