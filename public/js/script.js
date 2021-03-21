const teamOptions = document.getElementById('team');
const positionOptions = document.getElementById('position');
const editButtons = document.querySelectorAll('.edit-btn');
const addButton = document.querySelector('.add-btn');
const formLabel = document.querySelector('#formModalLabel');
const submitBtn = document.querySelector('.modal-footer button[type=submit]');

// immediateLoadEventListener();
// function immediateLoadEventListener() {
// }

teamOptions.addEventListener('change', () =>
	teamOptions.classList.replace('text-muted', 'text-reset')
);

positionOptions.addEventListener('change', () =>
	positionOptions.classList.replace('text-muted', 'text-reset')
);


if (document.querySelector(".alert") !== null) {
	const flash = document.querySelector(".alert");

	setTimeout(() => {
		flash.classList.remove("show");
	}, 5000);
	setTimeout(() => {
		flash.parentElement.parentElement.remove();
	}, 5500);
}


editButtons.forEach(editBtn => {
	editBtn.addEventListener('click', function (e) {
		e.preventDefault();
		formLabel.textContent = 'Edit player data';
		submitBtn.textContent = 'Update Data';
		teamOptions.classList.replace('text-muted', 'text-reset');
		positionOptions.classList.replace('text-muted', 'text-reset');

		const form = document.querySelector('.modal-body form');
		const id = this.getAttribute('data-id');
		form.setAttribute('action', `http://localhost/php-mvc/public/players/edit/${id}`);


		const xhr = new XMLHttpRequest;
		xhr.onreadystatechange = () => {
			if (xhr.readyState == 4 && xhr.status == 200) {
				const data = JSON.parse(xhr.responseText);
				// const data = xhr.responseText;
				document.querySelector('#name').value = data.name;
				document.querySelector('#team').value = data.team;
				document.querySelector('#position').value = data.position;
				document.querySelector('#height').value = data.height;
				document.querySelector('#weight').value = data.weight;
				console.log(data);
			}
		}

		xhr.open('post', 'http://localhost/php-mvc/public/players/getdata', true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.send(`id=${id}`);

	});

});

addButton.addEventListener('click', () => {
	formLabel.textContent = 'Add player data'
	submitBtn.textContent = 'Add Data';
});