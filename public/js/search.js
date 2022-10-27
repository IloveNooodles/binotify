const orderby = document.getElementById("orderby");
const order = document.getElementById("asc");
const genre = document.getElementById("genre");
const search = document.getElementById("search-page");
const formsearch = document.getElementById("form-search");
const searchresultlist = document.getElementById("search-result-list");

console.log(orderby.value);
console.log(genre.value);
console.log(search.value);
console.log(order.value);

search.addEventListener("keyup", () => {
  console.log(search.value);
});

formsearch.addEventListener("submit", (e) => {
  e.preventDefault();
  xhr.open("GET", URL);
  xhr.send();

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      updateDOM(xhr.responseText);
    }
  };
});

// const URL = `/song/search/?q=${search.value}&genre=${genre.value}&asc=${order.value}&orderby=${orderby.value}`;
const URL = `song/search?res=A&genre=Progressive&asc=1&orderby=penyanyi&page=1`;
var xhr = new XMLHttpRequest();

function updateDOM(data) {
  res = JSON.parse(data);
  data = res["data"];
  console.log(data);
  template_html = `<table id="songlist">
        <tr>
            <th>#</th>
            <th>TITLE</th>
            <th>RELEASED</th>
            <th>GENRE</th>
        </tr>`;
  data.forEach((song, index) => {
    template_html += `<tr class="content" name="${song["song_id"]}">
                <td>${index + 1}</td>
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
  template_html += `</table>`;
  searchresultlist.innerHTML = template_html;
}
