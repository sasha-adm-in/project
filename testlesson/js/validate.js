//функция вывода ошибок
function showError(container, errorMessage){
	container.className = 'error';
	var msgElem = document.createElement('span');
	msgElem.className = "error-message";
	msgElem.innerHTML = errorMessage;
	container.appendChild(msgElem);
}
//функция вывода ошибок для файла
function showErrorFile(container, errorMessage){
	var msgElem = document.createElement('span');
	msgElem.className = "error-message-file";
	msgElem.innerHTML = errorMessage;
	container.replaceChild(msgElem, container.lastChild);
}
//функция сброса ошибок
function resetError(container){
	container.className = '';
	if(container.lastChild.className == "error-message"){
		container.removeChild(container.lastChild);
	}
}
//функция проверок полей формы
function validate(form){
	var elems = form.elements;
	var control = true;
	var reg_mail = /^[\w\.\d-_]+@[\w\.\d-_]+\.\w{2,4}$/i;
	var reg_tel = /^[0-9]{10}$/;

	resetError(elems.surname.parentNode);
	if(!elems.surname.value){
		var control = false;
		showError(elems.surname.parentNode, 'Введите фамилию');
	}

	resetError(elems.name.parentNode);
	if(!elems.name.value){
		var control = false;
		showError(elems.name.parentNode, 'Введите имя');
	}

	resetError(elems.secondname.parentNode);
	if(!elems.secondname.value){
		var control = false;
		showError(elems.secondname.parentNode, 'Введите отчество');
	}

	resetError(document.getElementById("birth"));
	if(!elems.birthday.value){
		var control = false;
		showError(document.getElementById("birth"), 'Введите число рождения');
	}		
	if(!elems.birthmonth.value){
		var control = false;
		resetError(document.getElementById("birth"));
		showError(document.getElementById("birth"), 'Введите месяц рождения');
	}
	if(!elems.birthyear.value){
		var control = false;
		resetError(document.getElementById("birth"));
		showError(document.getElementById("birth"), 'Введите год рождения');
	}

	resetError(document.getElementById("sex"));
	if(!elems.sex.value){
		var control = false;
		showError(document.getElementById("sex"), 'Укажите пол');
	}

	resetError(elems.adress.parentNode);
	if(!elems.adress.value){
		var control = false;
		showError(elems.adress.parentNode, 'Введите адресс проживания');
	}

	resetError(elems.tel.parentNode);
	if(!elems.tel.value){
		var control = false;
		showError(elems.tel.parentNode, 'Введите контактный номер телефона');
	}else if(!reg_tel.test(elems.tel.value)){			  
		var control = false;
		showError(elems.tel.parentNode, 'Введите корректный номер телефона');			
	} 
	
	resetError(elems.mail.parentNode);
	if(!elems.mail.value){
		var control = false;
		showError(elems.mail.parentNode, 'Введите контактный адрес эл.почты');
	}else if(!reg_mail.test(elems.mail.value)){			  
		var control = false;
		showError(elems.mail.parentNode, 'Введите корректный адрес эл.почты');
	} 

	resetError(elems.pass.parentNode);
	resetError(elems.pass2.parentNode);
	if(!elems.pass.value){
		var control = false;
		showError(elems.pass.parentNode, 'Укажите пароль');
	}else if(elems.pass.value != elems.pass2.value){
		var control = false;
		showError(elems.pass2.parentNode, 'Пароли не совпадают');
	}


	if(elems.file){
		var fileObj = elems.file.files[0]; 
		var fileSize = fileObj.size || fileObj.fileSize;
		var fileType = fileObj.type || fileObj.mediaType; 		   

		if(fileType == 'image/jpeg' || fileType == 'image/png' || fileType == 'image/gif'){					
		}else{
			var control = false;
			showErrorFile(document.getElementById("file"), 'Не верный тип файла');
		}
		if(fileSize > "10000000"){
			var control = false;
			showErrorFile(document.getElementById("file"), 'Файл превышает 10Мб');
		}
	}

	if(control) document.forms["myform"].submit();
}