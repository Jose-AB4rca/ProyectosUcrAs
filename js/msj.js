let msj = document.getElementById('#msj');

const openMsj = (tipo,txt) => {
   msj.style.display = 'flex';
   msj.innerHTML = txt;  
   msj.classList.add(tipo);
   closeMsj();
}

const closeMsj = (tipo) => {
    setTimeout(() =>{
        msj.style.display = 'none';
        msj.classList.remove(tipo);
    }, 4000)
}