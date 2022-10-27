const orderby = document.getElementById("orderby");
const order = document.getElementById("asc");
const genre = document.getElementById("genre");
const search = document.getElementById("search-page");
const formsearch = document.getElementById("form-search");
const searchresultlist = document.getElementById("search-result-list");
const pagination = document.getElementById("pagination-container");
const leftbutton = document.getElementById("left-button");
const rightbutton = document.getElementById("right-button");
const current_page_DOM = document.getElementById("current-page");
const total_page_DOM = document.getElementById("total-page");

var xhr = new XMLHttpRequest();

window.addEventListener("load", (e) => {
  e.preventDefault();
  const URL = `song/search?q=${search.value}`;

  xhr.open("GET", URL);
  xhr.send();

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      updateDOM(xhr.responseText);
    }
  };
});

formsearch.addEventListener("submit", (e) => {
  e.preventDefault();
  const URL = `song/search?q=${search.value}&genre=Progressive&asc=${order.value}&orderby=${orderby.value}&page=${current_page.value}`;
  xhr.open("GET", URL);
  xhr.send();

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      updateDOM(xhr.responseText);
    }
  };
});

leftbutton.addEventListener("click", (e) => {
  e.preventDefault();
  let cur_page = parseInt(current_page_DOM.textContent);
  if (cur_page <= 1) {
    return;
  }
  const URL = `song/search?q=${search.value}&genre=Progressive&asc=${
    order.value
  }&orderby=${orderby.value}&page=${cur_page - 1}`;

  xhr.open("GET", URL);
  xhr.send();

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      console.log(xhr.responseText);
      updateDOM(xhr.responseText);
    }
  };
});

rightbutton.addEventListener("click", (e) => {
  e.preventDefault();
  let cur_page = parseInt(current_page_DOM.textContent);
  let total_page = parseInt(total_page_DOM.textContent);

  if (cur_page >= total_page) {
    return;
  }
  const URL = `song/search?q=${search.value}&genre=Progressive&asc=${
    order.value
  }&orderby=${orderby.value}&page=${cur_page + 1}`;
  xhr.open("GET", URL);
  xhr.send();

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      updateDOM(xhr.responseText);
    }
  };
});
// const URL = `/song/search/?q=${search.value}&genre=${genre.value}&asc=${order.value}&orderby=${orderby.value}`;

function updateDOM(data) {
  res = JSON.parse(data);
  res = res["data"];
  current_page = res["current_page"];
  total_page = res["total_page"];
  list_song = res["songs"];

  if (!list_song) {
    searchresultlist.innerHTML = `<p class="error-text">Not found</p>`;
    return;
  }

  template_html = `<table id="songlist">
        <tr>
            <th>#</th>
            <th>TITLE</th>
            <th>RELEASED</th>
            <th>GENRE</th>
        </tr>`;
  list_song.map((song, index) => {
    template_html += `<tr class="content" name="${song["song_id"]}">
                <td>${index + 1 + (current_page - 1) * 10}</td>
                <td class="songlist-title">
                    <img class="song-image" src="${
                      song["image_path"]
                    }" alt="album">
                    <div class="title-artist">
                        <p class="song-title">${song["judul"]}</p>
                        <p class="song-artist">${song["penyanyi"]}</p>
                    </div>
                </td>
                <td>${song["tanggal_terbit"]}</td>
                <td>${song["genre"]}</td>
            </tr>`;
  });
  current_page_DOM.innerHTML = `<p id="current-page">${current_page}</p>`;
  total_page_DOM.innerHTML = `<p id="total-page">${total_page}</p>`;
  template_html += `</table>`;
  searchresultlist.innerHTML = template_html;
}
