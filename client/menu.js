const toggle = document.getElementById("toggle");
const menu = document.getElementById("menu");

toggle.addEventListener('click' , ()=>{
	if(menu.style.right === "1000px"){
		menu.style.right = "0";
	}
	else{
		menu.style.right = "1000px";
	}
})


const search_btn = document.getElementById("search_btn");
const search_input = document.getElementById("search_input");

search_btn.addEventListener('click' , ()=>{
	if(search_input.style.display === "none"){
		search_input.style.display = "flex";
	}
	else{
		search_input.style.display = "none";
	}
})