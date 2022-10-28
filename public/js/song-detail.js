const music = document.querySelector("#audio");
const seekBar = document.querySelector(".seek-bar");
const musicDuration = document.querySelector(".song-duration");
const playBtn = document.querySelector(".play-btn");
const currentTime = document.querySelector(".current-time");

const xhr_limit_song = new XMLHttpRequest();

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
    const url = `song/play_song`;
    xhr_limit_song.open("GET", url);
    xhr_limit_song.send();

    xhr_limit_song.onreadystatechange = function () {
      if (xhr_limit_song.readyState == 4 && xhr_limit_song.status == 200) {
        console.log(xhr_limit_song.responseText);
        is_limit_song = JSON.parse(xhr_limit_song.responseText);
        console.log(is_limit_song);
        is_limit_song = is_limit_song["data"]["can_access"];
        console.log(is_limit_song);
        if (is_limit_song) {
          music.pause();
          return;
        }

        if (playBtn.className.includes("pause")) {
          music.play();
        } else {
          music.pause();
        }
        playBtn.classList.toggle("pause");
      }
    };
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
