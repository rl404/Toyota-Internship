function upperCaseF(a){
    setTimeout(function(){
        a.value = a.value.toUpperCase();
    }, 1);
}
function submitForm(a) {
   document.getElementById(a).submit();
}

$(document).ajaxStart(function(){
   $('#ajaxloading').show();
});

$(document).ajaxStop(function(){
   var x = document.getElementsByClassName("table"); 
   sorttable.makeSortable(x[0]);

   $('.table').fixMe();
   $('#ajaxloading').hide();
   $('.detailjobview').popup();
});

$(document).ready(function() {
   
   // input/project.php
   $('#projectcode').keyup(function (event) {
      event.preventDefault();  // Do not run the default action
      var submittedproject = document.getElementById("projectcode").value;
      $.ajax({
         type: 'POST',
         url:  'projectchecker.php',
         data: { project: submittedproject }
      })
         .done( function (responseText) {
            $('#projectcheck').html(responseText);
         })
   });

   // update/update.php
   $("#inputhourtable").on("change","#jobweek", function(event){
     event.preventDefault();  // Do not run the default action
      var submittedweek = document.getElementById("jobweek").value;
      var submittedmonth = document.getElementById("jobmonth").value;
      var submittedyear = document.getElementById("jobyear").value;
      $.ajax({
         type: 'POST',
         url:  'updatetable.php',
         data: { week: submittedweek, month: submittedmonth, year: submittedyear }
      })
         .done( function (responseText) {
            $('#inputhourtable').html(responseText);
         })
   });

   $("#inputhourtable").on("change","#jobmonth", function(event){
     event.preventDefault();  // Do not run the default action
      var submittedweek = document.getElementById("jobweek").value;
      var submittedmonth = document.getElementById("jobmonth").value;
      var submittedyear = document.getElementById("jobyear").value;
      $.ajax({
         type: 'POST',
         url:  'updatetable.php',
         data: { week: submittedweek, month: submittedmonth, year: submittedyear }
      })
         .done( function (responseText) {
            $('#inputhourtable').html(responseText);
         })
   });

   var delayTimer;
   $("#inputhourtable").on("keyup","#jobyear", function(event){
      event.preventDefault();  // Do not run the default action
      var submittedweek = document.getElementById("jobweek").value;
      var submittedmonth = document.getElementById("jobmonth").value;
      var submittedyear = document.getElementById("jobyear").value;

      clearTimeout(delayTimer);
      delayTimer = setTimeout(function() {         
         $.ajax({
            type: 'POST',
            url:  'updatetable.php',
            data: { week: submittedweek, month: submittedmonth, year: submittedyear }
         })
            .done( function (responseText) {
               $('#inputhourtable').html(responseText);
            })
      }, 1000);       
   });

   // homepage.php
   $('#homepage').on("change","#jobmonth", function (event) {
      event.preventDefault();  // Do not run the default action
      var submittedmonth = document.getElementById("jobmonth").value;
      var submittedyear = document.getElementById("jobyear").value;
      $.ajax({
         type: 'POST',
         url:  'summary.php',
         data: { month: submittedmonth, year: submittedyear }
      })
         .done( function (responseText) {
            $('#summarytable').html(responseText);
         })
   });  

   $('#homepage').on("keyup","#jobyear", function (event) {
      event.preventDefault();  // Do not run the default action
      var submittedmonth = document.getElementById("jobmonth").value;
      var submittedyear = document.getElementById("jobyear").value;
      $.ajax({
         type: 'POST',
         url:  'summary.php',
         data: { month: submittedmonth, year: submittedyear }
      })
         .done( function (responseText) {
            $('#summarytable').html(responseText);
         })
   });

   // viewer/viewer.php
   $('#worklisttable').on("change","#jobweek", function (event) {
      event.preventDefault();  // Do not run the default action
      var submittedweek = document.getElementById("jobweek").value;
      var submittedmonth = document.getElementById("jobmonth").value;
      var submittedyear = document.getElementById("jobyear").value;
      $.ajax({
         type: 'POST',
         url:  'worklist.php',
         data: { week: submittedweek, month: submittedmonth, year: submittedyear }
      })
         .done( function (responseText) {
            $('#worklisttable').html(responseText);
         })
   });

   $('#worklisttable').on("change","#jobmonth", function (event) {
      event.preventDefault();  // Do not run the default action
      var submittedweek = document.getElementById("jobweek").value;
      var submittedmonth = document.getElementById("jobmonth").value;
      var submittedyear = document.getElementById("jobyear").value;
      $.ajax({
         type: 'POST',
         url:  'worklist.php',
         data: { week: submittedweek, month: submittedmonth, year: submittedyear }
      })
         .done( function (responseText) {
            $('#worklisttable').html(responseText);
         })
   });

   var delayTimer;
   $('#worklisttable').on("keyup","#jobyear", function (event) {
      event.preventDefault();  // Do not run the default action
      var submittedweek = document.getElementById("jobweek").value;
      var submittedmonth = document.getElementById("jobmonth").value;
      var submittedyear = document.getElementById("jobyear").value;

      clearTimeout(delayTimer);
      delayTimer = setTimeout(function() { 
         $.ajax({
            type: 'POST',
            url:  'worklist.php',
            data: { week: submittedweek, month: submittedmonth, year: submittedyear }
         })
            .done( function (responseText) {
               $('#worklisttable').html(responseText);
            })      
      }, 1000); 
   });

   // report/project.php
   $('#homepage').on("input","#projectname", function (event) {
      event.preventDefault();  // Do not run the default action
      var submittedproject = document.getElementById("projectname").value;
      var submittedmonth = document.getElementById("projectmonth").value;
      var submittedyear = document.getElementById("projectyear").value;
      $.ajax({
         type: 'POST',
         url:  'projecttable.php',
         data: { project: submittedproject, month: submittedmonth, year: submittedyear }
      })
         .done( function (responseText) {
            $('#reportprojecttable').html(responseText);
         })
   });

   $('#homepage').on("change","#projectmonth", function (event) {
      event.preventDefault();  // Do not run the default action
      var submittedproject = document.getElementById("projectname").value;
      var submittedmonth = document.getElementById("projectmonth").value;
      var submittedyear = document.getElementById("projectyear").value;
      $.ajax({
         type: 'POST',
         url:  'projecttable.php',
         data: { project: submittedproject, month: submittedmonth, year: submittedyear }
      })
         .done( function (responseText) {
            $('#reportprojecttable').html(responseText);
         })
   });

   $('#homepage').on("keyup","#projectyear", function (event) {
      event.preventDefault();  // Do not run the default action
      var submittedproject = document.getElementById("projectname").value;
      var submittedmonth = document.getElementById("projectmonth").value;
      var submittedyear = document.getElementById("projectyear").value;
      $.ajax({
         type: 'POST',
         url:  'projecttable.php',
         data: { project: submittedproject, month: submittedmonth, year: submittedyear }
      })
         .done( function (responseText) {
            $('#reportprojecttable').html(responseText);
         })
   });

   // report/job.php
    $('#homepage').on("input","#jobname", function (event) {
      event.preventDefault();  // Do not run the default action
      var submittedjob = document.getElementById("jobname").value;
      var submittedmonth = document.getElementById("jobmonth").value;
      var submittedyear = document.getElementById("jobyear").value;
      $.ajax({
         type: 'POST',
         url:  'jobtable.php',
         data: { job: submittedjob, month: submittedmonth, year: submittedyear }
      })
         .done( function (responseText) {
            $('#reportjobtable').html(responseText);
         })
   });

    $('#homepage').on("change","#jobmonth", function (event) {
      event.preventDefault();  // Do not run the default action
      var submittedjob = document.getElementById("jobname").value;
      var submittedmonth = document.getElementById("jobmonth").value;
      var submittedyear = document.getElementById("jobyear").value;
      $.ajax({
         type: 'POST',
         url:  'jobtable.php',
         data: { job: submittedjob, month: submittedmonth, year: submittedyear }
      })
         .done( function (responseText) {
            $('#reportjobtable').html(responseText);
         })
   });

    $('#homepage').on("keyup","#jobyear", function (event) {
      event.preventDefault();  // Do not run the default action
      var submittedjob = document.getElementById("jobname").value;
      var submittedmonth = document.getElementById("jobmonth").value;
      var submittedyear = document.getElementById("jobyear").value;
      $.ajax({
         type: 'POST',
         url:  'jobtable.php',
         data: { job: submittedjob, month: submittedmonth, year: submittedyear }
      })
         .done( function (responseText) {
            $('#reportjobtable').html(responseText);
         })
   });

   // report/dept.php
   $('#homepage').on("input","#deptname", function (event) {
      event.preventDefault();  // Do not run the default action
      var submitteddept = document.getElementById("deptname").value;
      var submittedmonth = document.getElementById("deptmonth").value;
      var submittedyear = document.getElementById("deptyear").value;
      $.ajax({
         type: 'POST',
         url:  'depttable.php',
         data: { dept: submitteddept, month: submittedmonth, year: submittedyear }
      })
         .done( function (responseText) {
            $('#reportdepttable').html(responseText);
         })
   });

   $('#homepage').on("change","#deptmonth", function (event) {
      event.preventDefault();  // Do not run the default action
      var submitteddept = document.getElementById("deptname").value;
      var submittedmonth = document.getElementById("deptmonth").value;
      var submittedyear = document.getElementById("deptyear").value;
      $.ajax({
         type: 'POST',
         url:  'depttable.php',
         data: { dept: submitteddept, month: submittedmonth, year: submittedyear }
      })
         .done( function (responseText) {
            $('#reportdepttable').html(responseText);
         })
   });

   $('#homepage').on("keyup","#deptyear", function (event) {
      event.preventDefault();  // Do not run the default action
      var submitteddept = document.getElementById("deptname").value;
      var submittedmonth = document.getElementById("deptmonth").value;
      var submittedyear = document.getElementById("deptyear").value;
      $.ajax({
         type: 'POST',
         url:  'depttable.php',
         data: { dept: submitteddept, month: submittedmonth, year: submittedyear }
      })
         .done( function (responseText) {
            $('#reportdepttable').html(responseText);
         })
   });

   // report/staff.php
   $('#homepage').on("input","#deptname2", function (event) {
      event.preventDefault();  // Do not run the default action
      var submitteddept = document.getElementById("deptname2").value;
      var submittedmonth = document.getElementById("staffmonth").value;
      var submittedyear = document.getElementById("staffyear").value;
      $.ajax({
         type: 'POST',
         url:  'stafftable.php',
         data: { dept: submitteddept, month: submittedmonth, year: submittedyear }
      })
         .done( function (responseText) {
            $('#reportstafftable').html(responseText);
         })
   });

   $('#homepage').on("change","#staffmonth", function (event) {
      event.preventDefault();  // Do not run the default action
      var submitteddept = document.getElementById("deptname2").value;
      var submittedmonth = document.getElementById("staffmonth").value;
      var submittedyear = document.getElementById("staffyear").value;
      $.ajax({
         type: 'POST',
         url:  'stafftable.php',
         data: { dept: submitteddept, month: submittedmonth, year: submittedyear }
      })
         .done( function (responseText) {
            $('#reportstafftable').html(responseText);
         })
   });

   $('#homepage').on("keyup","#staffyear", function (event) {
      event.preventDefault();  // Do not run the default action
      var submitteddept = document.getElementById("deptname2").value;
      var submittedmonth = document.getElementById("staffmonth").value;
      var submittedyear = document.getElementById("staffyear").value;
      $.ajax({
         type: 'POST',
         url:  'stafftable.php',
         data: { dept: submitteddept, month: submittedmonth, year: submittedyear }
      })
         .done( function (responseText) {
            $('#reportstafftable').html(responseText);
         })
   });

});

// fixed table header
(function($) {
   $.fn.fixMe = function() {
      return this.each(function() {
         var $this = $(this),
            $t_fixed;
         function init() {
            $this.wrap('<div class="tablecontainer" />');
            $t_fixed = $this.clone();
            $t_fixed.find("tbody").remove().end().addClass("fixed").insertBefore($this);
            resizeFixed();
         }
         function resizeFixed() {
            $t_fixed.find("th").each(function(index) {
               $(this).css("width",$this.find("th").eq(index).outerWidth()+"px");
            });
         }
         function scrollFixed() {
            var offset = $(this).scrollTop(),
            tableOffsetTop = $this.offset().top,
            tableOffsetBottom = tableOffsetTop + $this.height() - $this.find("thead").height();
            if(offset < tableOffsetTop || offset > tableOffsetBottom)
               $t_fixed.hide();
            else if(offset >= tableOffsetTop && offset <= tableOffsetBottom && $t_fixed.is(":hidden"))
               $t_fixed.show();
         }
         $(window).resize(resizeFixed);
         $(window).scroll(scrollFixed);
         init();
      });
   };
})(jQuery);

$(document).ready(function(){
   $("table").fixMe();
   $(".up").click(function() {
      $('html, body').animate({
         scrollTop: 0
      }, 2000);
   });

   $('.detailjobview').popup();
});
