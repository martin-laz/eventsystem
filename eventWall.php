<?php
    include './EventClass.php';
    $event = new EventSystem;
    $events[] = $event-> getUserEvents(1);

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/eventWall.css" />
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
  <div class="container">
  		<div class="row">
  			<div class="[ col-xs-12 col-sm-offset-2 col-sm-8 ]">
  				<ul class="event-list">
            <?php
            foreach ($events[0] as $key => $value) {
                $eventInfo = $event->getEvent(intval($value));
                echo $eventInfo['time'];  

            }
            ?>
  					<li>
  						<time datetime="2014-07-20 2000">
  							<span class="day">20</span>
  							<span class="month">Jan</span>
  							<span class="year">2014</span>
  							<span class="time">8:00 PM</span>
  						</time>
  						<img alt="My 24th Birthday!" src="https://farm5.staticflickr.com/4150/5045502202_1d867c8a41_q.jpg" />
  						<div class="info">
  							<h2 class="title">Mouse0270's 24th Birthday!</h2>
  							<p class="desc">Bar Hopping in Erie, Pa.</p>
  							<ul>
  								<li style="width:50%;">1 <span class="glyphicon glyphicon-ok"></span></li>
  								<li style="width:50%;">3 <span class="fa fa-question"></span></li>
  							</ul>
  						</div>

  					</li>

  				</ul>
  			</div>
  		</div>
  	</div>


</body>
</html>
