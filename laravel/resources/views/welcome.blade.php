<!DOCTYPE html>
<?php
    require_once("../entities/song.class.php");
?>
@extends('layouts.app')

@section('content')
<html>

   <head>
      <title>Sound Of Life</title>
      <link href = "https://fonts.googleapis.com/css?family=Lato:100" rel = "stylesheet" type = "text/css">

      <style>
         html, body {
            height: 100%;
         }
         body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
         }
         .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
         }
         .content {
            text-align: center;
            display: inline-block;
         }
         .title {
            font-size: 96px;
         }

        .button--small
        {
            width: 19px;
            height: 19px;
        }

        .button--large
        {
            width: 48px;
            height: 48px;
        }
        .player__play.is-playing
        {
            background-image: url("http://i57.tinypic.com/idyhd2.png");
        }

        .player__stop
        {
            background-image: url("http://i61.tinypic.com/35mehdz.png");
        }

        .player__previous
        {
            background-image: url("http://i60.tinypic.com/sdihc5.png");
        }

        .player__next
        {
            background-image: url("http://i57.tinypic.com/2s1nm77.png");
        }


      </style>
   </head>

   <body>

     <div class="container">
       <div class="row justify-content-center">
         <div>
           <div class="card">
             <div class="card-header">
               <b>SOUND</b>
             </div>
             <div class="card-body">

			 <p> Those are the latest hit we have</p>

        <!-- Song list -->
        <script type="text/javascript" src="{{ URL::asset('js/soundmanager2.js') }}"></script>

        <div class="row">
            <script>
                function formatMilliseconds(milliseconds) {
                    var hours = Math.floor(milliseconds / 3600000);
                    milliseconds = milliseconds % 3600000;
                    var minutes = Math.floor(milliseconds / 60000);
                    milliseconds = milliseconds % 60000;
                    var seconds = Math.floor(milliseconds / 1000);
                    milliseconds = Math.floor(milliseconds % 1000);

                    return (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
                }

                function playAudio(clicked_id, link, clicked_stop, timeElapsed, timeTotal, prev, next){
                    var temp = clicked_stop;

                    var player = {
                        btnPlay:  document.getElementById(clicked_id),
                        btnStop: document.getElementById(clicked_stop),
                        btnPrevious: document.getElementById(prev),
                        btnNext: document.getElementById(next),
                        btnVolumeDown: document.querySelector('.player__volume-down'),
                        btnVolumeUp: document.querySelector('.player__volume-up'),
                        timeElapsed: document.getElementById(timeElapsed),
                        timeTotal: document.getElementById(timeTotal),
                        volume: document.querySelector('.player__volume-info')
                    };

                    var audio = null;

                    soundManager.setup({

                        useFastPolling: true,
                        useHighPerformance: true,
                        onready: function() {
                            audio = soundManager.createSound({
                                id: clicked_id,

                                //   Insert link
                                url: link,
                                whileloading: function() {
                                    player.timeTotal.textContent = formatMilliseconds(audio.durationEstimate);
                                },
                                whileplaying: function() {
                                    player.timeElapsed.textContent = formatMilliseconds(audio.position);
                                },
                                onload: function() {
                                    player.timeTotal.textContent = formatMilliseconds(audio.duration);
                                },
                                onfinish: function() {
                                    var event;
                                    try {
                                        // Internet Explorer doesn't like this statement
                                        event = new Event('click');
                                    } catch (ex) {
                                        event = document.createEvent('MouseEvent');
                                        event.initEvent('click', true, false);
                                    }
                                    player.btnStop.dispatchEvent(event);
                                }
                            });
                        }
                    });

                    player.btnPrevious.addEventListener('click', function() {
   if (audio === null) {
     return;
   }

   var position = audio.position - 30000 < 0 ? 0 : audio.position - 30000;
   audio.setPosition(position);
   player.timeElapsed.textContent = formatMilliseconds(audio.position);
});

player.btnNext.addEventListener('click', function() {
   if (audio === null) {
     return;
   }

   var position = audio.position + 30000 > audio.duration ? audio.duration : audio.position + 30000;
   if (position === audio.duration) {
      var event;
      try {
         // Internet Explorer does not like this statement
         event = new Event('click');
      } catch (ex) {
         event = document.createEvent('MouseEvent');
         event.initEvent('click', true, false);
      }
      player.btnStop.dispatchEvent(event);
   } else {
      audio.setPosition(position);
      player.timeElapsed.textContent = formatMilliseconds(audio.position);
   }
});

                    player.btnStop.addEventListener('click', function() {
                        if (audio === null) {
                            return;
                        }

                        audio.stop();
                        document.getElementById(timeElapsed).textContent = formatMilliseconds(0);
                        player.btnPlay.classList.remove('is-playing');


                    });

                    if (audio === null) {
                        return;
                    }

                    if (audio.playState === 0 || audio.paused === true) {
                        audio.play();
                        this.classList.add('is-playing');
                    } else {
                        audio.pause();
                        this.classList.remove('is-playing');
                    }



                }
            </script>

            <?php
                    $listCount = -1;
                    $arraySong = array();
                    foreach($songs as $song) {
                        $listCount = $listCount + 1;
                        array_push($arraySong, "storage/mp3/" .$song->SONG_LINK);

                    ?>


                    <div style="height:100%; width:100%; border-radius: 25px; background:#f3f2f2; padding-left:15px; padding-right:15px; margin-left:15px; margin-right:25px; margin-bottom:20px">
                        <div style="float: left; width:15%; height:100%; overflow:hidden; padding-left:20px; padding-top:15px;">
                            <a> <img src="<?php echo "storage/songIMG/" .$song->SONG_IMGL_INK;?>" class="img-responsive" style="float:top; width:140px; height:140px; border-radius: 15px;"/></a>

                            <p class="text-danger" style="float:top; width:100%; height:40%">
                                <div>
                                    <span  id=<?php echo $listCount; ?> onClick ="playAudio(this.id,'<?php echo $arraySong[$listCount];?>','<?php echo $listCount."stop";?>','<?php echo $listCount."timeElapsed"; ?>','<?php echo $listCount."timeTotal"; ?>','<?php echo $listCount."prev"; ?>','<?php echo $listCount."next"; ?>')" ><img style="width:50px; height:50px" src="http://i67.tinypic.com/k2oilw.png"></span>
                                    <span id=<?php echo $listCount."stop"; ?>><img src="http://i68.tinypic.com/301kbqw.png"></span>
                                </div>
                            </p>
                        </div>

                        <div class="col-sm-12" style="float: left; width:60%; height:100%; overflow:hidden; padding-top:10px">

                            <span style="font-size: 200%;" class="text-danger"><?php echo $song->SONG_TITLE; ?> - </span>
                            <span style="font-size: 150%;" class="text-info"><?php echo $song->ARTIST; ?></span>
                            </br>
                            <div style="margin-top:20px">
                                <span style="color:blue; font-size: 130%;" id=<?php echo $listCount."timeElapsed"; ?> class="font_time">-</span>/
                                <span style="color:blue; font-size: 130%;;" id=<?php echo $listCount."timeTotal"; ?> class="font_time">-</span>
                            </div>

                            <span id="<?php echo $listCount."prev"; ?>" ><img src="http://i63.tinypic.com/14nd2r9.png"></span>
                            <span id="<?php echo $listCount."next"; ?>"><img src="http://i67.tinypic.com/21ovedt.png"></span>

                        </div>

                        </br>
                        </br>
                    </div>
                    
            <?php } ?>
        </div>

        </div>

    </div>
    </body>

</html>
  @endsection
