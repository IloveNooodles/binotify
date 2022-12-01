document.querySelectorAll(".play-btn-premium").forEach(element => {
	element.addEventListener("click", () => {
		music = document.querySelector("#audio-" + element.attributes["id"].value);

		if (element.classList.contains("pause")) {
			music.play();
		document.querySelectorAll(".play-btn-premium").forEach(el => {
			if (!el.classList.contains("pause") && el.id != element.id) {
				el.classList.toggle("pause");
			}
		document.querySelectorAll("audio").forEach(el => {
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