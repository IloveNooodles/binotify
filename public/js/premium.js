const SUBSCRIBE_URL = "http://localhost:8001/subscribed/subscribe";

const subscribe = async (URL, creator_id) => {
  let body = new FormData();
  body.append("creator_id", creator_id);
  let response = await fetch(URL, {
    method: "POST",
    credentials: "include",
    body: body,
  });

  let result = await response.json();
  return result;
};

document.querySelectorAll(".subscribe").forEach((component) => {
  let creator_id = component.value;
  component.addEventListener("click", async () => {
    let response = await subscribe(SUBSCRIBE_URL, creator_id);
    console.log(response);
    document.querySelector(".notification").classList.toggle("show");
    document.querySelector(".notification-box").classList.toggle("show");
  });
});
