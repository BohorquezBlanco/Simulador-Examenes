const registerButton = document.getElementById('register');
const loginButton = document.getElementById('login');
const wrapper = document.getElementById('wrapper');

registerButton.addEventListener('click', () => {
  wrapper.classList.add("right-panel-active");
});

loginButton.addEventListener('click', () => {
  wrapper.classList.remove("right-panel-active");
});
