# PHP-InstagramAPI
A PHP project for making Instagram API calls in a simple and documented way.

### **Documentation**

***
**config.php :** This file contains the following constants : `CLIENT_ID`,`CLIENT_SECRET`,`REDIRECT_URI` _and starts a session_.
You should change the values of the constants with your own values to make the application continue the user authorization steps correctly.
> NOTE : The project contains file called **instagram_login_callback.php**, this file was my destination for the `REDIRECT_URI` and it contains some operations which i will talk about later.
You should be using it in your `REDIRECT_URI`, or change its name and use it normaly.

**index.php :** This file instantiates object of **InstagramService** class -which i will talk about later- which contains a function that returns a **Login URL** which will be used for redirecting user to third party for authorization process to be completed.
>You will find a defined array called `$scopes`, you should use it for defining the scopes that user needs for doing specific operations, you can find full information about scopes in this page : [Instagram Login Permissions (Scopes)](https://www.instagram.com/developer/authorization/)

**instagram_login_callback.php :** This file the landing file after user authorizes your application.
After the authorization process is completed instagram returns a **code** that means that the authorization process was successful, you can access this code using `$_GET['code']`, but if the user declined authorizing your application instagram will return an **error** instead of **code**.
When you receive the **code** now you can use it to ask for an **access token**, **instagram_login_callback.php** handles the above part and it also handles making the call for authentication data and saves the **access token** in `$_SESSION['instagram_accesstoken']`.

Now the user is authenticated and authorized your application so you can start making API calls normally. 

### **Classess**

**InstagramService :** When you instantiate an object of that class you should provide the following parameters for its constructor : `CLIENT_ID' , 'CLIENT_SECRET' , 'REDIRECT_URI'.
This class has a function called `getLoginURL($scopes)`, this function takes `$scopes` as its parameter, it combines the `$scopes`, `CLIENT_ID` and `REDIRECT_URI` for returning a **Login URL** that the user will be redirected to and authorize your application for access.
> the `getLoginURL()`'s parameter which called `$scopes` must be an **Array** of strings each string represents different scope.

**InstagramAPI :** Instantiating object of that class gives you access to the functions responsible of making API calls and returning results as objects.
The functions are as follows : 

### **Functions :**

- `getUser($token)` : Get information about the owner of the access_token.

- `getUserById($token, $user_id)` : Get information about a user using his ID.

- `searchUser($token, $query)` : Get a list of users matching the query.
>Example: `$search_user = $instagramAPI->searchUser($_SESSION['instagram_accesstoken'], 'username');`

- `getRecentMedia($token, $count)` : Get the most recent media published by the owner of the access_token.

- `getUserRecentMedia($token,$user_id, $count)` : Get the most recent media published by a user.

- `getRecentLikedMedia($token, $count)` : Get the list of recent media liked by the owner of the access_token.

- `getMediaByShortcode($token, $media_code, $media_type)` : Get information about a media object. 
>Use the `$media_type` argument to differentiate between **image** and **video** media in the response.
You will also receive the user_has_liked field which tells you whether the owner of the access_token has liked this media.
A media object's shortcode can be found in its shortlink URL.
An example shortlink is http://instagram.com/p/tsxp1hhQTG/. Its corresponding shortcode is **tsxp1hhQTG**.

- `getMediaByID($token, $media_id, $media_type)` :  Get information about a media object using its ID.
>Use the `$media_type` argument to differentiate between image and video media in the response.
You will also receive the user_has_liked field which tells you whether the owner of the access_token has liked this media.

- `searchMedia($token, $lat, $lng, $distance)` : Search for recent media in a given area.

- `postComment($token, $media_id, $text)` : Create a comment on a media object.
>Creating comment on a media object should be following these rules : 
-The total length of the comment cannot exceed 300 characters.
-The comment cannot contain more than 4 hashtags.
-The comment cannot contain more than 1 URL.
-The comment cannot consist of all capital letters.

- `getMediaComments($token, $media_id)` : Get a list of recent comments on a media object.

- `deleteComment($token, $media_id, $comment_id)` : Remove a comment either on the authenticated user's media object or authored by the authenticated user.

- `getTagInfo($token, $tag_name)` : Get information about a tag object.

- `searchTag($token, $query)` : Search for tags by name.
>The `$query` argument accepts A valid tag name without a leading (#). (eg. snowy, nofilter).

- `getRecentlyTaggedMedia($token, $tag_name, $count)` : Get a list of recently tagged media.
>The `$tag_name` argument accepts A valid tag name without a leading (#). (eg. snowy, nofilter).

- `getLikes($token, $media_id)` : Get a list of users who have liked this media.

- `setLike($token, $media_id)` : Set a like on this media by the currently authenticated user.

- `deleteLike($token, $media_id)` : Remove a like on this media by the currently authenticated user.

- `getFollows($token)` : Get the list of users this user follows.

- `getFollowedBy($token)` : Get the list of users this user is followed by.

- `getRequestedBy($token)` :  List the users who have requested this user's permission to follow.

- `getRelationShip($token, $user_id)` : Get information about a relationship to another user.
>Relationships are expressed using the following terms in the response:
-outgoing_status: Your relationship to the user. Can be **'follows'**, **'requested'**, **'none'**.
-incoming_status: A user's relationship to you. Can be **'followed_by'**, **'requested_by'**, **'blocked_by_you'**, **'none'**.

- `changeRelationShip($token, $user_id, $action)` : Modify the relationship between the current user and the target user.
>You need to include an `$action` parameter to specify the relationship action you want to perform.
Valid actions are: **'follow'**, **'unfollow'**, **'approve'** or **'ignore'**.
Relationships are expressed using the following terms in the response:
-outgoing_status: Your relationship to the user. Can be **'follows'**, **'requested'**, **'none'**.
-incoming_status: A user's relationship to you. Can be **'followed_by'**, **'requested_by'**, **'blocked_by_you'**, **'none'**.

>NOTE that some functions like (`getFollows($token)` , `getLikes($token, $media_id)` ,...) may return **empty** results if your application is still in **SandBox** mode. Instagram will not give you access to get **non-sandbox** users data untill your application become live.

***
The above functions are making most of Instagram API calls.
The code and project structure are needing improvements and some development for sure.
***
Visit [Instagram Developers Websie](https://www.instagram.com/developer/) for more information about Instagram's API and to access the full documentation.
***
Feel free to contact me and give me feedback please (ashrafhesham1992@gmail.com) ,, Thanks ,, 
