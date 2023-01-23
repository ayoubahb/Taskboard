//Switch login to regester

let registerBtn = document.querySelector('#registerBtn');
let loginBtn = document.querySelector('#loginBtn');
let title = document.querySelector('#title');
let nameField = document.querySelector('#nameField');
let type = document.querySelector('#type');

console.log();

loginBtn.addEventListener('click', () => {
	nameField.style.maxHeight = '0';
	title.innerHTML = 'Login';
	registerBtn.classList.add('disable');
	loginBtn.classList.remove('disable');
	type.value = 'login';
	nameField.querySelector('input').removeAttribute('required');
	nameField.querySelector('input').value = '';
});
registerBtn.addEventListener('click', () => {
	nameField.style.maxHeight = '65px';
	title.innerHTML = 'Register';
	registerBtn.classList.remove('disable');
	loginBtn.classList.add('disable');
	type.value = 'register';
	nameField.querySelector('input').setAttribute('required', '');
});

//toggel form login and register

let loginPopUp = document.querySelector('#login');
let loginOpen = document.querySelectorAll('.openLogin');
let loginClose = document.querySelector('#closePop');

loginOpen.forEach((element) => {
	element.addEventListener('click', () => {
		loginPopUp.style.display = 'flex';
	});
});
loginClose.addEventListener('click', () => {
	loginPopUp.style.display = 'none';
});
