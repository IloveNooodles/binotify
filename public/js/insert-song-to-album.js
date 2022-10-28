const submitBtn = document.getElementById("submit-add-song");
const song_to_insert = document.getElementById("song_to_insert");
const album_to_insert = document.getElementById("album_to_insert");
const submit_message = document.getElementById("sumbit-message-label");

let xhr_to_fetch_song = new XMLHttpRequest();
let xhr_to_fetch_album = new XMLHttpRequest();
let xhr_to_submit = new XMLHttpRequest();

fetch_song_url = `/song/find_song_where_album_is_null`;
fetch_album_url = `/album/fetchAllAlbums/`;
insert_song = `/album/add_song/`;

window.addEventListener("load", (e) => {
  e.preventDefault();
  xhr_to_fetch_album.open("GET", fetch_album_url);
  xhr_to_fetch_album.send();
  xhr_to_fetch_album.onreadystatechange = function () {
    if (
      xhr_to_fetch_album.readyState === 4 &&
      xhr_to_fetch_album.status === 200
    ) {
      update_list_album(xhr_to_fetch_album.responseText);
    }
  };
  xhr_to_fetch_song.open("GET", fetch_song_url);
  xhr_to_fetch_song.send();
  xhr_to_fetch_song.onreadystatechange = function () {
    if (xhr_to_fetch_song.readyState == 4 && xhr_to_fetch_song.status === 200) {
      update_list_song(xhr_to_fetch_song.responseText);
    }
  };
});

submitBtn.addEventListener("click", () => {
  xhr_to_submit.open("POST", insert_song, true);
  xhr_to_submit.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded"
  );
  xhr_to_submit.send(
    "album_id=" + album_to_insert.value + "&song_id=" + song_to_insert.value
  );
  xhr_to_submit.onload = function () {
    if (xhr_to_submit.status === 200) {
      submit_message.classList.add("submit-success");
      submit_message.innerHTML = "Song has been added to album";
    } else {
      submit_message.classList.add("submit-failed");
      submit_message.innerHTML = "Failed to add song to album";
    }
  };
});

function update_list_album(data) {
  res = JSON.parse(data);
  list_album = res["data"];
  if (!list_album) {
    album_to_insert.innerHTML = `<option value="" selected>No Songs are available</option>`;
  }
  template_html = ``;
  list_album.map((item) => {
    album_id = item["album_id"];
    judul = item["judul"];
    template_html += `<option value="${album_id}" selected>${judul}</option>`;
  });
  album_to_insert.innerHTML = template_html;
}

function update_list_song(data) {
  res = JSON.parse(data);
  list_song = res["data"]["songs"];
  if (!list_song) {
    song_to_insert.innerHTML = `<option value="" selected>No Songs are available</option>`;
  }
  template_html = ``;
  list_song.map((item) => {
    song_id = item["song_id"];
    judul = item["judul"];
    template_html += `<option value="${song_id}" selected>${judul}</option>`;
  });
  song_to_insert.innerHTML = template_html;
}
