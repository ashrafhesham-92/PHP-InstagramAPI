<?php
/**
 * Created by PhpStorm.
 * User: Ash
 * Date: 5/4/2016
 * Time: 2:22 PM
 */
class InstagramService
{
    private $client_id = null;
    private $client_secret = null;
    private $redirect_uri = null;

    public function __construct($client_id, $client_secret, $redirect_uri)
    {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->redirect_uri = $redirect_uri;
    }

    public function getLoginURL($scopes)
    {
        if (!is_array($scopes))
        {
            $error = array('error_code'=>1, 'error_msg'=>'Please provide an array of scopes');
            $error = json_encode($error);
            return $error;
        }
        else
        {
            $scopes_str = "";
            foreach($scopes as $scope)
            {
                $scopes_str = implode(" ", $scopes);
            }
            return "https://api.instagram.com/oauth/authorize/?client_id=$this->client_id&redirect_uri=$this->redirect_uri&response_type=code&scope=$scopes_str";
        }
    }
}
?>