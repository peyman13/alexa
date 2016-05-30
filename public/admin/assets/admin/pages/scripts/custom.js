/**
Custom module for you to write your own javascript functions
**/
var Custom = function () {

    // private functions & variables

    var myFunc = function(text) {
        alert(text);
    }

    // public functions
    return {

        //main function
        init: function () {
            //initialize here something.            
        },

        //some helper function
        doSomeStuff: function () {
            myFunc();
        }

    };

    

}();

var doObject = {
    // set chunk stap
    setChunk: function(){
      $.cookie('chunk', $("#chunk").val(), { expires: 7, path: '/' });
      window.location = window.location.origin+window.location.pathname+window.location.search;
    }
};

$(document).on("click", "[data-remover]", function(e) {
    var url = $(this).data('remover');
    bootbox.dialog({
      message: "در صورت پاک کردن, آیتم قابل برگشت نمیباشد",
      title: '<i class="fa fa-exclamation"></i> آیا مطمئنید',
      buttons: {
        success: {
          label: "بله",
          className: "btn-success",
          callback: function() {
            window.location = url;
          }
        },
        danger: {
          label: "خیر",
          className: "btn-danger",
          callback: function() {
            $(".bootbox-close-button").trigger("click")
          }
        }
      }
    });
});

$(document).ready(function() {
    $(".openRow2").click(function() {
      $(this).closest('tr').next("tr").slideToggle();
    });

    $("[data-sort]").click(function() {
      $("#col").val($(this).data('sort').col);
      $("#order").val($(this).data('sort').col);
      $("#optional").get(0).submit();
    });
    
});


/***
Usage
***/
//Custom.init();
//Custom.doSomeStuff();