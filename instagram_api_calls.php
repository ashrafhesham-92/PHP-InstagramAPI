<?php
/**
 * Created by PhpStorm.
 * User: Ash
 * Date: 5/4/2016
 * Time: 10:10 AM
 */

class InstagramAPI
{
    private $client_id = null;
    private $client_secret = null;

    public function __construct($client_id, $client_secret)
    {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
    }

    /**
     * @param $token
     * @return mixed|string
     *
     * Get information about the owner of the access_token.
     */
    public function getUser($token)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/v1/users/self/?access_token=$token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if($response === false)
        {
            $response = curl_error($ch);
        }
        else
        {
            $response = json_decode($response);
        }

        curl_close($ch);
        return $response;
    }
    // end getUser()

    /**
     * @param $token
     * @param $query
     * @return mixed|string
     *
     * Get a list of users matching the query.
     */
    public function searchUser($token, $query)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/v1/users/search?q=$query&access_token=$token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if($response === false)
        {
            $response = curl_error($ch);
        }
        else
        {
            $response = json_decode($response);
        }

        curl_close($ch);
        return $response;
    }
    // end searchUser()

    /**
     * @param $token
     * @return mixed|string
     *
     * Get the most recent media published by the owner of the access_token.
     */
    public function getUserRecentMedia($token)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/v1/users/self/media/recent/?access_token=$token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if($response === false)
        {
            $response = curl_error($ch);
        }
        else
        {
            $response = json_decode($response);
        }

        curl_close($ch);
        return $response;
    }
    // end getUserRecentMedia()

    /**
     * @param $token
     * @param $media_code
     * @param $media_type
     * @return mixed|string
     *
     * Get information about a media object. Use the type field to differentiate between image and video media in the response.
     * You will also receive the user_has_liked field which tells you whether the owner of the access_token has liked this media.
     * A media object's shortcode can be found in its shortlink URL.
     * An example shortlink is http://instagram.com/p/tsxp1hhQTG/. Its corresponding shortcode is tsxp1hhQTG.
     */
    public function getMediaByShortcode($token, $media_code, $media_type)
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/v1/media/shortcode/$media_code?access_token=$token&type=$media_type");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if($response === false)
        {
            $response = curl_error($ch);
        }
        else
        {
            $response = json_decode($response);
        }

        curl_close($ch);
        return $response;
    }
    // end getMediaByShortcode

    /**
     * @param $token
     * @param $media_id
     * @param $media_type
     * @return mixed|string
     *
     * Get information about a media object. Use the type field to differentiate between image and video media in the response.
     * You will also receive the user_has_liked field which tells you whether the owner of the access_token has liked this media.
     *
     * >>> you maybe getting error retrieving media using media-id, this will happen because you are trying to access media of a non-sandbox user while your app is still in sandbox mode
     */
    public function getMediaByID($token, $media_id, $media_type)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/v1/media/$media_id?access_token=$token&type=$media_type");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if($response === false)
        {
            $response = curl_error($ch);
        }
        else
        {
            $response = json_decode($response);
        }

        curl_close($ch);
        return $response;
    }
    // end getMediaByID()

    /**
     * @param $token
     * @param $lat
     * @param $lng
     * @param $distance
     * @return mixed|string
     *
     * Search for recent media in a given area.
     */
    public function searchMedia($token, $lat, $lng, $distance=1000)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/v1/media/search?lat=$lat&lng=$lng&distance=$distance&access_token=$token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if($response === false)
        {
            $response = curl_error($ch);
        }
        else
        {
            $response = json_decode($response);
        }

        curl_close($ch);
        return $response;
    }
    // end searchMedia

    /**
     * @param $token
     * @param $media_id
     * @param $text
     * @return mixed|string
     *
     * Create a comment on a media object with the following rules:
     * -The total length of the comment cannot exceed 300 characters.
     * -The comment cannot contain more than 4 hashtags.
     * -The comment cannot contain more than 1 URL.
     * -The comment cannot consist of all capital letters.
     */
    public function postComment($token, $media_id, $text)
    {
        $params = array('access_token'=>$token, 'text'=>$text);
        $query_string = http_build_query($params);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/v1/media/$media_id/comments");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if($response === false)
        {
            $response = curl_error($ch);
        }
        else
        {
            $response = json_decode($response);
        }

        curl_close($ch);
        return $response;
    }
    // end postComment()

    /**
     * @param $token
     * @param $media_id
     * @return mixed|string
     *
     * Get a list of recent comments on a media object.
     */
    public function getMediaComments($token, $media_id)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/v1/media/$media_id/comments?access_token=$token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if ($response === false)
        {
            $response = curl_error($ch);
        }
        else
        {
            $response = json_decode($response);
        }

        curl_close($ch);
        return $response;
    }
    // end getMediaComments()

    /**
     * @param $token
     * @param $media_id
     * @param $comment_id
     * @return mixed|string
     *
     * Remove a comment either on the authenticated user's media object or authored by the authenticated user.
     */
    public function deleteComment($token, $media_id, $comment_id)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/v1/media/$media_id/comments/$comment_id?access_token=$token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if($response === false)
        {
            $response = curl_error($ch);
        }
        else
        {
            $response = json_decode($response);
        }

        curl_close($ch);
        return $response;
    }
    // end deleteComment()

    /**
     * @param $token
     * @param $tag_name
     * @return mixed|string
     *
     * Get information about a tag object.
     */
    public function getTagInfo($token, $tag_name)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/v1/tags/$tag_name?access_token=$token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if($response === false)
        {
            $response = curl_error($ch);
        }
        else
        {
            $response = json_decode($response);
        }

        curl_close($ch);
        return $response;
    }
    // end getTagInfo()

    /**
     * @param $token
     * @param $query
     * @return mixed|string
     *
     * Search for tags by name.
     */
    public function searchTag($token, $query)
    {
        // it accepts A valid tag name without a leading #. (eg. snowy, nofilter)

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/v1/tags/search?q=$query&access_token=$token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if ($response === false)
        {
            $response = curl_error($ch);
        }
        else
        {
            $response = json_decode($response);
        }

        curl_close($ch);
        return $response;
    }
    // end searchTag()

    /**
     * @param $token
     * @param $tag_name
     * @param $count
     * @return mixed|string
     *
     * Get a list of recently tagged media.
     */
    public function getRecentlyTaggedMedia($token, $tag_name, $count)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request_url = "https://api.instagram.com/v1/tags/$tag_name/media/recent?access_token=$token&count=$count");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if($response === false)
        {
            $response = curl_error($ch);
        }
        else
        {
            $response = json_decode($response);
        }

        curl_close($ch);
        return $response;
    }
    // end getRecentlyTaggedMedia()

    /**
     * @param $token
     * @param $media_id
     * @return mixed|string
     *
     * Get a list of users who have liked this media.
     */
    public function getLikes($token, $media_id)
    {
        // this function MAY return nothing because it attempts to get normal instagram users not sandbox users.
        // and this should not work because the application is still in sandbox mode
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/v1/media/$media_id/likes?access_token=$token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if($response === false)
        {
            $response = curl_error($ch);
        }
        else
        {
            $response = json_decode($response);
        }

        curl_close($ch);
        return $response;
    }
    // end getLikes

    /**
     * @param $token
     * @param $media_id
     * @return mixed|string
     *
     * Set a like on this media by the currently authenticated user.
     */
    public function setLike($token, $media_id)
    {
        $params = array('access_token'=>$token);
        $query_string = http_build_query($params);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/v1/media/$media_id/likes");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if ($response === false)
        {
            $response = curl_error($ch);
        }
        else
        {
            $response = json_decode($response);
        }

        curl_close($ch);
        return $response;
    }
    // end setLike()

    /**
     * @param $token
     * @param $media_id
     * @return mixed|string
     *
     * Remove a like on this media by the currently authenticated user.
     */
    public function deleteLike($token, $media_id)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/v1/media/$media_id/likes?access_token=$token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if($response === false)
        {
            $response = curl_error($ch);
        }
        else
        {
            $response = json_decode($response);
        }

        curl_close($ch);
        return $response;
    }
    // end deleteLike()

    /**
     * @param $token
     * @return mixed|string
     *
     * Get the list of users this user follows.
     */
    public function getFollows($token)
    {
        // this function MAY return nothing because it attempts to get normal instagram users not sandbox users.
        // and this should not work because the application is still in sandbox mode
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/v1/users/self/follows?access_token=$token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if($response === false)
        {
            $response = curl_error($ch);
        }
        else
        {
            $response = json_decode($response);
        }

        curl_close($ch);
        return $response;
    }
    // end getFollows()

    /**
     * @param $token
     * @return mixed|string
     *
     * Get the list of users this user is followed by.
     */
    public function getFollowedBy($token)
    {
        // this function MAY return nothing because it attempts to get normal instagram users not sandbox users.
        // and this should not work because the application is still in sandbox mode
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/v1/users/self/followed-by?access_token=$token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if($response === false)
        {
            $response = curl_error($ch);
        }
        else
        {
            $response = json_decode($response);
        }

        curl_close($ch);
        return $response;
    }
    // end getFollowedBy()

    /**
     * @param $token
     * @return mixed|string
     *
     * List the users who have requested this user's permission to follow.
     */
    public function getRequestedBy($token)
    {
        // this function MAY return nothing because it attempts to get normal instagram users not sandbox users.
        // and this should not work because the application is still in sandbox mode
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/v1/users/self/requested-by?access_token=$token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if($response === false)
        {
            $response = curl_error($ch);
        }
        else
        {
            $response = json_decode($response);
        }

        curl_close($ch);
        return $response;
    }
    // end getRequestedBy()

    /**
     * @param $token
     * @param $user_id
     * @return mixed|string
     *
     * Get information about a relationship to another user. Relationships are expressed using the following terms in the response:
     * -outgoing_status: Your relationship to the user. Can be 'follows', 'requested', 'none'.
     * -incoming_status: A user's relationship to you. Can be 'followed_by', 'requested_by', 'blocked_by_you', 'none'.
     */
    public function getRelationShip($token, $user_id)
    {
        // this function MAY return nothing because it attempts to get normal instagram users not sandbox users.
        // and this should not work because the application is still in sandbox mode
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/v1/users/$user_id/relationship?access_token=$token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if($response === false)
        {
            $response = curl_error($ch);
        }
        else
        {
            $response = json_decode($response);
        }

        curl_close($ch);
        return $response;
    }
    // end getRelationShip

    /**
     * @param $token
     * @param $user_id
     * @param $action
     * @return mixed|string
     *
     * Modify the relationship between the current user and the target user.
     * You need to include an action parameter to specify the relationship action you want to perform.
     * Valid actions are: 'follow', 'unfollow' 'approve' or 'ignore'.
     * Relationships are expressed using the following terms in the response:
     * -outgoing_status: Your relationship to the user. Can be 'follows', 'requested', 'none'.
     * -incoming_status: A user's relationship to you. Can be 'followed_by', 'requested_by', 'blocked_by_you', 'none'.
     */
    public function changeRelationShip ($token, $user_id, $action)
    {
        $params = array('access_token'=>$token, 'action'=>$action);
        $query_string = http_build_query($params);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/v1/users/$user_id/relationship");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if($response === false)
        {
            $response = curl_error($ch);
        }
        else
        {
            $response = json_decode($response);
        }

        curl_close($ch);
        return $response;
    }
    // end changeRelationShip()
}

?>