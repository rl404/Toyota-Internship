function upperCaseF(a){
    setTimeout(function(){
        a.value = a.value.toUpperCase();
    }, 1);
}

function submitForm(a) {
   document.getElementById(a).submit();
}

$(document).ready(function() {
   // homepage.php
   $('#summarybutton').click(function (event) {
      event.preventDefault();  // Do not run the default action
      var submittedmonth = document.getElementById("summarymonth").value;
      var submittedyear = document.getElementById("summaryyear").value;
      $.ajax({
         type: 'POST',
         url:  'summary.php',
         data: { month: submittedmonth, year: submittedyear }
      })
         .done( function (responseText) {
            $('#summaryresult').html(responseText);
         })
   });

   // list/ts.php 
   $('#tsinputsearch').keyup(function(event) {
      event.preventDefault();  // Do not run the default action
      var submittedts = document.getElementById("tsinputsearch").value;
      $.ajax({
         type: 'POST',
         url:  'tssearch.php',
         data: { ts: submittedts }
      })
         .done( function (responseText) {
            $('#tsresultsearch').html(responseText);
         })
   });

   // list/supplier.php
   $('#supplierinputsearch').keyup(function(event) {
      event.preventDefault();  // Do not run the default action
      var submittedsupplier = document.getElementById("supplierinputsearch").value;
      $.ajax({
         type: 'POST',
         url:  'suppliersearch.php',
         data: { supplier: submittedsupplier }
      })
         .done( function (responseText) {
            $('#supplierresultsearch').html(responseText);
         })
   });

   // request/request.php
   $('#inputsupp').keyup(function(event) {
      event.preventDefault();  // Do not run the default action
      var submittedsupp = document.getElementById("inputsupp").value;
      $.ajax({
         type: 'POST',
         url:  'requestsuggestion.php',
         data: { supp: submittedsupp }
      })
         .done( function (responseText) {
            $('#suppdatalist').html(responseText);
         })
   });

   // request/request.php
   $('#inputtsrev').keyup(function (event) {
      event.preventDefault();  // Do not run the default action
      var submittedsupp = document.getElementById("inputsupp").value;
      var submittedtsrev = document.getElementById("inputtsrev").value;
      submittedtsrev = submittedtsrev.replace(/\n\r?/g, '*');
      $.ajax({
         type: 'POST',
         url:  'requesttsconvert.php',
         data: { tsrev: submittedtsrev, supp: submittedsupp }
      })
         .done( function (responseText) {
            $('#convertedtsrev').html(responseText);
         })
   });

   // update/tsauto.php
   $('#convertts').click(function (event) {
      event.preventDefault();  // Do not run the default action
      var submittedts = document.getElementById("tsarea").value;
      submittedts = submittedts.replace(/\n\r?/g, '*');
      $.ajax({
         type: 'POST',
         url:  'tsautoconvert.php',
         data: { ts: submittedts }
      })
         .done( function (responseText) {
            $('#convertedts').html(responseText);
         })
   });

   // update/tsmanual.php
   $('#inputts').keyup(function(event) {
      event.preventDefault();  // Do not run the default action
      var submittedts = document.getElementById("inputts").value;
      $.ajax({
         type: 'POST',
         url:  'tssuggestion.php',
         data: { ts: submittedts }
      })
         .done( function (responseText) {
            $('#tsdatalist').html(responseText);
         })
   });

   // update/tsmanual.php
   $('#inputrev').keyup(function(event){
      event.preventDefault();  // Do not run the default action
      var submittedts = document.getElementById("inputts").value;
      var submittedrev = document.getElementById("inputrev").value;
      $.ajax({
         type: 'POST',
         url:  'tsxrev.php',
         data: { ts: submittedts, rev: submittedrev}
      })
         .done( function (responseText) {
            $('#revisioncheck').html(responseText);
         })
   });  

   // export/export1search1.php
   $('#exportsuppliersearchinput').keyup(function(event) {
      event.preventDefault();  // Do not run the default action
      var submittedsupplier = document.getElementById("exportsuppliersearchinput").value;
      $.ajax({
         type: 'POST',
         url:  'export1search1.php',
         data: { supplier: submittedsupplier }
      })
         .done( function (responseText) {
            $('#requestsearch').html(responseText);
         })
   });

   // export/export2convert.php
   $('#coverletterconvertbutton').click(function (event) {
      event.preventDefault();  // Do not run the default action
      var submittedsupplier = document.getElementById("suppliername").value;
      var submittedts = document.getElementById("tsnoinput").value;
      var submittedrev = document.getElementById("tsrevinput").value;
      var submittedmodel = document.getElementById("modelinput").value;
      var submittedpart = document.getElementById("partinput").value;
      $.ajax({
         type: 'POST',
         url:  'export2convert1.php',
         data: { supplier: submittedsupplier, 
            ts: submittedts, 
            rev: submittedrev,
            model: submittedmodel,
            part: submittedpart }
      })
         .done( function (responseText) {
            $('#requestconvert').html(responseText);
         })
   });
});

function showSupplier(a){
   var submittedts = a;
   $.ajax({
      type: 'POST',
      url:  'tsxsupplier.php',
      data: { ts: submittedts }
   })
      .done( function (responseText) {
         $('#tsxsupplierresult').html(responseText);
      })
}

function showTS(a){
   var submittedsupplier = a;
   $.ajax({
      type: 'POST',
      url:  'supplierxts.php',
      data: { supplier: submittedsupplier }
   })
      .done( function (responseText) {
         $('#supplierxtsresult').html(responseText);
      })
}

function showRequest(a){
   var submittedsupplier = a;
   $.ajax({
      type: 'POST',
      url:  'export1search2.php',
      data: { supplier: submittedsupplier }
   })
      .done( function (responseText) {
         $('#requestsearch1').html(responseText);
      })
}

function showRequestDetail(a,b){
   var submittedsupplier = a;
   var submitteddate = b;
   $.ajax({
      type: 'POST',
      url:  'export1search3.php',
      data: { supplier: submittedsupplier, reqdate: submitteddate }
   })
      .done( function (responseText) {
         $('#requestsearch2').html(responseText);
      })
}