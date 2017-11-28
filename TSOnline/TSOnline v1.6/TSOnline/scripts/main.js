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
   $('#ajaxloading').hide();
});

$(document).ready(function() {
   $(".container").on("click",".message .close", function(event){
       $(this).closest('.message').transition('fade');
   });

   $(".container").on("click","#datatsrow", function(event){
       $('.ui.modal').modal('show');
   });

   // homepage.php
   $('#summarymonth').change(function (event) {
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

   $('#summaryyear').keyup(function (event) {
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
   var delayTimer;
   $('#tsinputsearch').keyup(function(event) {
      event.preventDefault();  // Do not run the default action
      var submittedts = document.getElementById("tsinputsearch").value;
      clearTimeout(delayTimer);
      delayTimer = setTimeout(function() {         
         $.ajax({
            type: 'POST',
            url:  'tssearch.php',
            data: { ts: submittedts }
         })
            .done( function (responseText) {
               $('#tsresultsearch').html(responseText);
            })
      }, 300);       
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
   $(".container").on("keyup", "#inputrev", function(event){
      event.preventDefault();  // Do not run the default action
      var submittedsupp = document.getElementById("inputsupp").value;
      var submittedts = $("input[id='inputts']")
              .map(function(){return $(this).val();}).get();

      var submittedrev = $("input[id='inputrev']")
              .map(function(){return $(this).val();}).get();

      $.ajax({
         type: 'POST',
         url:  'requesttsconvert.php',
         data: { ts: submittedts, rev: submittedrev, supp: submittedsupp }
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
      var submittedts = [];
         $("input[name='tsno']").each(function() {submittedts.push($(this).val());});
      var submittedrev = [];
         $("input[name='rev']").each(function() {submittedrev.push($(this).val());});       
      var submittedmodel = [];
         $("input[name='model']").each(function() {submittedmodel.push($(this).val());});
      var submittedpart = [];
         $("input[name='part']").each(function() {submittedpart.push($(this).val());});

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

   // export/exportmanual.php
   $(".container").on("click", "#coverlettercreatebutton", function(event){
      event.preventDefault();  // Do not run the default action
      var submittedsupp = document.getElementById("inputsupp").value;
      
      var submittedts = $("input[id='inputts']").map(function(){return $(this).val();}).get();
      var submittedrev = $("input[id='inputrev']").map(function(){return $(this).val();}).get();
      var submittedmodel = $("input[id='inputmodel']").map(function(){return $(this).val();}).get();
      var submittedpart = $("input[id='inputpart']").map(function(){return $(this).val();}).get();
      
      var submittedday = document.getElementById("reqday").value;
      var submittedmonth = document.getElementById("reqmonth").value;
      var submittedyear = document.getElementById("reqyear").value;

      $.ajax({
         type: 'POST',
         url:  'export2convert1.php',
         data: { ts: submittedts, rev: submittedrev, supplier: submittedsupp,
         model: submittedmodel, part: submittedpart, day: submittedday,
         month: submittedmonth, year: submittedyear }
      })
         .done( function (responseText) {
            $('#manualconvert').html(responseText);
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

function addNewRow(){        
   new_elem = $("#emptyrow").clone().appendTo("#newrow").show();     
};
