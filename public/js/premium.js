const SUBSCRIBE_URL = "http://localhost:8001/subscribed/subscribe";
const CHECK_URL = "http://localhost:8001/subscribed/check_subscription";
const pendingSubscription = [];

const connect_soap = async (URL, creator_id) => {
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
    let response = await connect_soap(SUBSCRIBE_URL, creator_id);
    console.log(response);
    document.querySelector(".notification").classList.toggle("show");
    document.querySelector(".notification-box").classList.toggle("show");
  });
});

const check_all_subscription = () => {
  // get all button
  document.querySelectorAll("button").forEach(async (component) => {
    // ambil value setiap button
    let creator_id = component.value;
    // check ke soap
    try {
      let response = await connect_soap(CHECK_URL, creator_id);
      let status = response["data"]["return"];

      if (status === "PENDING") {
        pendingSubscription.push(creator_id);
        component.classList.remove([
          "pending",
          "go-to-songs",
          "rejected",
          "subscribe",
        ]);
        component.classList.add("pending");
        component.textContent = "Pending ...";
      } else if (status === "ACCEPTED") {
        component.classList.remove([
          "pending",
          "go-to-songs",
          "rejected",
          "subscribe",
        ]);
        component.classList.add("go-to-songs");
        component.textContent = "Go To Songs";
      } else if (status === "REJECTED") {
        component.classList.remove([
          "pending",
          "go-to-songs",
          "rejected",
          "subscribe",
        ]);
        component.classList.add("rejected");
        component.textContent = "Rejected";
      } else {
        component.classList.remove([
          "pending",
          "go-to-songs",
          "rejected",
          "subscribe",
        ]);
        component.classList.add("subscribe");
        component.textContent = "Subscribe";
      }
    } catch (exception) {
      console.log(exception);
    }
  });
};

const polling = () => {
  len = pendingSubscription.length();
  if (len <= 0) {
    return;
  }

  for (let i = 0; i < len; i++) {
    let response = connect_soap(CHECK_URL, creator_id).then(response).catch(e);
    let status = response["data"]["return"];
  }

  window.location.reload();
};

window.addEventListener("load", (event) => {
  check_all_subscription();
  setInterval(polling, 10000);
});
