//toggel task cards

let toggel = document.querySelectorAll('.toggel');

toggel.forEach((element) => {
	element.addEventListener('click', (event) => {
		let child = event.target;
		child.textContent == '-'
			? (child.textContent = '+')
			: (child.textContent = '-');
		let parent = event.target.parentElement.parentElement;
		parent.classList.toggle('stretch');
	});
});

// number of tasks created

let number = document.getElementById('num');
let form = document.getElementById('form');

number.addEventListener('change', () => {
	if (number.value < 0) {
		number.value = 0;
	}
	let element = '';
	form.innerHTML = '';
	for (let index = 0; index < number.value; index++) {
		element += `<hr>
                <div class="mb-3">
									<label class="col-form-label">Task${index + 1}</label>
									<input type="text" class="form-control" name="task${index + 1}"/>
								</div>
								<div class="mb-3">
									<labe class="col-form-label">Deadline</labe>
									<input type="date" class="form-control" name="deadline${index + 1}"/>
								</div>`;
	}
	form.innerHTML = element;
});

//toggel form add

let open = document.querySelector('.open');
let close = document.querySelectorAll('.close');
let addForm = document.querySelector('#add');

open.addEventListener('click', () => {
	addForm.style.display = 'flex';
});
close.forEach((element) => {
	element.addEventListener('click', () => {
		addForm.style.display = 'none';
		form.innerHTML = '';
		number.value = 0;
	});
});

//toggel form edit
let editForm = document.querySelector('#edit');
let editTask = document.querySelector("input[name='task']");
let editDeadline = document.querySelector("input[name='deadline']");
let editStatus = document.querySelector("select[name='status']");
let cancle = document.querySelectorAll('.cancle');
cancle.forEach((element) => {
	element.addEventListener('click', () => {
		editForm.style.display = 'none';
		editTask.value = '';
		editDeadline.value = '';
		editStatus.value = '';
		taskId = '';
	});
});

// -----------------------Add---------------------------
document.addEventListener('DOMContentLoaded', () => {
	var button = document.querySelector('#create');
	button.addEventListener('click', addTask);
});
// -----------------------Edit---------------------------
let editButton = document.querySelector('#update');
var taskId;
editButton.addEventListener('click', () => {
	updateTask(taskId);
});
// -----------------------Search---------------------------
var searchInput = document.querySelector('#search');
document.addEventListener('DOMContentLoaded', () => {
	searchInput.addEventListener('keyup', search);
});

// ---------------------------Functions---------------------------

// add task
const addTask = () => {
	var inputs = form.querySelectorAll('input, select');
	var empty = false;
	for (var i = 0; i < inputs.length; i++) {
		if (inputs[i].value === '') {
			empty = true;
			break;
		}
	}
	if (!empty) {
		// Send data to AJAX page
		let data = [];
		for (let i = 0; i < number.value; i++) {
			let task = {
				task: document.querySelector(`input[name='task${i + 1}']`).value,
				deadline: document.querySelector(`input[name='deadline${i + 1}']`)
					.value,
				status: 'to do',
				id: userId,
			};
			data.push(task);
		}
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'http://localhost/TaskBoard/add', true);
		xhr.setRequestHeader('Content-Type', 'application/json');
		xhr.send(JSON.stringify(data));
		xhr.onreadystatechange = function () {
			if (xhr.readyState === 4 && xhr.status === 200) {
				if (xhr.responseText == 1) {
					addForm.style.display = 'none';
					form.innerHTML = '';
					number.value = 0;
					getTasks();
				}
			}
		};
	} else {
		alert('All fields are required!');
	}
};

//Get tasks

//get containers
let toDo = document.getElementById('todo');
let progress = document.getElementById('progress');
let done = document.getElementById('done');

// get statistic spans
let toDoNum = document.getElementById('tdnum');
let progressNum = document.getElementById('ipnum');
let doneNum = document.getElementById('dnum');
let userId = document.querySelector('#userId').value;


const getTasks = () => {
	toDoNum.textContent = '0';
	progressNum.textContent = '0';
	doneNum.textContent = '0';
	//Empty cards
	toDo.innerHTML = '';
	progress.innerHTML = '';
	done.innerHTML = '';

	//Get new results
	let xhr = new XMLHttpRequest();
	xhr.open('POST', 'http://localhost/TaskBoard/get', true);
	xhr.setRequestHeader('Content-Type', 'application/json');
	xhr.responseType = 'json';
	xhr.send(JSON.stringify({ id: userId }));
	xhr.onload = () => {
		if (xhr.status == 200) {
			//Put result in variable
			let result = xhr.response;
			
			// Create Task to be shown in page
			for (let i = 0; i < result.length; i++) {
				//create card
				let card = document.createElement('div');
				let para = document.createElement('p');
				let icons = document.createElement('div');
				let deadline = document.createElement('h6');
				card.id = result[i].taskId;
				card.classList.add(
					'task',
					'rounded',
					'p-3',
					'position-relative',
					'mt-2'
				);

				para.textContent = result[i].taskDescription;

				icons.classList.add('position-absolute', 'top-0', 'p-2', 'end-0');
				icons.innerHTML = `<i class="bi bi-trash-fill me-2  delete" style="font-size: 20px">
				</i> <i class="bi bi-pencil-fill edit" style="font-size: 20px"></i>`;

				deadline.classList.add('m-0', 'text-end');
				deadline.innerHTML = `Deadline : <span>${result[i].taskDeadLine}</span>`;

				card.appendChild(para);
				card.appendChild(icons);
				card.appendChild(deadline);

				//Put eche task in a spicific card based on his status

				if (result[i].taskStatus === 'to do') {
					toDo.appendChild(card);
					toDoNum.textContent++;
				} else if (result[i].taskStatus === 'in progress') {
					progress.appendChild(card);
					progressNum.textContent++;
				} else {
					done.appendChild(card);
					doneNum.textContent++;
				}
			}

			let deleteButtons = document.querySelectorAll('.delete');
			let editButtons = document.querySelectorAll('.edit');

			// Add event lestner to  all edit buttons to pop up the edit form
			editButtons.forEach((element) => {
				element.addEventListener('click', popEditForm);
			});
			// Add event lestner to  all delete buttons to be deleted from database
			deleteButtons.forEach((element) => {
				element.addEventListener('click', deleteTasks);
			});
		} else {
			console.log('problem');
		}
	};
};

//delete
const deleteTasks = (event) => {
	let taskId = event.target.parentElement.parentElement.id;
	let xhr = new XMLHttpRequest();
	xhr.open('POST', 'http://localhost/TaskBoard/delete', true);
	xhr.setRequestHeader('Content-Type', 'application/json');
	xhr.send(JSON.stringify({ id: taskId }));
	xhr.onload = function () {
		if (xhr.readyState === 4 && xhr.status === 200) {
			if (xhr.responseText == 1) {
				getTasks();
			}
		}
	};
};

//Pop Up edit form anf fil it with data
const popEditForm = (event) => {
	taskId = event.target.parentElement.parentElement.id;
	let task = event.target.parentElement.parentElement.childNodes[0].textContent;
	let deadline =
		event.target.parentElement.parentElement.childNodes[2].childNodes[1]
			.textContent;
	let status =
		event.target.parentElement.parentElement.parentElement.parentElement.childNodes[1].childNodes[1].textContent
			.replace(/[0-9]/g, '')
			.trim()
			.toLowerCase();

	editTask.value = task;
	editDeadline.value = deadline;
	editStatus.value = status;

	editForm.style.display = 'flex';
};

//edit
const updateTask = (id) => {
	var inputs = form.querySelectorAll('input, select');
	var empty = false;
	for (var i = 0; i < inputs.length; i++) {
		if (inputs[i].value === '') {
			empty = true;
			break;
		}
	}
	if (!empty) {
		// Send data to AJAX page
		let task = {
			task: document.querySelector(`input[name='task']`).value,
			deadline: document.querySelector(`input[name='deadline']`).value,
			status: document.querySelector(`select[name='status']`).value,
			id: id,
		};
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'http://localhost/TaskBoard/update', true);
		xhr.setRequestHeader('Content-Type', 'application/json');
		xhr.send(JSON.stringify(task));
		xhr.onload = function () {
			if (xhr.readyState === 4 && xhr.status === 200) {
				if (xhr.responseText == 1) {
					location.reload();
					editTask.value = '';
					editDeadline.value = '';
					editStatus.value = '';
					editForm.style.display = 'none';
				}
			}
		};
	} else {
		alert('All fields are required!');
	}
};

//search
const search = () => {
	if (searchInput.value !== '') {
		toDoNum.textContent = '0';
		progressNum.textContent = '0';
		doneNum.textContent = '0';
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'http://localhost/TaskBoard/search', true);
		xhr.responseType = 'json';
		xhr.setRequestHeader('Content-Type', 'application/json');
		xhr.send(JSON.stringify({ task: searchInput.value,id:userId }));
		xhr.onreadystatechange = function () {
			if (xhr.readyState === 4 && xhr.status === 200) {
				// console.log(xhr.response);
				toDo.innerHTML = '';
				progress.innerHTML = '';
				done.innerHTML = '';
				//Put result in variable
				let result = xhr.response;
				//Create Task to be shown in page
				for (let i = 0; i < result.length; i++) {
					//create card
					let card = document.createElement('div');
					let para = document.createElement('p');
					let icons = document.createElement('div');
					let deadline = document.createElement('h6');
					card.id = result[i].taskId;
					card.classList.add(
						'task',
						'rounded',
						'p-3',
						'position-relative',
						'mt-2'
					);

					para.textContent = result[i].taskDescription;

					icons.classList.add('position-absolute', 'top-0', 'p-2', 'end-0');
					icons.innerHTML = `<i class="bi bi-trash-fill me-2  delete" style="font-size: 20px">
				</i> <i class="bi bi-pencil-fill edit" style="font-size: 20px"></i>`;

					deadline.classList.add('m-0', 'text-end');
					deadline.innerHTML = `Deadline : <span>${result[i].taskDeadLine}</span>`;

					card.appendChild(para);
					card.appendChild(icons);
					card.appendChild(deadline);

					//Put eche task in a spicific card based on his status
					if (result[i].taskStatus === 'to do') {
						toDo.appendChild(card);
						toDoNum.textContent++;
					} else if (result[i].taskStatus === 'in progress') {
						progress.appendChild(card);
						progressNum.textContent++;
					} else {
						done.appendChild(card);
						doneNum.textContent++;
					}
				}

				let deleteButtons = document.querySelectorAll('.delete');
				let editButtons = document.querySelectorAll('.edit');

				// Add event lestner to  all edit buttons to pop up the edit form
				editButtons.forEach((element) => {
					element.addEventListener('click', popEditForm);
				});
				// Add event lestner to  all delete buttons to be deleted from database
				deleteButtons.forEach((element) => {
					element.addEventListener('click', deleteTasks);
				});
			}
		};
	} else {
		getTasks();
	}
};

//get data where entre page
getTasks();


