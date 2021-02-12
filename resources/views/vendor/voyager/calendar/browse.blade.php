@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.$dataType->getTranslatedAttribute('display_name_plural'))

@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('lib/main.min.css') }}">
@stop
@section('css')
<style>
  #calendar {
    max-width: 1100px;
    margin: 0 auto;
  }
</style>
@stop

@section('page_header')
<div class="container-fluid">
  <h1 class="page-title">
    <i class="{{ $dataType->icon }}"></i> {{ $dataType->getTranslatedAttribute('display_name_plural') }}
  </h1>

</div>
@stop


@section('content')
<div class="page-content browse container-fluid">
  @include('voyager::alerts')
  <div id='calendar'></div>
</div>
@stop
@section('javascript')
<script type="text/javascript" src="{{ asset('lib/sweetalert2.all.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('lib/main.min.js') }}"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prevYear,prev,next,nextYear today',
        center: 'title',
        right: 'dayGridMonth,dayGridWeek,timeGridDay'
      },
      selectable: true,
      selectMirror: true,
      locale: 'fr',
      weekends: true,
      navLinks: true,
      dayMaxEvents: true,
      businessHours: {
        startTime: '09:00',
        endTime: '17:00',
      },

      eventSources: [{
          url: '/vvci/events'
        }

      ],
      editable: true,
      select: function(arg) {
        let title = prompt('Titre de l\'événement:');
        let start_formatted = arg.start.getFullYear() + '-' + (arg.start.getMonth() + 1) + '-' + arg.start.getDate() + ' ' + '{{ date('H:i:s') }}';
        let end_formatted = arg.end.getFullYear() + '-' + (arg.end.getMonth() + 1) + '-' + (arg.end.getDate() - 1) + ' ' + '23:59:59';
        if (title) {
          $.ajax({
            type: "POST",
            url: "/vvci/events/store",
            data: {
              title: title,
              start: start_formatted,
              end: end_formatted
            },
            success: function(data) {
              Swal.fire({
                position: 'center',
                title: 'Événement Ajouté!',
                icon: 'success',
                showConfirmationButton: false,
                timer: 500
              });
              location.reload();
            },
          });

        }
        calendar.unselect()
      },
      eventDrop: function(arg) {
        let start_formatted = arg.event.start.getFullYear() + '-' + (arg.event.start.getMonth() + 1) + '-' + arg.event.start.getDate() + ' ' + arg.event.start.getHours() + ':' + arg.event.start.getMinutes() + ':' + arg.event.start.getSeconds();
        let end_formatted = arg.event.end.getFullYear() + '-' + (arg.event.end.getMonth() + 1) + '-' + arg.event.end.getDate() + ' ' + arg.event.end.getHours() + ':' + arg.event.end.getMinutes() + ':' + arg.event.end.getSeconds();
        $.ajax({
          type: "POST",
          url: "/vvci/events/update",
          data: {
            id: arg.event.id,
            start: start_formatted,
            end: end_formatted
          },
          success: function(data) {
            Swal.fire({
              position: 'center',
              title: 'Événement Modifié!',
              icon: 'success',
              showConfirmationButton: false,
              timer: 500
            });
          }
        });
      },
      eventResize: function(arg) {
        let start_formatted = arg.event.start.getFullYear() + '-' + (arg.event.start.getMonth() + 1) + '-' + arg.event.start.getDate() + ' ' + arg.event.start.getHours() + ':' + arg.event.start.getMinutes() + ':' + arg.event.start.getSeconds();
        let end_formatted = arg.event.end.getFullYear() + '-' + (arg.event.end.getMonth() + 1) + '-' + arg.event.end.getDate() + ' ' + arg.event.end.getHours() + ':' + arg.event.end.getMinutes() + ':' + arg.event.end.getSeconds();
        $.ajax({
          type: "POST",
          url: "/vvci/events/update",
          data: {
            id: arg.event.id,
            start: start_formatted,
            end: end_formatted
          },
          success: function(data) {
            Swal.fire({
              position: 'center',
              title: 'Événement Modifié!',
              icon: 'success',
              showConfirmationButton: false,
              timer: 500
            });
          }
        });
      },
      eventClick: function(arg) {
        const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
            denyButton: 'btn btn-danger',
            cancelButton: 'btn btn-light'
          },
          buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
          title: 'Veuillez choisir une action :',
          icon: 'info',
          showDenyButton: true,
          showCancelButton: true,
          confirmButtonText: 'Afficher',
          cancelButtonText: 'Annuler',
          denyButtonText: 'Supprimer'

        }).then((result) => {
          if (result.isConfirmed) {
            const link = "{{url('/')}}" + "/vvci/calendar/" + arg.event.id;
            window.location.href = link;
          } else if (result.isDenied) {
            $.ajax({
              type: "POST",
              url: "/vvci/events/delete",
              data: {
                id: arg.event.id,
              },
              success: function(data) {
                Swal.fire({
                  position: 'center',
                  title: 'Événement Supprimé!',
                  icon: 'success',
                  showConfirmationButton: false,
                  timer: 500
                });
              }
            });
            arg.event.remove()
          } else {

            swalWithBootstrapButtons.fire(
              'Annulé',
              'Votre événement est en sécurité :)',
              'error'
            )
          }
        })
      }
    });
    calendar.render();
  });
</script>
@stop