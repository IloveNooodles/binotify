const music = document.querySelector("#audio");
const seekBar = document.querySelector(".seek-bar");
const musicDuration = document.querySelector(".song-duration");
const playBtn = document.querySelector(".play-btn");
const currentTime = document.querySelector(".current-time");

const xhr_limit_song = new XMLHttpRequest();

let isPaused = true; // By default, musik belum diplay

const setMusic = () => {
  seekBar.value = 0;
  currentTime.innerHTML = "00 : 00";
  setTimeout(() => {
    seekBar.max = music.duration;
    musicDuration.innerHTML = formatTime(music.duration);
  }, 200);
};

setMusic();

if (playBtn.getAttribute("listener") != "true") {
  playBtn.setAttribute("listener", "true");
  playBtn.addEventListener("click", () => {
    isPaused = !isPaused;

    if (!isPaused) {
      const url = `/song/play_song/`;
      xhr_limit_song.open("GET", url);
      xhr_limit_song.send();

      xhr_limit_song.onreadystatechange = function () {
        if (xhr_limit_song.readyState == 4 && xhr_limit_song.status == 200) {
          is_limit_song = JSON.parse(xhr_limit_song.responseText);
          is_limit_song = is_limit_song["data"]["can_access"];
          if (is_limit_song) {
            music.pause();
            isPaused = true;
          } else {
            playBtn.classList.toggle("pause");
            music.play();
          }
        }
      };
    } else {
      // Pause lagu
      music.pause();
      playBtn.classList.toggle("pause");
    }
  });
}

const formatTime = (time) => {
  let min = Math.floor(time / 60);
  if (min < 10) {
    min = `0${min}`;
  }
  let sec = Math.floor(time % 60);
  if (sec < 10) {
    sec = `0${sec}`;
  }
  return `${min} : ${sec}`;
};

setInterval(() => {
  seekBar.value = music.currentTime;
  currentTime.innerHTML = formatTime(music.currentTime);
}, 400);

seekBar.addEventListener("change", () => {
  music.currentTime = seekBar.value;
});

// music.play();
// playBtn.classList.remove("pause");

document.getElementById('song-delete-btn').addEventListener('click', function(e) {
  document.querySelector('div.song-delete-confirmation').classList.add('show');
  document.querySelector('div.song-delete-confirmation div.confirmation-box').classList.add('show');});

document.getElementById('song-cancel-btn').addEventListener('click', function(e) {
  document.querySelector('div.song-delete-confirmation').classList.remove('show');
  document.querySelector('div.song-delete-confirmation div.confirmation-box').classList.remove('show');});