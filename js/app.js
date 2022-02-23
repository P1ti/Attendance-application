const modaL = document.querySelector(".modal");
const addButton = document.querySelector(".addEntryBtn");

addButton.addEventListener('click', () => {
  modaL.classList.toggle("active");
});
