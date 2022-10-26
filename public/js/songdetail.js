const music = document.querySelector("#audio");
const seekBar = document.querySelector(".seek-bar");
const songName = document.querySelector(".music-name");
const artistName = document.querySelector(".artist-name");
const currentTime = document.querySelector(".current-time");
const musicDuration = document.querySelector(".song-duration");
const playBtn = document.querySelector(".play-btn");
const cover = document.querySelector(".player-cover");
const albumName = document.querySelector(".song-detail-album");
const details = document.querySelector(".song-detail-date-genre");

document.querySelectorAll("tr.content").forEach((row) => {
    row.addEventListener("click", () => {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "/song/detail?id=" + row.getAttribute("name"), true);
        xhr.onload = function () {
            if (xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                songName.innerHTML = response.data.song.judul;
                artistName.innerHTML = response.data.song.penyanyi;
                albumName.innerHTML = (response.data.album.judul ? "From Album: " + response.data.album.judul : " ");
                details.innerHTML = response.data.song.tanggal_terbit + " |  " + response.data.song.genre;
                music.src = response.data.song.audio_path.replace(BASE_URL, "");
                cover.src = response.data.song.image_path.replace(BASE_URL, "");

                const setMusic = () => {
                    seekBar.value = 0;
                    currentTime.innerHTML = '00 : 00';
                    setTimeout(() => {
                        seekBar.max = music.duration;
                        musicDuration.innerHTML = formatTime(music.duration);
                    }, 500);
                }

                setMusic();

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

                setInterval(() => {
                    seekBar.value = music.currentTime;
                    currentTime.innerHTML = formatTime(music.currentTime);
                }, 750)

                seekBar.addEventListener('change', () => {
                    music.currentTime = seekBar.value;
                })

                document.querySelector(".modal").style.display = "block";

            }
        };
        xhr.send();
    });
});

document.querySelector(".close").addEventListener("click", (e) => {
    document.querySelector(".modal").style.display = "none";
    if (!playBtn.className.includes('pause')) {
        playBtn.classList.toggle('pause');
        music.pause();
    }
});