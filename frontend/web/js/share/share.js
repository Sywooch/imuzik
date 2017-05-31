//$(function (){

var linkTwitter="https://twitter.com/intent/tweet?url=twitterUrl";
var linkFB="https://facebook.com/sharer.php?u=facebookUrl";
var linkGooglePlus="https://plus.google.com/share?url=googlePlusUrl";

$(function($, win){
//    initShare();
});

function initShare(name, link, image, description){
    $('#facebook_title').attr('content',htmlspecialchars(name));
    $('#facebook_url').attr('content',link);
    $('#facebook_image').attr('content',htmlspecialchars(image));
    $('#facebook_description').attr('content',description);
}

function getUrl(){
  return window.location.href;
}

function functionShare(link, name){
    if(link == undefined || link == ""){
        link = window.location.href;
    }
    
    $('#share-name').html(htmlspecialchars(name));
    $('#rbt-function-name').html(htmlspecialchars(name));
    $('#fa-twitter').attr('href', linkTwitter.replace('twitterUrl', link));
    $('#fa-google-plus').attr('href', linkGooglePlus.replace('googlePlusUrl', link));
    $('#fa-facebook').attr('href', linkFB.replace('facebookUrl', link));
    
    $('#facebook_title').attr('content',htmlspecialchars(name));
    $('#facebook_url').attr('content',link);
    
}
function functionSharePopupSong(link, name, val, slug){
    if(link == undefined || link == ""){
        link = window.location.href;
    }
    var listItems = $( "#playerExpandItemList li a.link-more" );
    var indexSong=(listItems.index(val));
    $('#popup-docker-player-name').html(name);
    $('#remove-song-playlist-index').val(indexSong);
    $('#song-playlist-slug').val(slug);

    $('#share-name').html(htmlspecialchars(name));
    $('#fa-twitter').attr('href', linkTwitter.replace('twitterUrl', link));
    $('#fa-google-plus').attr('href', linkGooglePlus.replace('googlePlusUrl', link));
    $('#fa-facebook').attr('href', linkFB.replace('facebookUrl', link));
    
        $('#facebook_title').attr('content',htmlspecialchars(name));
    $('#facebook_url').attr('content',link);
}

/*

 // You can also share to pinterest and tumblr:

 var options = {

 // Pinterest requires a image to be "pinned"

 pinterest: {
 media: 'http://example.com/image.jpg',
 description: 'My lovely picture'
 },

 // Tumblr takes a name and a description

 tumblr: {
 name: 'jQuery Social Buttons Plugin!',
 description: 'There is a new article on tutorialzine.com page! Check out!'
 }
 };

 */

//});
