/*
* Author: Brian Treichel, Ting Ting Lin, Ziming Qi
* Purpose: Conestoga College Winter 2018 Capstone Project
* Date created: 2018-03-25
* File name: home.js
*/
function apiLogin(){
    $.ajax({
        type: "POST",
        datatype:"json",
        url: "http://sample.data.crea.ca/Login.svc/Login",
        data:({
            Username : 'CXLHfDVrziCfvwgCuL8nUahC',
            password: 'mFqMsCSPdnb5WO1gpEEtDCHH'
        }),
        success: function(result)
        {
            if(result && result.auth_token.length>1) // you should do your checking here
            {
                $('#message').empty()
                    .append('Success');
            }
            else
            {
                $('#message').empty().addClass('error')
                    .append('Something is wrong.');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(jqXHR.status);
        }
    });
    // var xhttp = createCORSRequest("POST","http://sample.data.crea.ca/Login.svc/Login");
    //     if (!xhttp) {
    //     throw new Error('CORS not supported');
    // }
    // xhttp.send();
    // xhttp.onload = function() {
    //     if (this.readyState == 4 && this.status == 200) {
    //         var myObj = JSON.parse(this.responseText);
    //         document.getElementById("temp").innerHTML = JSON.stringify(myObj);
    //     }
    // };
    // xhttp.onerror = function() {
    //     console.log('There was an error!');
    // };
}

function apiSearch(){
    apiLogin();
}

function createCORSRequest(method, url) {
    var xhr = new XMLHttpRequest();
    if ("withCredentials" in xhr) {

        // Check if the XMLHttpRequest object has a "withCredentials" property.
        // "withCredentials" only exists on XMLHTTPRequest2 objects.
        xhr.open(method, url, true);

    } else if (typeof XDomainRequest != "undefined") {

        // Otherwise, check if XDomainRequest.
        // XDomainRequest only exists in IE, and is IE's way of making CORS requests.
        xhr = new XDomainRequest();
        xhr.open(method, url);

    } else {

        // Otherwise, CORS is not supported by the browser.
        xhr = null;

    }
    return xhr;
}