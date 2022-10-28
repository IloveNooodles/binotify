const music = document.querySelector("#audio");
const seekBar = document.querySelector(".seek-bar");
const musicDuration = document.querySelector(".song-duration");
const playBtn = document.querySelector(".play-btn");
const currentTime = document.querySelector(".current-time");


const setMusic = () => {
    seekBar.value = 0;
    currentTime.innerHTML = '00 : 00';
    setTimeout(() => {
        seekBar.max = music.duration;
        musicDuration.innerHTML = formatTime(music.duration);
    }, 200);
}

setMusic();

if (playBtn.getAttribute("listener") != "true") {
    playBtn.setAttribute("listener", "true");
    playBtn.addEventListener('click', () => {
        if(playBtn.className.includes('pause')){
            music.play();
        } else{
            music.pause();
        }
        playBtn.classList.toggle('pause');
    })
}

const formatTime = (time) => {
    let min = Math.floor(time / 60);
    if(min < 10){
        min = `0${min}`;
    }
    let sec = Math.floor(time % 60);
    if(sec < 10){
        sec = `0${sec}`;
    }
    return `${min} : ${sec}`;
}

setInterval(() => {
    seekBar.value = music.currentTime;
    currentTime.innerHTML = formatTime(music.currentTime);
}, 400)

seekBar.addEventListener('change', () => {
    music.currentTime = seekBar.value;
})

    music.play();
    playBtn.classList.remove('pause');