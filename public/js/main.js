const teamOptions = document.getElementById('team');
const positionOptions = document.getElementById('position');
const editButtons = document.querySelectorAll('.edit-btn');
const addButton = document.querySelector('.add-btn');
const formLabel = document.querySelector('#formModalLabel');
const submitBtn = document.querySelector('.modal-footer button[type=submit]');

const searchInput = document.querySelector('#keyword');
const tabelBody = document.querySelector('tbody');

const secondTh = document.querySelector('.table-heading__player');
const secondTd = document.querySelectorAll('.table-data__player');

const modalForm = document.querySelector('#formModal')

const thSorts = document.querySelectorAll('.th-sort');


// immediateLoadEventListener();
// function immediateLoadEventListener() {
// }

// teamOptions.addEventListener('change', () =>
// 	teamOptions.classList.replace('text-muted', 'text-reset')
// );

// positionOptions.addEventListener('change', () =>
// 	positionOptions.classList.replace('text-muted', 'text-reset')
// );


if (document.querySelector(".alert") !== null) {
	const flash = document.querySelector(".alert");

	setTimeout(() => {
		flash.classList.remove("show");
	}, 3000);
	setTimeout(() => {
		flash.parentElement.parentElement.remove();
	}, 3500);
}




modalForm.addEventListener('show.bs.modal', function (e) {
	if (e.relatedTarget.classList.contains('edit-btn')) {

		modalForm.querySelector('#formModalLabel').textContent = 'Edit Data';
		modalForm.querySelector('button[type=submit]').textContent = 'Update Data';
		const form = modalForm.querySelector('.modal-body form');
		const id = e.relatedTarget.getAttribute('data-id');

		console.log(id);
		form.setAttribute('action', `http://localhost/php-mvc/public/players/edit/${id}`);


		const xhr = new XMLHttpRequest;
		xhr.onreadystatechange = () => {
			if (xhr.readyState == 4 && xhr.status == 200) {
				const data = JSON.parse(xhr.responseText);

				console.log(data);
				this.querySelector('#name').value = data.name;
				this.querySelector('#team').value = data.team;
				this.querySelector('#position').value = data.position;
				this.querySelector('#height').value = data.height;
				this.querySelector('#weight').value = data.weight;
			}
		}

		xhr.open('post', 'http://localhost/php-mvc/public/players/getdata', true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.send(`id=${id}`);


	}

});


modalForm.addEventListener('hidden.bs.modal', function () {
	this.querySelector('#name').value = '';
	this.querySelector('#team').value = 'Select team';
	this.querySelector('#position').value = 'Select position';
	this.querySelector('#height').value = '';
	this.querySelector('#weight').value = '';
});





addButton.addEventListener('click', () => {
	formLabel.textContent = 'Add player data'
	submitBtn.textContent = 'Add Data';
});







// window.onresize = playerColumnLeftPosition;

function playerColumnLeftPosition() {
	const firstColWidth = secondTh.previousElementSibling.offsetWidth;
	secondTh.style.left = `39`;
	secondTd.forEach(item => {
		item.style.left = `39`;
	});
}


let order = 'id';
let sort = 'DESC';
let team = 'team';
let position = 'position';


loadData(team, position, searchInput.value, order, sort);


searchInput.addEventListener('keyup', () => {
	loadData(team, position, searchInput.value, order, sort);
	console.log('ketik');
})


thSorts.forEach(item => {
	item.addEventListener('click', function (e) {

		thSorts.forEach(th => {
			if (th.classList.contains('sorting'))
				th.classList.remove('sorting');
		})

		this.classList.add('sorting');

		let order = item.firstElementChild.textContent.toLowerCase();
		if (order === 'player') {
			order = 'name';
		} else if (order === '#') {
			order = 'id';
		}

		if (this.lastElementChild.firstChild.classList.contains('bi-caret-down-fill')) {
			this.lastElementChild.firstChild.classList.replace('bi-caret-down-fill', 'bi-caret-up-fill');
			sort = 'ASC';
		} else {
			this.lastElementChild.firstChild.classList.replace('bi-caret-up-fill', 'bi-caret-down-fill');
			sort = 'DESC';
		}

		loadData(team, position, searchInput.value, order, sort);

		console.log('sukses');

	});
});


const selectBy = document.querySelectorAll('#byposition, #byteam');
selectBy.forEach(item => {
	item.addEventListener('change', function (e) {
		if (this.id == 'byposition') {
			position = this.value;
		}

		if (this.id == 'byteam') {
			team = this.value;
		}

		loadData(team, position, searchInput.value, order, sort);
	})
});




function loadData(team, position, keyword, order, sort) {
	const xhr = new XMLHttpRequest;
	xhr.onreadystatechange = () => {
		if (xhr.readyState == 4 && xhr.status == 200) {
			tabelBody.innerHTML = xhr.responseText;
		}
	}

	xhr.open('post', 'http://localhost/php-mvc/public/players/table', true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send(`team=${team}&position=${position}&keyword=${keyword}&order=${order}&sort=${sort}`);
}









// editButtons.forEach(editBtn => {
// 	editBtn.addEventListener('click', function (e) {
// 		e.preventDefault();
// 		console.log('tes');
// 		formLabel.textContent = 'Edit player data';
// 		submitBtn.textContent = 'Update Data';
// 		teamOptions.classList.replace('text-muted', 'text-reset');
// 		positionOptions.classList.replace('text-muted', 'text-reset');

// 		const form = document.querySelector('.modal-body form');
// 		const id = this.getAttribute('data-id');
// 		form.setAttribute('action', `http://localhost/php-mvc/public/players/edit/${id}`);


// 		const xhr = new XMLHttpRequest;
// 		xhr.onreadystatechange = () => {
// 			if (xhr.readyState == 4 && xhr.status == 200) {
// 				const data = JSON.parse(xhr.responseText);

// 				// const data = xhr.responseText;
// 				document.querySelector('#name').value = data.name;
// 				document.querySelector('#team').value = data.team;
// 				document.querySelector('#position').value = data.position;
// 				document.querySelector('#height').value = data.height;
// 				document.querySelector('#weight').value = data.weight;
// 				console.log(data);
// 			}
// 		}

// 		xhr.open('post', 'http://localhost/php-mvc/public/players/getdata', true);
// 		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
// 		xhr.send(`id=${id}`);

// 	});

// });