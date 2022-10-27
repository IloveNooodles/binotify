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
const submitBtn = document.getElementById("submit-search-btn");

var fetch_search_result_song = new XMLHttpRequest();
var fetch_search_genre = new XMLHttpRequest();
var remove_pagination = new XMLHttpRequest();

window.addEventListener("load", (e) => {
  e.preventDefault();
  let url = `song/search?q=${search.value}`;

  fetch_search_result_song.open("GET", url);
  fetch_search_result_song.send();

  fetch_search_result_song.onreadystatechange = function () {
    if (
      fetch_search_result_song.readyState === 4 &&
      fetch_search_result_song.status === 200
    ) {
      updateDOM(fetch_search_result_song.responseText);
    }
  };

  url = `song/all_distinct_genre`;

  fetch_search_genre.open("GET", url);
  fetch_search_genre.send();

  fetch_search_genre.onreadystatechange = function () {
    if (
      fetch_search_genre.readyState === 4 &&
      fetch_search_genre.status === 200
    ) {
      updateListGenre(fetch_search_genre.responseText);
    }
  };
});

submitBtn.addEventListener("submit", (e) => {
  e.preventDefault();
  const URL = `song/search?q=${search.value}&genre=${genre.value}&asc=${order.value}&orderby=${orderby.value}&page=${current_page.value}`;
  fetch_search_result_song.open("GET", URL);
  fetch_search_result_song.send();

  fetch_search_result_song.onreadystatechange = function () {
    if (
      fetch_search_result_song.readyState === 4 &&
      fetch_search_result_song.status === 200
    ) {
      updateDOM(fetch_search_result_song.responseText);
    }
  };
});

formsearch.addEventListener("submit", (e) => {
  e.preventDefault();
  const URL = `song/search?q=${search.value}&genre=${genre.value}&asc=${order.value}&orderby=${orderby.value}&page=${current_page.value}`;
  fetch_search_result_song.open("GET", URL);
  fetch_search_result_song.send();

  fetch_search_result_song.onreadystatechange = function () {
    if (
      fetch_search_result_song.readyState === 4 &&
      fetch_search_result_song.status === 200
    ) {
      updateDOM(fetch_search_result_song.responseText);
    }
  };
});

leftbutton.addEventListener("click", (e) => {
  e.preventDefault();
  let cur_page = parseInt(current_page_DOM.textContent);
  if (cur_page <= 1) {
    return;
  }
  const URL = `song/search?q=${search.value}&genre=${genre.value}&asc=${
    order.value
  }&orderby=${orderby.value}&page=${cur_page - 1}`;

  fetch_search_result_song.open("GET", URL);
  fetch_search_result_song.send();

  fetch_search_result_song.onreadystatechange = function () {
    if (
      fetch_search_result_song.readyState === 4 &&
      fetch_search_result_song.status === 200
    ) {
      updateDOM(fetch_search_result_song.responseText);
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
  const URL = `song/search?q=${search.value}&genre=${genre.value}&asc=${
    order.value
  }&orderby=${orderby.value}&page=${cur_page + 1}`;
  fetch_search_result_song.open("GET", URL);
  fetch_search_result_song.send();

  fetch_search_result_song.onreadystatechange = function () {
    if (
      fetch_search_result_song.readyState === 4 &&
      fetch_search_result_song.status === 200
    ) {
      updateDOM(fetch_search_result_song.responseText);
    }
  };
});

function updateListGenre(data) {
  res = JSON.parse(data);
  list_song = res["data"]["genre"];
  template_html = `<option value="all" selected>No genre selected</option>`;
  list_song.map((item) => {
    item_genre = item["total_genre"];
    template_html += `<option value="${item_genre}">${capitalize(
      item_genre
    )}</option>`;
  });
  genre.innerHTML = template_html;
}

function updateDOM(data) {
  res = JSON.parse(data);
  res = res["data"];
  current_page = res["current_page"];
  total_page = res["total_page"];
  list_song = res["songs"];

  if (!list_song) {
    searchresultlist.innerHTML = `<p class="error-text">Not found</p>`;
    current_page_DOM.textContent = 1;
    total_page_DOM.textContent = 1;
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
                      song["image_path"].replace("/var/www/html", "")
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

function capitalize(s) {
  return s && s[0].toUpperCase() + s.slice(1);
}
