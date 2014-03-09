CraftySocialShare
================

Simple Social Button Plugin for keeping templates clear of random script tags and social button markup everywhere.


## Usage

In order for the buttons to work, you need to load the social buttons scripts. Best place would be just above the closing body tag.

    {{ SocialShareScripts() }}
    You can specify scripts by using pipe delimiting list
    {{ SocialShareScripts('facebook|google') }}
    

Now display your buttons

    {{ SocialBtns() }} // This will display the default for all buttons
    
Sometimes we want more control over the outputted button attributes.
The template tag accepts an array of parameters that can be passed to a specific button.
For a list of parameters check out the developer guide for each individual button type. If a parameter is not passed it will fallback to the buttons default value.

    {{ SocialBtn('facebook', {"width": "150px", "action": "like", 'layout': "box_count", "faces": 'true', "share": 'false'}) }}
    {{ SocialBtn('twitter', {"size": "small", "via": "imjakechapman", "text": "checkout CraftySocialShare for CraftCMS", "count": "vertical", "lang": "en", "counturl": "http://twitter.com", "related": "craftcms:The Ultimate CMS by Pixel&Tonic", "hashtags": "craftcms", "opt-out": "false"}) }}
    {{ SocialBtn('google', {"href": "https://github.com/imjakechapman/CraftySocialShare", "size": "tall", "annotation": "bubble", "align": "left", "expandTo": "top", "recommendations": "true", "count": "true"}) }}
    
    
You can also specify a script for only one button.

    // Load only the facebook script 
    {{ SocialShareScripts('facebook') }}
    
And call that button

    {{ SocialBtn('facebook') }} // default
    {{ SocialBtn('facebook', {"width": "150px", "action": "like", 'layout': "box_count", "faces": 'true', "share": 'false'}) }} // with opt parameters passed through


## TODO
1. Refactor where needed
2. Add more button options
