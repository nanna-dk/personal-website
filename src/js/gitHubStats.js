// ******
// © Nanna Ellegaard fetch commit data from GitHub API
// http://www.e-nanna.dk 2018
// ******

var getGitHubStats = function($) {
  $(document).ready(function() {
    // Function to fetch commit data from repo on GitHub
    var gitHubStats = $('#gitHubStats');
    function fetchDatafromGitHub() {
      var user = "nanna-dk";
      var repo = "personal-website"
      var gitHubUrl = "https://github.com/" + user + "/" + repo + "/commit/";
      var url = "https://api.github.com/repos/" + user + "/" + repo + "/commits";
      var maxHits = 5;
      $.ajax({
        type: 'GET',
        url: url,
        dataType: "json",
        success: function(data) {
          console.log(data);
          var newData = data.reduce((acc, el) => {
            var date = el.commit.committer.date;
            var msg = el.commit.message;
            var sha = el.sha;
            console.log(sha);
            var d = date.split('T')[0];
            if (acc.hasOwnProperty(d))
              acc[d].push(msg);
            else
              acc[d] = [msg];
            return acc;
          }, {})
          Object.keys(newData).forEach(function(v, k) {
            //console.log(newData);
            var date = v;
            var message = newData[v].join(", ");
            var t = new Date(date);
            var day = ("0" + (
            t.getDate())).slice(-2);
            var month = ("0" + (
            t.getMonth() + 1)).slice(-2);
            var year = t.getFullYear();

            gitHubStats.append('<li>' + day + '/' + month + '/' + year + ': <a href=' + gitHubUrl + ' target="_blank" rel="noopener">' + message + '</a></li>');
          });
          gitHubStats.children().wrapAll("<ul class='list-unstyled' />");
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    }
    fetchDatafromGitHub();

  });
}(jQuery);
