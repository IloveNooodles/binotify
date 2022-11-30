document.querySelectorAll(".play-btn-premium").forEach(element => {
	element.addEventListener("click", () => {
		// isPaused = !isPaused;

		// if (!isPaused) {
		//   const url = `/song/play_song/`;
		//   xhr_limit_song.open("GET", url);
		//   xhr_limit_song.send();

		//   xhr_limit_song.onreadystatechange = function () {
		//     if (xhr_limit_song.readyState == 4 && xhr_limit_song.status == 200) {
		//       console.log(xhr_limit_song.responseText);
		//       is_limit_song = JSON.parse(xhr_limit_song.responseText);
		//       is_limit_song = is_limit_song["data"]["can_access"];
		//       if (is_limit_song) {
		//         music.pause();
		//         isPaused = true;
		//       } else {
		//         playBtn.classList.toggle("pause");
		//         music.play();
		//       }
		//     }
		//   };
		// } else {
		//   // Pause lagu
		//   music.pause();
		element.classList.toggle("pause");
		// }
	});
});;