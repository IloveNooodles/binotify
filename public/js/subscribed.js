document.querySelectorAll(".play-btn-premium").forEach((element) => {
  element.addEventListener("click", () => {
    music = document.querySelector("#audio-" + element.attributes["id"].value);

    if (element.classList.contains("pause")) {
      music.play();
      document.querySelectorAll(".play-btn-premium").forEach((el) => {
        if (!el.classList.contains("pause") && el.id != element.id) {
          el.classList.toggle("pause");
        }
        document.querySelectorAll("audio").forEach((el) => {
          if (el.id != music.id) {
            el.pause();
            el.currentTime = 0;
          }
        });
      });
    } else {
      music.pause();
      music.currentTime = 0;
    }
    element.classList.toggle("pause");
  });
});

const CURRENT_URL = window.location.href.split("/");
let CREATOR_ID = CURRENT_URL[CURRENT_URL.length - 1];

try {
  CREATOR_ID = parseInt(CREATOR_ID);
} catch (e) {
  console.log(e);
  CREATOR_ID = 0;
}

const FETCH_ARTIST_SONGLIST = "http://localhost:3333/" + CREATOR_ID;

const fetchArtistSongList = async () => {
  let response = await fetch(FETCH_ARTIST_SONGLIST, {
    method: "GET",
    headers: {
      "Access-Control-Allow-Origin": "*",
      "Access-Control-Allow-Methods": "*",
      "Access-Control-Allow-Headers": "*",
      "Access-Control-Allow-Credentials": true,
    },
  });
  try {
    let json = await response.json();
    console.log(json);
  } catch (e) {
    console.log(e);
  }
};

window.addEventListener("load", () => {
  fetchArtistSongList();
});
