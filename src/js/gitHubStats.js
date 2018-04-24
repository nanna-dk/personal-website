// ******
// © Nanna Ellegaard
// Fetch commit data from GitHub API
// http://www.e-nanna.dk 2018
// ******

var getGitHubStats = function($) {
  $(document).ready(function() {
    // Function to fetch commit data from repo on GitHub
    var stats = $('#gitHubStats');
    function fetchDatafromGitHub() {
      var user = "nanna-dk";
      var repo = "personal-website"
      var gitHubUrl = "https://github.com/" + user + "/" + repo + "/commit/";
      var url = "https://api.github.com/repos/" + user + "/" + repo + "/commits";
      $.ajax({
        type: 'GET',
        url: url,
        dataType: "json",
        success: function(data) {
          //console.log(data);
          var newData = data.reduce((acc, el) => {
            var date = el.commit.committer.date;
            var msg = el.commit.message;
            var sha = el.sha;
            var d = date.split('T')[0];
            var commitUrl = gitHubUrl + sha;
            var commit = ' <a href="' + commitUrl + '" target="_blank" rel="noopener">' + msg + '</a>';

            if (acc.hasOwnProperty(d))
              acc[d].push(commit);
            else
              acc[d] = [commit];
            return acc;
          }, {})

          Object.keys(newData).forEach(function(v, k) {
            var date = v;
            var t = new Date(date);
            var day = ("0" + (
            t.getDate())).slice(-2);
            var month = ("0" + (
            t.getMonth() + 1)).slice(-2);
            var year = t.getFullYear();

            stats.append('<li>' + day + '/' + month + '/' + year + ': ' + newData[v] + '</li>');
          });
          stats.children().wrapAll("<ul class='list-unstyled' />");
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    }
    fetchDatafromGitHub();
  });
}(jQuery);
