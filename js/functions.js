function toggle(name){

	node = document.getElementById(name);

	if (node.style.visibility == "hidden") {
		node.style.visibility = "visible";
		node.style.height = "auto";
		node.style.width = "auto";
	} else {
		node.style.visibility = "hidden";
		node.style.height = "0";
	}
}

function multiple_toggle(){
	for (var i = 0; i < arguments.length; i++) {
		comment(arguments[i]);
	}
}

function show(name){
	node = document.getElementById(name);

	if (node.style.display == "none") {
		node.style.display = "block";
	} else {
		node.style.display = "none";
	}
}

function showAndUnview(name, id, user_id) {
	//$.get("test.php"); 
	show(name);
	$.post('unset_comment.php', {'user_id': user_id, 'id': id});
}

function changeValueCheckbox(element){
	   if(element.checked){
	    element.value='on';
	  }else{
	    element.value='off';
	  }
	}