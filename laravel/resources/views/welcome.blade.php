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

                    return (hours > 0 ? hours : '0') + ':' + (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds + ':' + (milliseconds < 100 ? '0' : '') + (milliseconds < 10 ? '0' : '') + milliseconds;
                }

                function playAudio(clicked_id, link){
                    var temp = link;
                                    
                    var player = {
                        btnPlay:  document.getElementById(clicked_id),
                        btnStop: document.querySelector('.player__stop'),
                        btnPrevious: document.querySelector('.player__previous'),
                        btnNext: document.querySelector('.player__next'),
                        btnVolumeDown: document.querySelector('.player__volume-down'),
                        btnVolumeUp: document.querySelector('.player__volume-up'),
                        timeElapsed: document.querySelector('.player__time-elapsed'),
                        timeTotal: document.querySelector('.player__time-total'),
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
                    <div class="col-sm-9">
                        <a> <img src="<?php echo "storage/songIMG/" .$song->SONG_IMGL_INK;?>" class="img-responsive" style="width:10%"/></a>
                        <p class="text-danger"><?php echo $song->SONG_TITLE; ?></p>
                        <p class="text-info"><?php echo $song->ARTIST; ?></p>

                        <p class="text-danger">
                            <div>
                                <button id=<?php echo $listCount; ?> class="player__play button button--large" onClick="playAudio(this.id,'<?php echo $arraySong[$listCount];?>')" >Play</button>
                            </div>
                        </p>

                    </div>
            <?php } ?>
        </div>

        </div>

    </div>
    </body>

</html>
  @endsection
