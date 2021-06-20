function showModalTermos(){
    document.getElementById("m-modal").style.display = "flex";
}

function showModalLogin(){
    document.getElementById("m-modal-registro").style.display = "none";
    document.getElementById("m-modal").style.display = "none";
    document.getElementById("m-modal-login").style.display = "flex";
}

function showModalRegistro(){
    document.getElementById("m-modal-login").style.display = "none";
    document.getElementById("m-modal-registro").style.display = "flex";
}

function closeModalTermos(){
    document.getElementById("m-modal").style.display = "none";
}

function closeModalMenu(){
    document.getElementById("m-modal-menu").style.display = "none";
}


function showModalMenu(){
    document.getElementById("m-modal-menu").style.display = "flex";
}