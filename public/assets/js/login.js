export function checkSubmission(form){
	let button = form.lastElementChild.getElementsByTagName('button')[0];
	button.getElementsByTagName('span')[0].innerText = 'Process...';
	button.disabled = true;
}