//POST REQUEST

$(document).ready(function () {
  $("#postMessage").click(function (e) {
    e.preventDefault();

    //serialize form data
    var url = $("form").serialize();

    //function to turn url to an object
    function getUrlVars(url) {
      var hash;
      var myJson = {};
      var hashes = url.slice(url.indexOf("?") + 1).split("&");
      for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split("=");
        myJson[hash[0]] = hash[1];
      }
      return JSON.stringify(myJson);
    }

    //pass serialized data to function
    var test = getUrlVars(url);

    //post with ajax
    $.ajax({
      type: "POST",
      url: "api/post/create.php",
      data: test,
      ContentType: "application/json",

      success: function () {
        alert("successfully posted");
      },
      error: function () {
        alert("Could not be posted");
      },
    });
  });
});

//GET REQUEST

document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("getMessage").onclick = function () {
    var req;
    req = new XMLHttpRequest();
    req.open("GET", "api/post/read.php", true);
    req.send();

    req.onload = function () {
      var json = JSON.parse(req.responseText);
      var posts = json["data"];
      var output = "";

      if (posts.length > 0) {
        output += "<div class = 'cat'>";
        //looping though recieved posts
        for (let post of posts) {
          console.log(post.id + ": " + post.title);
          output +=
            "<strong>" +
            post.title +
            "</strong>: <br><small> <b>Author: </b>" +
            post.author +
            "<br> " +
            post.body +
            "</small><br><br>";
        }
        output += "</div><br>";
      }

      //append in message class
      document.getElementsByClassName("message")[0].innerHTML = output;
    };
  };
});
