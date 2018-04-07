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
         <div class="col-md-8">
           <div class="card">
             <div class="card-header">
               <b>Sound Of Life</b>
             </div>
             <div class="card-body">
        @guest
        @else
        <li>
            <a href = "song_list">Manage Songs</a>
        </li>

        <!-- Add song -->
        <li>
            <a href="insert"> Add New Song</a>
        </li><br>
        @endguest

        <!-- Song list -->
        <div class="row">
            <?php
                foreach($songs as $song) {
                ?>
                <div class="col-sm-9">
                    <a> <img src="storage/songIMG/<?php echo $song->SONG_IMGL_INK;?>" class="img-responsive" style="width:10%"/></a>
                    <p class="text-danger"><?php echo $song->SONG_TITLE; ?></p>
                    <p class="text-info"><?php echo $song->ARTIST; ?></p>
                    <p class="text-info">Song link: <?php echo $song->SONG_LINK; ?></P>
                    <p class="text-danger">
                        <button id="btnPlay" type="btnPlay" class="btn btn-primary" onClick="playSong(storage/mp3/<?php echo $song->SONG_LINK;?>)"> Play </button>
                    </p>
                    <!-- Script -->
                    <script type="text/javascript" src="{{ URL::asset('js/soundmanager2.js') }}"></script>

                    <script>
                        function playSong(songLink) {
                            function formatMilliseconds(milliseconds) {
                                var hours = Math.floor(milliseconds / 3600000);
                                milliseconds = milliseconds % 3600000;
                                var minutes = Math.floor(milliseconds / 60000);
                                milliseconds = milliseconds % 60000;
                                var seconds = Math.floor(milliseconds / 1000);
                                milliseconds = Math.floor(milliseconds % 1000);

                                return (hours > 0 ? hours : '0') + ':' + (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds + ':' + (milliseconds < 100 ? '0' : '') + (milliseconds < 10 ? '0' : '') + milliseconds;
                            }

                            var player = {
                                btnPlay:  document.getElementById('btnPlay'),
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
                                    id: 'audio',

                                    //   Insert link
                                    url: songLink,
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

                            player.btnPlay.addEventListener('click', function() {
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
                            });

                            player.btnStop.addEventListener('click', function() {
                                if (audio === null) {
                                return;
                                }

                                audio.stop();
                                document.querySelector('.player__time-elapsed').textContent = formatMilliseconds(0);
                                player.btnPlay.classList.remove('is-playing');
                            });

                            player.btnVolumeDown.addEventListener('click', function() {
                                if (audio === null) {
                                return;
                                }

                                var volume = audio.volume - 10 < 0 ? 0 : audio.volume - 10;
                                audio.setVolume(volume);
                                player.volume.textContent = volume;
                            });

                            player.btnVolumeUp.addEventListener('click', function() {
                                if (audio === null) {
                                return;
                                }

                                var volume = audio.volume + 10 > 100 ? 100 : audio.volume + 10;
                                audio.setVolume(volume);
                                player.volume.textContent = volume;
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
                                    // Internet Explorer doesn't like this statement
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
                        }

                    </script>

                </div>
                <?php } ?>

            </div>
        </div>

    </div>
  </div>
</div>
</div>
    </body>

</html>
  @endsection
