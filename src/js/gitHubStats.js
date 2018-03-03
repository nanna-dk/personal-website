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
          $.each(data, function(k, v) {
            var date = v.commit.committer.date;
            var message = v.commit.message;
            var t = new Date(date);
            var day = ("0" + (t.getDate())).slice(-2);
            var month = ("0" + (t.getMonth() + 1)).slice(-2);
            var year = t.getFullYear();
            var allDates = $.makeArray(date);
            console.log(allDates);
            var sha = v.sha;
            gitHubStats.append('<li>' + day + '/' + month + '/' + year + ": <a href=" + gitHubUrl + sha + " target='_blank' rel='noopener'>" + message + '</li>');
            return k < maxHits;
          });
          gitHubStats.children().wrapAll( "<ul class='list-unstyled' />");
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    }
    fetchDatafromGitHub();
  });
}(jQuery);
