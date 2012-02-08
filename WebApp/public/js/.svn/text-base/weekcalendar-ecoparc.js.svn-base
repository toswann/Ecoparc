$(document).ready(function() {
// 01/12/2042

   var $calendar = $('#calendar');
   var id = 10;

   $calendar.weekCalendar({
      displayOddEven:true,
      timeslotsPerHour : 4,
      allowCalEventOverlap : false,
      overlapEventsSeparate: false,
      firstDayOfWeek : 1,
      timeslotHeight : 10,
      businessHours :{start: 8, end: 18, limitDisplay: false },
      use24Hour: true,
      daysToShow : 7,
      switchDisplay: {'1 day': 1, '3 next days': 3, 'work week': 5, 'full week': 7},
      title: function(daysToShow) {
			return daysToShow == 1 ? '%date%' : '%start% - %end%';
      },
      height : function($calendar) {
         return $(window).height() - $("#top-view-planning").height() - $("#top-view-planning").height() - 2;
      },
      eventRender : function(calEvent, $event) {
         if (calEvent.end.getTime() < new Date().getTime()) {
            $event.css("backgroundColor", "#aaa");
            $event.find(".wc-time").css({
               "backgroundColor" : "#999",
               "border" : "1px solid #888"
            });
         }
      },
      draggable : function(calEvent, $event) {
//          console.log("draggable");
         return calEvent.readOnly != true;
      },
      resizable : function(calEvent, $event) {
         return calEvent.readOnly != true;
      },
      eventNew : function(calEvent, $event) {
         var $dialogContent = $("#event_edit_container");
         resetForm($dialogContent);
         var startField = $dialogContent.find("select[name='start']").val(calEvent.start);
         var endField = $dialogContent.find("select[name='end']").val(calEvent.end);
         var titleField = $dialogContent.find("input[name='title']");
         var bodyField = $dialogContent.find("select[name='body']");


         $dialogContent.dialog({
            modal: true,
            title: "Nouvel évènement",
            close: function() {
               $dialogContent.dialog("destroy");
               $dialogContent.hide();
               $('#calendar').weekCalendar("removeUnsavedEvents");
            },
            buttons: {
               save : function() {
                  calEvent.id = id;
                  id++;
                  calEvent.start = new Date(startField.val());
                  calEvent.end = new Date(endField.val());
                  calEvent.title = titleField.val();
                  calEvent.action = bodyField.val();

                  var nom = calEvent.title;
                  var heure_debut = calEvent.start.getHours()+":"+calEvent.start.getMinutes();
                  var heure_fin = calEvent.end.getHours()+":"+calEvent.end.getMinutes();

                  // @todo set la valeur du jour
                  //console.log(calEvent.start.getDay());
                  var jour = calEvent.start.getDay();
                  var action = calEvent.action;
                  url = "/planning/add-tache/planning_id_planning/"+id_planning+"/nom/"+nom+"/jour/"+jour+"/heure_debut/"+heure_debut+"/heure_fin/"+heure_fin+"/a/"+action;
                    $.get(url, function(d) {
                            a = (d != "ok") ? errors("Impossible de modifier cet évènement") : alerts("Evènement ajouté.");
                    });

                  $calendar.weekCalendar("removeUnsavedEvents");
                  $calendar.weekCalendar("updateEvent", calEvent);
                  $dialogContent.dialog("close");

               },
               cancel : function() {
                  $dialogContent.dialog("close");
               }
            }
         }).show();

         $dialogContent.find(".date_holder").text($calendar.weekCalendar("formatDate", calEvent.start));
         setupStartAndEndTimeFields(startField, endField, calEvent, $calendar.weekCalendar("getTimeslotTimes", calEvent.start));

      },
      eventDrop : function(calEvent, $event) {
          console.log("drop!");
          var id_event = calEvent.id
          var heure_debut = calEvent.start.getHours()+":"+calEvent.start.getMinutes();
          var heure_fin = calEvent.end.getHours()+":"+calEvent.end.getMinutes();
          var jour = calEvent.start.getDay();
          url = "/planning/drop-tache/planning_id_planning/"+id_planning+"/id_planning_tache/"+id_event+"/jour/"+jour+"/heure_debut/"+heure_debut+"/heure_fin/"+heure_fin;
          $.get(url, function(d) {
            a = (d != "ok") ? errors("Impossible de modifier le planning.") : alerts("Planning modifié.");
          });
      },
      eventResize : function(calEvent, $event) {
          console.log("resize!");
          var id_event = calEvent.id
          var heure_fin = calEvent.end.getHours()+":"+calEvent.end.getMinutes();
          url = "/planning/resize-tache/planning_id_planning/"+id_planning+"/id_planning_tache/"+id_event+"/heure_fin/"+heure_fin;
          $.get(url, function(d) {
            a = (d != "ok") ? errors("Impossible de modifier le planning.") : alerts("Planning modifié.");
          });
      },
      eventClick : function(calEvent, $event) {

         if (calEvent.readOnly) {
            return;
         }

         var $dialogContent = $("#event_edit_container");
         resetForm($dialogContent);
         var startField = $dialogContent.find("select[name='start']").val(calEvent.start);
         var endField = $dialogContent.find("select[name='end']").val(calEvent.end);
         var titleField = $dialogContent.find("input[name='title']").val(calEvent.title);
         var bodyField = $dialogContent.find("select[name='body']").val(calEvent.action);
         bodyField.val(calEvent.body);

         $dialogContent.dialog({
            modal: true,
            title: "Edit - " + calEvent.title,
            close: function() {
               $dialogContent.dialog("destroy");
               $dialogContent.hide();
               $('#calendar').weekCalendar("removeUnsavedEvents");
            },
            buttons: {
               save : function() {

                  calEvent.start = new Date(startField.val());
                  calEvent.end = new Date(endField.val());
                  calEvent.title = titleField.val();
                  calEvent.action = bodyField.val();
                  var id_event = calEvent.id
                  var nom = calEvent.title;
                  var heure_debut = calEvent.start.getHours()+":"+calEvent.start.getMinutes();
                  var heure_fin = calEvent.end.getHours()+":"+calEvent.end.getMinutes();
                  var jour = calEvent.start.getDay();
                  var action = calEvent.action;
                  url = "/planning/mod-tache/planning_id_planning/"+id_planning+"/id_planning_tache/"+id_event+"/nom/"+nom+"/jour/"+jour+"/heure_debut/"+heure_debut+"/heure_fin/"+heure_fin+"/a/"+action;
                    $.get(url, function(d) {
                            a = (d != "ok") ? errors("Impossible de modifier le planning.") : alerts("Planning modifié.");
                    });

                  $calendar.weekCalendar("updateEvent", calEvent);
                  $dialogContent.dialog("close");
               },
               "delete" : function() {
                   var id_event = calEvent.id
                   url = "/planning/del-tache/id_planning_tache/"+id_event;
                    $.get(url, function(d) {
                            a = (d != "ok") ? errors("Impossible de supprimer le planning.") : alerts("Planning supprimé.");
                    });
                  $calendar.weekCalendar("removeEvent", calEvent.id);
                  $dialogContent.dialog("close");
               },
               cancel : function() {
                  $dialogContent.dialog("close");
               }
            }
         }).show();

         var startField = $dialogContent.find("select[name='start']").val(calEvent.start);
         var endField = $dialogContent.find("select[name='end']").val(calEvent.end);
         var bodyField = $dialogContent.find("select[name='body']").val(calEvent.action);
         $dialogContent.find(".date_holder").text($calendar.weekCalendar("formatDate", calEvent.start));
         setupStartAndEndTimeFields(startField, endField, calEvent, $calendar.weekCalendar("getTimeslotTimes", calEvent.start));
         $(window).resize().resize(); //fixes a bug in modal overlay size ??

      },
      eventMouseover : function(calEvent, $event) {
      },
      eventMouseout : function(calEvent, $event) {
      },
      noEvents : function() {

      },
      data : function(start, end, callback) {
         callback(getEventData());
      }
   });

   function resetForm($dialogContent) {
      $dialogContent.find("input").val("");
      $dialogContent.find("textarea").val("");
   }

   function getEventData() {
      return (planning_events);
   }


   /*
    * Sets up the start and end time fields in the calendar event
    * form for editing based on the calendar event being edited
    */
   function setupStartAndEndTimeFields($startTimeField, $endTimeField, calEvent, timeslotTimes) {

      $startTimeField.empty();
      $endTimeField.empty();

      for (var i = 0; i < timeslotTimes.length; i++) {
         var startTime = timeslotTimes[i].start;
         var endTime = timeslotTimes[i].end;
         var startSelected = "";
         if (startTime.getTime() === calEvent.start.getTime()) {
            startSelected = "selected=\"selected\"";
         }
         var endSelected = "";
         if (endTime.getTime() === calEvent.end.getTime()) {
            endSelected = "selected=\"selected\"";
         }
         $startTimeField.append("<option value=\"" + startTime + "\" " + startSelected + ">" + timeslotTimes[i].startFormatted + "</option>");
         $endTimeField.append("<option value=\"" + endTime + "\" " + endSelected + ">" + timeslotTimes[i].endFormatted + "</option>");

         $timestampsOfOptions.start[timeslotTimes[i].startFormatted] = startTime.getTime();
         $timestampsOfOptions.end[timeslotTimes[i].endFormatted] = endTime.getTime();

      }
      $endTimeOptions = $endTimeField.find("option");
      $startTimeField.trigger("change");
   }

   var $endTimeField = $("select[name='end']");
   var $endTimeOptions = $endTimeField.find("option");
   var $timestampsOfOptions = {start:[],end:[]};

   //reduces the end time options to be only after the start time options.
   $("select[name='start']").change(function() {
      var startTime = $timestampsOfOptions.start[$(this).find(":selected").text()];
      var currentEndTime = $endTimeField.find("option:selected").val();
      $endTimeField.html(
            $endTimeOptions.filter(function() {
               return startTime < $timestampsOfOptions.end[$(this).text()];
            })
            );

      var endTimeSelected = false;
      $endTimeField.find("option").each(function() {
         if ($(this).val() === currentEndTime) {
            $(this).attr("selected", "selected");
            endTimeSelected = true;
            return false;
         }
      });

      if (!endTimeSelected) {
         //automatically select an end date 2 slots away.
         $endTimeField.find("option:eq(1)").attr("selected", "selected");
      }

   });



});
