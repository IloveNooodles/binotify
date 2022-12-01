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

const check_all_subscription = () => {
  document.querySelectorAll(".btn-val").forEach((component) => {
    let creator_id = component.value;
    let response = connect_soap(CHECK_URL, creator_id)
      .then((response) => {
        let status = response["data"]["return"];
        if (status === "PENDING") {
          pendingSubscription.push(creator_id);
          component.classList.remove("subscribe");
          component.classList.add("pending");
          component.textContent = "Pending...";
        } else if (status === "ACCEPTED") {
          component.classList.remove("subscribe");
          component.classList.add("go-to-songs");
          component.textContent = "Go To Songs";
          component.addEventListener("click", async () => {
            window.location.href = "/subscribed/" + creator_id;
          });
        } else if (status === "REJECTED") {
          component.classList.remove("subscribe");
          component.classList.add("rejected");
          component.textContent = "Rejected";
        } else {
          component.classList.remove("subscribe");
          component.classList.add("subscribe");
          component.textContent = "Subscribe";
          component.addEventListener("click", async () => {
            let response = await connect_soap(SUBSCRIBE_URL, creator_id);

            pendingSubscription.push(creator_id);
            document.querySelector(".notification").classList.toggle("show");
            document
              .querySelector(".notification-box")
              .classList.toggle("show");
            component.classList.remove("subscribe");
            component.classList.add("pending");
            component.textContent = "Pending...";
            component.removeEventListener("click", () => {});
          });
        }
      })
      .catch((err) => console.log(err));
  });
};

const polling = () => {
  len = pendingSubscription.length;

  if (len <= 0) {
    return;
  }

  for (let i = 0; i < len; i++) {
    connect_soap(CHECK_URL, pendingSubscription[i])
      .then((response) => {
        let status = response["data"]["return"];
        if (status !== "PENDING") {
          document.querySelector(".notification").classList.toggle("show");
          document.querySelector(".notification-box").classList.toggle("show");
          document.querySelector(".notification-text").textContent =
            "New subscription, please refresh";
          pendingSubscription.pop();
          document
            .getElementById("notification-close-button")
            .addEventListener("click", (e) => {
              window.location.reload();
            });
        }
      })
      .catch((err) => console.log(err));
  }
};

window.addEventListener("load", () => {
  check_all_subscription();
  setInterval(polling, 5000);
});
