
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Laravel Quickstart - Basic</title>
        <link href = "/SoundOfLife/site.css" rel = "stylesheet" 
         type = "text/css">
        <!-- CSS And JavaScript -->
        <style>
          .player
          {
            display: inline-block;
            width: 300px;
            padding: 5px;
            background-color: #E3E3E3;
            border: 1px solid #000000;
          }

          .player span
          {
            font-weight: bold;
          }

          .button
          {
            text-indent: 200%;
            white-space: nowrap;
            overflow: hidden;
            border: none;
            padding: 0;
            background: rgba(255,255,255,0);
            cursor: pointer;
            vertical-align: bottom;
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

          .player__audio-info
          {
            padding-bottom: 5px;
            border-bottom: 1px dotted #000000;
          }

          .player__audio-info div + div
          {
            margin-top: 10px;
          }

          .player__volume-info
          {
            display: inline-block;
            width: 1.5em;
          }

          .player__play
          {
            background-image: url("http://i60.tinypic.com/14mbep2.png");
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

          .player__volume-down
          {
            background-image: url("http://i60.tinypic.com/331nom0.png");
          }

          .player__volume-up
          {
            background-image: url("http://i60.tinypic.com/ekkc1t.png");
          }
      </style>
    </head>

    <body>
        <div class="container">
            <nav class="navbar navbar-default">
                <!-- Navbar Contents -->
            </nav>
        </div>
        <div class="player">
          <div class="player__audio-info">
              <div>
                Played
                <span class="player__time-elapsed">-</span> of
                <span class="player__time-total">-</span>
                <button class="player__previous button button--small">Move back</button>
                <button class="player__next button button--small">Move forth</button>
              </div>
              <div>
                Volume: <span class="player__volume-info">100</span>
                <button class="player__volume-down button button--small">Volume down</button>
                <button class="player__volume-up button button--small">Volume up</button>
              </div>
          </div>
          <button class="player__play" id="btnPlay">Play</button>
          <button class="player__stop button button--large">Stop</button>
        </div>
        @yield('content')
    </body>
</html>
<script type="text/javascript" src="{{ URL::asset('js/soundmanager2.js') }}"></script>
<script>
  function formatMilliseconds(milliseconds) {
    var hours = Math.floor(milliseconds / 3600000);
    milliseconds = milliseconds % 3600000;
    var minutes = Math.floor(milliseconds / 60000);
    milliseconds = milliseconds % 60000;
    var seconds = Math.floor(milliseconds / 1000);
    milliseconds = Math.floor(milliseconds % 1000);

    return (hours > 0 ? hours : '0') + ':' +
        (minutes < 10 ? '0' : '') + minutes + ':' +
        (seconds < 10 ? '0' : '') + seconds + ':' +
        (milliseconds < 100 ? '0' : '') + (milliseconds < 10 ? '0' : '') + milliseconds;
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
          url: 'http://freshly-ground.com/data/audio/mpc/20090119%20-%20Untitled%20Groove.mp3',
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
</script>