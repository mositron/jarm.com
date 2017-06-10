<style>
.div-text{padding:7px 0px 7px;border-bottom:1px dashed #ccc;}
.btn-app {border-radius: 3px;position: relative;padding: 15px 5px;margin: 0 0 10px 10px;min-width: 80px;height: 60px;text-align: center;color: #666;border: 1px solid #ddd;background-color: #f4f4f4;font-size: 12px;}
.btn-app>.badge {position: absolute;top: -3px;right: -10px;font-size: 10px;font-weight: 400;}
.btn-app>.fa, .btn-app>.glyphicon, .btn-app>.ion {font-size: 20px;display: block;}
select.form-control + .chosen-container-multi .chosen-choices li.search-choice{margin:3px 5px 3px 0px;}
.fc-content{color:#fff;}
.fc table{background:transparent;}
</style>
<ul class="breadcrumb">
	<li><a href="/"><span class="glyphicon glyphicon-home"></span> Team</a></li>
  <span class="divider">&raquo;</span>
	<li><a href="/queue">คิวงาน</a></li>
  <span class="divider">&raquo;</span>
	<li><a href="/queue/calendar">ตารางงาน</a></li>
	<?php if(self::$path[1]=='production'):?>
	<span class="divider">&raquo;</span>
	<li><a href="/queue/calendar/production">Production</a></li>
	<?php elseif(self::$path[1]=='photographer'):?>
	<span class="divider">&raquo;</span>
	<li><a href="/queue/calendar/photographer">Photographer</a></li>
<?php elseif(self::$path[1]=='content'):?>
	<span class="divider">&raquo;</span>
	<li><a href="/queue/calendar/content">Content</a></li>
	<?php endif?>
</ul>

<div class="box-white">
	<div>
		<div id="calendar"></div>
	</div>
</div>
<script>
$(function(){
	$('#calendar').fullCalendar({
		header: {
		  left: 'prev,next today',
		  center: 'title',
		  right: 'myCustomButtonList,myCustomButtonMonth'
		},
		customButtons: {
		    myCustomButtonMonth: {
		        click: function() {
		          $('#calendar').fullCalendar('changeView', 'month');
		        }
		    },
		    myCustomButtonList: {
		        click: function() {
		          $('#calendar').fullCalendar('changeView', 'agendaDay');
		        }
		    },
		},
		buttonText: { today: 'วันนี้'},
		eventLimit: ($(window).width()<510)?false:true, // for all non-agenda views
		defaultView: 'month',
		//Random default events
		timeFormat: 'H:mm' ,
		theme: true,
		events: {
    	url: '<?php echo URL?>',
			type: 'POST',
			data: {
					ajax:'getdata',
			},
			error: function() {
					alert('there was an error while fetching events!');
			},
			color: 'yellow',   // a non-ajax option
			textColor: 'black' // a non-ajax option
    },
		dayClick: function(date, jsEvent, view)
		{
		  $('#calendar').fullCalendar('gotoDate', date);
		  $('#calendar').fullCalendar('changeView', 'agendaDay');
		  if (checkFirstClickShowAllInDay) {
		  	myCustomToggles();
		  	checkFirstClickShowAllInDay = false;
		  }
		  // console.log(view);
		  // window.open(site_url+'admin/'+uri_segment2+'/'+uri_segment3+'/calendar/'+ID+'/add/'+date.format(), "_self");
		},

	});
	$('.fc-myCustomButtonMonth-button').addClass('fc-state-toggle fc-state-disabled').attr('disabled','disabled').html('<i class="fa fa-calendar"></i> <span class="hidden-xs">ดูแบบปฏิทิน</span>')
	$('.fc-myCustomButtonList-button').addClass('fc-state-toggle').html('<i class="fa fa-list"></i> <span class="hidden-xs">ดูแบบรายการ</span>')
	$('.fc-state-toggle').click(function() {
		myCustomToggles();
	});

	$('.fc-myCustomButtonMonth-button').click(function() {
		checkFirstClickShowAllInDay = true;
	});

	var checkFirstClickShowCalendar = true;

	$('.col-md-9 .btn.btn-box-tool').click(function() {
		if(checkFirstClickShowCalendar)
		{
			$('.fc-today-button').click();
			checkFirstClickShowCalendar = false;
		}
	});
	function myCustomToggles()
	{
		$.fn.toggleDisabled = function(){
		    return this.each(function(){
		        this.disabled = !this.disabled;
		    });
		};
		$('.fc-state-toggle').toggleClass('fc-state-disabled').toggleDisabled();
	}
});
</script>
