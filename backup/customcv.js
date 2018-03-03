//
// Nanna Ellegaard custom script for parsing resume.json
// using this tool: https://github.com/JMPerez/linkedin-to-json-resume
//

var customCV = function ($) {
    $(document).ready(function () {
      var resume = '../../includes/cv/resume.json';
      $.getJSON(resume, function(data) {
          // basics
          console.log(data);
          $.each(data, function(i, item) {
              // Basics
              if (i === "basics") {
                  var name = item.name;
                  var label = item.label;
                  var summary = item.summary;
                  console.log(name);
                  console.log(label);
                  console.log(summary);
                  // Loope one level deeper
                  //   $.each(item, function(j, value) {
                  //       console.log(value);
                  //   })
              }
          });

          // Work
          data.work.forEach(function(w) {
              var company = w.company;
              var position = w.position;
              var summary = w.summary;
              var website = w.website;
              var startDate = w.startDate;
              var endDate = w.endDate;
              console.log(company);
              console.log(position);
              console.log(summary);
          });

          // Education
          data.education.forEach(function(e) {
              var institution = e.institution;
              var studyType = e.studyType;
              var startDate = e.startDate;
              var endDate = e.endDate;
              console.log(institution);
          });

          // Skills
          data.skills.forEach(function(s) {
              var name = s.name;
              console.log(name);
          });

          // References
          data.references.forEach(function(r) {
              var name = r.name;
              var ref = r.reference;
              console.log(name);
          });
      });
    });
}(jQuery);
