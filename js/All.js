function navegacion(userBar, menuBar) {
	userBar.addEventListener('click', () => {
		menuBar.classList.toggle('showBar');
	});
	// menuBar.addEventListener('blur', () => {
	// 	menuBar.classList.toggle('showBar');
	// });
}

function itemsTable(items) {
	items.forEach(i => {
		i.addEventListener('click', (e) => {
			let obj = i.parentElement.children;
			for (const key in obj) {
				key > 2 ? obj[key].classList.toggle('iflex') : null ;
			}
		});
	});
}
itemsTable(document.getElementsByName('citas-table'));
navegacion(document.getElementById('userBar'), document.getElementById('menuBar'));