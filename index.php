<!doctype html>
<html lang="en">

<head>
      <title>Calendar</title>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
      <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
      <script>
      // prepare Jquery
      $(document).ready(function() {
            // tampilkan calender
            var calendar = $('#calendar').fullCalendar({
                  // izinkan edit table
                  editable: true,
                  // menampilkan opsi calendar
                  header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                  },
                  // event ketika di load
                  events: 'koneksi.php',
                  selectable: true,
                  selectHelper: true,
                  // fungsi untuk mengirim atribut
                  select: function(start, end, allDay) {
                        var title = prompt("Masukkan judul events");

                        $("#calendar").fullCalendar({
                              dayRender: function(date, cell) {
                                    cell.css("background-color",
                                          "red");
                              }
                        });

                        if (title) {
                              var start = $.fullCalendar.formatDate(start,
                                    "Y-MM-DD HH:mm:ss");
                              var end = $.fullCalendar.formatDate(end,
                                    "Y-MM-DD HH:mm:ss");
                              $.ajax({
                                    url: "tambah.php",
                                    type: "POST",
                                    data: {
                                          title: title,
                                          start: start,
                                          end: end
                                    },
                                    success: function() {
                                          calendar
                                                .fullCalendar(
                                                      'refetchEvents'
                                                );
                                          alert(
                                                "Added Successfully"
                                          );
                                    }
                              })
                        }
                  },
                  editable: true,
                  eventResize: function(event) {
                        var start = $.fullCalendar.formatDate(event.start,
                              "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(event.end,
                              "Y-MM-DD HH:mm:ss");
                        var title = event.title;

                        var id = event.id;
                        $.ajax({
                              url: "update.php",
                              type: "POST",
                              data: {
                                    title: title,
                                    start: start,
                                    end: end,
                                    id: id
                              },
                              success: function() {
                                    calendar.fullCalendar(
                                          'refetchEvents'
                                    );
                                    alert('Event Update');
                              }
                        })
                  },

                  eventDrop: function(event) {
                        var start = $.fullCalendar.formatDate(event.start,
                              "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(event.end,
                              "Y-MM-DD HH:mm:ss");
                        var title = event.title;
                        var id = event.id;
                        $.ajax({
                              url: "update.php",
                              type: "POST",
                              data: {
                                    title: title,
                                    start: start,
                                    end: end,
                                    id: id
                              },
                              success: function() {
                                    calendar.fullCalendar(
                                          'refetchEvents'
                                    );
                                    alert("Event Updated");
                              }
                        });
                  },

                  eventClick: function(event) {
                        if (confirm("Apakah kamu yakin menghapus ini")) {
                              var id = event.id;
                              $.ajax({
                                    url: "hapus.php",
                                    type: "POST",
                                    data: {
                                          id: id
                                    },
                                    success: function() {
                                          calendar
                                                .fullCalendar(
                                                      'refetchEvents'
                                                );
                                          alert(
                                                "Event Removed"
                                          );
                                    }
                              })
                        }
                  },

            });
      });
      </script>
</head>

<body>
      <br>

      <h2 class="text-center">Admin Calendar</h2>
      <br>
      <div class="container">
            <div id="calendar">

            </div>
      </div>

      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->



</body>

</html>