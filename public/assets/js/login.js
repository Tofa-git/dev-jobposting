export function checkSubmission(form){
	let button = form.lastElementChild.getElementsByTagName('button')[0];
	button.getElementsByTagName('span')[0].innerText = 'Process...';
	button.disabled = true;
}

export function togglePassword(event){
	event.preventDefault();
	let x = event.target.parentNode.parentNode.children[1];
	if (x.type === "password") {
		x.type = "text";
	} else {
		x.type = "password";
	}
	let y = event.target;
	if(y.innerText === 'visibility_off'){
		y.innerText = 'visibility';
		y.classList.remove('text-info');
		y.classList.add('text-light');
	}else{
		y.innerText = 'visibility_off';
		y.classList.remove('text-light');
		y.classList.add('text-info');
	}
}

export function clearValue(event){
	event.preventDefault();
	let x = event.target.parentNode.parentNode.children[1];
	x.value = '';
	x.focus();
}