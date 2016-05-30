<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="/admin/assets/global/plugins/respond.min.js"></script>
<script src="/admin/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="/admin/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/select2/select2.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="/admin/assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/admin/assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/flot/jquery.flot.pie.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/flot/jquery.flot.tooltip.min.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/flot/jquery.flot.resize.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/jquery-clones/jquery.clones.js" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="/admin/assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="/admin/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="/admin/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="/admin/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="/admin/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="/admin/assets/admin/pages/scripts/index.js" type="text/javascript"></script>
<script src="/admin/assets/admin/pages/scripts/custom.js" type="text/javascript"></script>
<script src="/admin/assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
<script src="/admin/assets/global/plugins/jstree/dist/jstree.js" type="text/javascript"></script>
<script src="/admin/assets/jquery.tablesorter.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   QuickSidebar.init(); // init quick sidebar
   Demo.init(); // init demo features 
   Index.init();   
   Index.initDashboardDaterange();
   Index.initJQVMAP(); // init index page's custom scripts
   Index.initCalendar(); // init index page's custom scripts
   Index.initCharts(); // init index page's custom scripts
   Index.initChat();
   Index.initMiniCharts();
   Tasks.initDashboardWidget();
   $('[data-toggle]').tooltip();
   $(".clones").clones();
   $("#sample_editable_1").tablesorter(); 
   $(".advance-select").select2({
      dir: "rtl",
      language: "fa"
   });
   $('#html1').jstree({
      "core" : {
                "themes" : {
                    "responsive": false
               }
            },
      "types" : {
         "default" : {
            "icon" : "fa fa-code-fork icon-state-warning icon-lg"
         },
         "file" : {
            "icon" : "fa fa-file icon-state-warning icon-lg"
         }
      },
      "plugins": ["types"]
   });
   $("#excelBtn").click(function(){
      $("#excel_export").val("excel");
      $("#optional").get(0).submit();   
   });
   $("#submit_search").click(function() {
      $("#excel_export").val("");
      $("#optional").get(0).submit();
   });
   $(document).on("click",".jstree-anchor", function(){
      var id = $(this).closest("li").attr("id");
      $("#layerid").val(id);

      var value = [];
      $(".jstree-clicked").each(function(index){
         value[index] = $(this).closest("li").attr("id");
      });
      $("#multilayer").val(value.toString());
   });

  
    $(".tools .fa-search").click(function(){
      $(".search-holder").toggle("fast");
    });
});
$(function() {
  @if(@$siteAna)
      @foreach($siteAna as $key => $value)
        var d{{$key}} =  {!! pArrayTojArray($value) !!}
      @endforeach

      var data = [
      @foreach($siteAna as $key => $value)
          {
              label: "{{$label[$key]}}",
              data: d{{$key}},
              lines: {
                show: true,
                barWidth: 0.13,
                fill: false,
                lineWidth: 1,
                order: 1,
              }
          } ,   
      @endforeach
      ];

      var options = {
               xaxis: {
                  mode: "categories",
                  tickLength: 0
               }
            }
      $.plot("#placeholder", data, options);

  @endif   
  @if(@$pie_data)
    var data = {!! $pie_data !!}
         
      $.plot($("#placeholder4"), data, {
         series: {
            pie: {
              show: true,
              radius: 1,
              label: {
                show: false,
                radius: 3/4,
                // formatter: labelFormatter,
                background: {
                  opacity: 0.5,
                  color: '#000'
                }
              }
            }
         },
         grid: {
            hoverable: true
         },
         tooltip: {
            show: true,
            content: "%p.0%, %s, n=%n", // show percentages, rounding to 2 decimal places
            shifts: {
              x: 20,
              y: 0
         },
            defaultTheme: false
         }
    });
  @endif
    
});
</script>
<!-- END JAVASCRIPTS -->