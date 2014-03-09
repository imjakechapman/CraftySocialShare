CraftySocialShare
================

Simple Social Button Plugin for keeping templates clear of random script tags and social button markup everywhere.


## Usage

In order for the buttons to work, you need to load the social buttons scripts. Best place would be just above the closing body tag.

    {{ SocialShareScripts() }}
    
Now call your buttons anywhere you want

    {{ SocialBtn('facebook') }}
    {{ SocialBtn('twitter') }}
    {{ SocialBtn('google') }}
    
Or for all the buttons

    {{ SocialBtns() }}
    
    
You can also specify a script for only one button. (exclude script coming soon.)

    // Load only the facebook script 
    {{ SocialShareScripts('facebook') }}
    
And call that button

    {{ SocialBtn('facebook') }}


## TODO
1. Accept pipe delimited list of scripts to load {{ SocialShareScripts('facebook|twitter') }}
2. Accept a script/s to exclude {{ SocialShareScripts('not google|facebook') }} for when other buttons are added
3. Accept a button/s to exclude {{ SocialBtns('not facebook|twitter') }} for when other buttons are added
4. Accept an array of parameters for when calling a specific button {{ SocialBtn('facebook', ["width" => "125", "url" => "http://example.com"]) }}
