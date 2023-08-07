$(document).on("click", ".dropbtn", function() {
	$(this).parents(".dropdown").find(".dropdown-content").toggleClass("show");
})

$(document).on("click", ".fix", function() {
    $(this).parents("form").find(".fixques").css("display", "block");
    $(this).parents("form").find(".fix1").css("display", "block");
    $(this).parents("form").find(".displayques").css("display", "none");
    $(this).css("display", "none");
})
  
  // Close the dropdown if the user clicks outside of it
  window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }

function displayform(str){
    var classList = document.getElementsByClassName("addform");
    for (var i = 0; i < classList.length; i++) {
      if (classList.item(i).id == str) {
        classList.item(i).style.display = "grid";
      }
      else {
        classList.item(i).style.display = "none";
      }
   }
   
}

function display(id) {
  document.getElementById(id).style.display = "grid";
}

function displayMonSelect(id) {
  console.log("test");
  var monHoc = document.querySelector(id+" aside fieldset form #courses");
  var list = document.querySelectorAll("#subjects > option");
  for(var i = 1; i < list.length;i++) {
    list[i].style.display="none";
  }

  document.querySelector(id+" aside fieldset form #subjects").selectedIndex = 0;
  var listMonHoc = document.getElementsByClassName(monHoc.value);
  console.log(monHoc.value);
  for(var i = 0; i < listMonHoc.length;i++) {
    listMonHoc[i].style.display="block";
    console.log(listMonHoc[i].textContent);
  }
}

function fixques() {
  $(this).parents("form").find(".fixques").css("display", "block");
  $(this).parents("form").find(".displayques").css("display", "none");
  $(this).css("display").css("display", "none");
}

function toPdf() {
  var doc = new jsPDF('','pt','a4');
  doc.addFont("Times New Roman", 'Times', 'serif');
  doc.setFont("Times");
  console.log(doc.getFontList());
  // We'll make our own renderer to skip this editor
      var specialElementHandlers = {
          '#editor' : function(element, renderer) {
              return true;
          }
      };
  
      // All units are in the set measurement for the document
      // This can be changed to "pt" (points), "mm" (Default), "cm", "in"
      doc.fromHTML($('#exam').get(0), 15, 15, {
          'width' : 250,
          'font': 14,
          'elementHandlers' : specialElementHandlers
      });
  
      doc.save('Đề thi thử.pdf');
  }