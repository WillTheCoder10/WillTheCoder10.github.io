<link rel="stylesheet" href="main.css" />

<?
require_once('TwitterAPIExchange.php');
/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "2775296680-R1du6dMAtjoYaPCUhLChCQbSm1mCR1KAi8sRWaT",
    'oauth_access_token_secret' => "qxltG8YTctMontew6TEPftu7NwYxQBaqnrEVkJaeEpdvd",
    'consumer_key' => "mx71XyVYx140qLCl7XVAqNkKc",
    'consumer_secret' => "7GnCLPhcTIsaDhTp0Gq2LUExMRlf6vHG20Q3ysBmssNaDBvKws"
);
$url = "https://api.twitter.com/1.1/search/tweets.json";
$requestMethod = "GET";
$searchfield = "?f=tweets&vertical=default&q=’random’ AND -filter:retweets &src=typd";
$getfield = $searchfield . "&count=100&result_type=mixed&tweet_mode=extended";
$twitter = new TwitterAPIExchange($settings);
$string = json_decode($twitter->setGetfield($getfield)
->buildOauth($url, $requestMethod)
->performRequest(),true);
if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}
shuffle($string['statuses']);
$i = 1;
foreach($string['statuses'] as $tweets) {
 $time = $tweets['created_at'];
 $id = $tweets['id'];
 $source = $tweets['source'];
 $tweet = $tweets['full_text'];
 $name = $tweets['user']['name'];
 $user = $tweets['user']['screen_name'];
 $profile_image = $tweets['user']['profile_image_url'];
 $followers = $tweets['user']['followers_count'];
 $friends = $tweets['user']['friends_count'];
 $listed = $tweets['user']['listed_count'];
echo "Time and Date of Tweet: " . $time ."<br />";
  echo "ID of Tweet: " . $id . "<br />";
  echo "Source of Tweet: " . $source . "<br />";
        echo "Tweet: ". $tweet ."<br />";
        echo "Tweeted by: ". $name ."<br />";
        echo "Screen name: ". $user ."<br />";
  echo "<a href=\"http://twitter.com/$user\">@$user</a><br />";
  echo "<img src=\"".$profile_image."\" width=\"100px\" height=\"100px\" /><br />";
        echo "Followers: ". $followers ."<br />";
        echo "Friends: ". $friends ."<br />";
        echo "Listed: ". $listed ."<br /><hr />";
 $i++;
   if($i == 2) break;
}
echo "<button type='button' class='btn'  onClick='window.location.reload()'>Anotha One</button>";
?>
