var Main = {
	initialization: function () {
		this.events();
	},

	events: function () {
		this.clickEvents();
	},

	clickEvents: function () {
		var tasksElements = document.getElementsByClassName('task');
		for (var i = 0; i < tasksElements.length; i++) {
			tasksElements[i].addEventListener('click', function () {
				this.childNodes[1].classList.toggle('active');
			}, false);
		}
	}
};

window.addEventListener('DOMContentLoaded', function () {
	Main.initialization();
}, false);
