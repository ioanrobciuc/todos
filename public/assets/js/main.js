var Main = {
	initialization: function () {
		this.events();
	},

	events: function () {
		this.clickEvents();
		this.submitEvents();
	},

	clickEvents: function () {
		var tasksElements = document.getElementsByClassName('task');
		for (var i = 0; i < tasksElements.length; i++) {
			tasksElements[i].addEventListener('click', function () {
				this.childNodes[1].classList.toggle('active');
			}, false);
		}
	},

	submitEvents: function () {
		var formElement = document.querySelector('#container form');
		if (formElement !== null) {
			formElement.addEventListener('submit', function (event) {
				event.preventDefault();

				var enterHoursElement = document.querySelector('#container form input.enter-hours');
				var enterHoursElementValue = parseInt(enterHoursElement.value);

				if (enterHoursElementValue >= 1 && enterHoursElementValue <= 20) {
					this.submit();
				} else {
					var errorsElement = document.getElementById('errors');
					while (errorsElement.firstChild) {
						errorsElement.firstChild.remove();
					}

					var liElement = document.createElement('li');
					liElement.innerText = 'The hours-worked field is required, must be at least 1 and may not be greater than 20.';

					errorsElement.appendChild(liElement);

					errorsElement.classList.remove('display-none');
					errorsElement.classList.add('display-block');
				}
			}, false);
		}
	}
};

window.addEventListener('DOMContentLoaded', function () {
	Main.initialization();
}, false);
