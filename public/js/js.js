var App = {};

$(function(){

    $(document).foundation();

    App.$bodyContentWrapper = $('body > .body-content-wrapper');
    App.$footer             = $('body > .footer');

    $(window).bind('resize',App.flex);
    App.flex();

});


//Keep the footer at the bottom of the screen.
App.flex = function(){

    var height = $(window).height() - App.$footer.outerHeight();
    height = height - parseInt(App.$bodyContentWrapper.css('margin-top'));
    App.$bodyContentWrapper.css('min-height',height);

}//flex





//**************************************************
//**************************************************
//      Disco PHP Framework default js functions
//**************************************************
//**************************************************


// Print a string with a format like PHP
// use like:
//
//      var string = '{0} string {1}';
//      string = string.format('this','is cool');
//
// First, checks if it isn't implemented yet.
if (!String.prototype.format) {
    String.prototype.format = function() {
        var args = arguments;
        return this.replace(/{(\d+)}/g, function(match, number) { 
            return typeof args[number] != 'undefined' ? args[number] : match ;
        });
    };
}


//Replace all occurances of substring in string
String.prototype.replaceAll = function(find,replace){
    var str = this;
    return str.split(find).join(replace);
};


// Array Remove - By John Resig (MIT Licensed)
 Array.prototype.remove = function(from, to) {
   var rest = this.slice((to || from) + 1 || this.length);
    this.length = from < 0 ? this.length + from : from;
    return this.push.apply(this, rest);
};


//set the title of the page
App.setTitle = function(title){
    $('title').text(title);
}//setTitle


//get a cookie by name
App.getCookie = function(name){
    var regexp = new RegExp("(?:^" + name + "|;\\s*"+ name + ")=(.*?)(?:;|$)", "g");
    var result = regexp.exec(document.cookie);
    return (result === null) ? null : decodeURIComponent(result[1]);
}//getCookie


//delete a cookie
App.deleteCookie = function(name,path,domain) {
    if(getCookie(name)){
        createCookie(name,"",-1,path,domain);
    }//if
}//deleteCookie


//create a cookie
App.createCookie = function(name, value, expires, path, domain) {
    var cookie = name + "=" + escape(value) + ";";
    if (expires) {
        if(expires instanceof Date) {
            if (isNaN(expires.getTime())){
                expires = new Date();
            }//if
        }//if
        else{
            expires = new Date(new Date().getTime() + parseInt(expires) * 1000 * 60 * 60 * 24);
        }//el

        cookie += "expires=" + expires.toGMTString() + ";";
    }//if

    if (path)
        cookie += "path=" + path + ";";
    if (domain)
        cookie += "domain=" + domain + ";";
    document.cookie = cookie;
}//createCookie
