let search = document.getElementById("search");
let lists = document.querySelectorAll(".members a");

// SEARCHBAR ACTIVATION.
search.addEventListener("input", () => {
  let value = search.value;
  if (value != "") {
    search.classList.add("active");
  } else {
    search.classList.remove("active");
  }
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "resources/php/search_user.php", true);
  xhr.addEventListener("readystatechange", () => {
    if (xhr.readyState == 4 && xhr.status == 200) {
      let data = xhr.response;
      members.innerHTML = data;
    }
  });
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("search-data=" + value);
});

// SELECTING THE ELEMENTS AND PREVENTING THE FORM TO SUBMIT.
let form = document.querySelector("form"),
  submit = document.getElementById("submit"),
  main = document.querySelector("main"),
  inputField = form.querySelector("input[name=send-message]"),
  send_image = form.querySelector("input[type=file]");

form.addEventListener("submit", (e) => {
  e.preventDefault();
});

// EMOJI BUTTON
let picker = new EmojiButton({
    position: "auto",
  }),
  emojiButton = document.querySelector(".fa-grin-alt");

picker.on("emoji", (emoji) => {
  inputField.value += emoji;
});

emojiButton.addEventListener("click", () => {
  picker.pickerVisible ? picker.hidePicker() : picker.showPicker(emojiButton);
});

// SENDING THE DATA TO DATABASE.
submit.addEventListener("click", () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "resources/php/send_message.php", true);
  xhr.addEventListener("readystatechange", () => {
    if (xhr.readyState == 4 && xhr.status == 200) {
      let data = xhr.response;
      inputField.value = "";
      main.innerHTML += data;
    }
  });
  xhr.send(new FormData(form));
  send_image.value = "";
  setTimeout(() => {
    main.scrollBy(0, 1000000000);
  }, 1000);
});

// SCROLL DOWN ON ENTER.
window.addEventListener("keydown", (e) => {
  if (e.key == "Enter") {
    main.scrollBy(0, 1000000000);
  }
});

// GETTING THE MESSAGE.
let interval = setInterval(() => {
  let xhr = new XMLHttpRequest();
  if (location.search == "?receiver-id=community") {
    xhr.open("POST", "resources/php/community.php", true);
  } else {
    xhr.open("POST", "resources/php/get_message.php", true);
  }
  xhr.addEventListener("readystatechange", () => {
    if (xhr.readyState == 4 && xhr.status == 200) {
      let data = xhr.response;
      main.innerHTML = data;
    }
  });
  xhr.send(new FormData(form));
}, 1000);

let members = document.querySelector(".members");

// LOADING THE MEMBERS.
setTimeout(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "resources/php/load_members.php", true);
  xhr.addEventListener("readystatechange", () => {
    if (xhr.readyState == 4 && xhr.status == 200) {
      let data = xhr.response;
      if (!search.classList.contains("active")) {
        members.innerHTML = data;
      }
    }
  });
  xhr.send(new FormData(form));
  setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "resources/php/load_members.php", true);
    xhr.addEventListener("readystatechange", () => {
      if (xhr.readyState == 4 && xhr.status == 200) {
        let data = xhr.response;
        if (!search.classList.contains("active")) {
          members.innerHTML = data;
        }
      }
    });
    xhr.send(new FormData(form));
  }, 5000);
}, 1000);

// HEADER SECTION
setTimeout(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "resources/php/load_member_header.php", true);
  xhr.addEventListener("readystatechange", () => {
    if (xhr.readyState == 4 && xhr.status == 200) {
      let data = xhr.response;
      document.querySelector("header").innerHTML = data;
    }
  });
  xhr.send(new FormData(form));
  setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "resources/php/load_member_header.php", true);
    xhr.addEventListener("readystatechange", () => {
      if (xhr.readyState == 4 && xhr.status == 200) {
        let data = xhr.response;
        document.querySelector("header").innerHTML = data;
      }
    });
    xhr.send(new FormData(form));
  }, 5000);
}, 1000);

// HAMBURGER MENU
let menu_wrapper = document.querySelector(".menu-wrapper"),
  hamburger_menu = document.querySelector(".hamburger-menu"),
  nav = document.getElementById("nav");

menu_wrapper.addEventListener("click", () => {
  hamburger_menu.classList.toggle("animate");
  nav.classList.toggle("inactive");
});
