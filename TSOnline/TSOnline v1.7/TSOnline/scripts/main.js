// Convert inputted key to upper case
function upperCaseF(a){
    setTimeout(function(){
        a.value = a.value.toUpperCase();
    }, 1);
}

// Submit form
function submitForm(a) {
   document.getElementById(a).submit();
}

// When ajax starts, show loading gif
$(document).ajaxStart(function(){
   $('#ajaxloading').show();
});

// When ajax ends, hide loading gif
$(document).ajaxStop(function(){
   $('#ajaxloading').hide();
});

// Jquery
$(document).ready(function() {

   // Jquery for checkbox (from Semantic-ui)
   $('.ui.checkbox').checkbox();

   // Jquery for message (from Semantic-ui)
   $(".container").on("click",".message .close", function(event){
       $(this).closest('.message').transition('fade');
   });

   // 
   // $(".container").on("click","#datatsrow", function(event){
   //     $('.ui.modal').modal('show');
   // });

   // Month dropdown on homepage.php
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

   // Year textbox on homepage.php
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

   // TS search box on list/ts.php 
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

   // Supplier search box on list/supplier.php
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

   // Check TS number and rev everytime finished typing on request/request.php
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

   // Convert button on update/tsauto.php
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

   // Check TS number and rev everytime finished typing on update/tsmanual.php
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

   // Supplier search box on export/export1search1.php
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

   // Send all data in table to pdf creator on export/export2convert.php
   $('#coverletterconvertbutton').click(function (event) {
      event.preventDefault();  // Do not run the default action
      var submittedsetdate = 0;
      var submittedreqdate = document.getElementById("reqdate").value; 
      var submittedsupplier = document.getElementById("suppliername").value;
      var submittedts = [];
         $("input[name='tsno']").each(function() {submittedts.push($(this).val());});
      var submittedrev = [];
         $("input[name='rev']").each(function() {submittedrev.push($(this).val());});       
      var submittedmodel = [];
         $("input[name='model']").each(function() {submittedmodel.push($(this).val());});
      var submittedpart = [];
         $("input[name='part']").each(function() {submittedpart.push($(this).val());});

      if ($('#senddate').is(':checked')) {
         submittedsetdate = 1;
      }

      $.ajax({
         type: 'POST',
         url:  'export2convert1.php',
         data: { supplier: submittedsupplier, 
            ts: submittedts, 
            rev: submittedrev,
            model: submittedmodel,
            part: submittedpart,
            setdate: submittedsetdate,
            reqdate: submittedreqdate }
      })
         .done( function (responseText) {
            $('#requestconvert').html(responseText);
         })
   });

   // Send all data in the form to pdf creator on export/exportmanual.php
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

// Show supplier list of selected TS on list/ts.php
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

// Show TS list of selected supplier on list/supplier.php
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

// Show request date list of selected supplier on export/export.php
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

// Show request detail of selected request date on export/export.php
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

// Add new row to bottom of table
function addNewRow(){        
   new_elem = $("#emptyrow").clone().appendTo("#newrow").show();     
};
