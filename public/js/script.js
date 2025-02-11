/**
 * document.getElementById
 * @param {string} id 
 * @returns element
 */
const __getId = (id) => document.getElementById(id);
const __create = (tag) => document.createElement(tag);

const inputDesc = __getId('inputDesc');
const divDesc = __getId('divDesc');
const imgFile = __getId('fileImage');
const id = __getId('id');
const username = __getId('username');
const email = __getId('email');
const showImage = __getId("showImage");
const imgUp0 = __getId('imgUp0');
const imgUp1 = __getId('imgUp1');
const remove0 = __getId('remove0');
const remove1 = __getId('remove1');
const inputImage = __getId('inputImage');
const nbrMaxImage = __getId('nbrMaxImage');
const retour = __getId('retour');
const title = __getId("title");
const numberTape = __getId('numberTape');

numberTape.innerText = title.getAttribute('maxlength');
title.addEventListener('input', (e)=>{
    numberTape.innerText = title.getAttribute('maxlength') - title.value.length;
});
// back to preview route
retour.addEventListener('click', (e)=>{
    window.location = localStorage.getItem('lastRoute');
});

var countImg = showImage.children.length;
var imgMax = showImage.children.length || 2;
nbrMaxImage.innerText = imgMax;

if (countImg>0) {
    inputImage.classList.remove('block');
    inputImage.classList.add('hidden');
}

/**
 * remove placeholder
 */
divDesc.addEventListener('focusin', (ev)=>{
    if (divDesc.innerText=="Entrez ici les information concernant l'objet") {
        divDesc.innerText = "";
        divDesc.classList.remove('text-slate-600')
    }
})

/**
 * add placeholder
 */
divDesc.addEventListener('focusout', (ev)=>{
    if (divDesc.innerText == "") {
        divDesc.innerText = "Entrez ici les information concernant l'objet";
        divDesc.classList.add('text-slate-600')
    }
});

divDesc.addEventListener('input', (ev) => {
    inputDesc.value = divDesc.innerText;
});

imgFile.addEventListener( 'change', (ev)=>{

    for (let i=0; i<imgFile.files.length && countImg<imgMax;i++) {
        if (i==imgMax) break;
        let box = __create('div')
        let remove = __create('div');
        let img = __create('img');

        box.classList = "relative";
        img.src = URL.createObjectURL(imgFile.files[i]);
        box.style = " width: 50%";
        remove.classList = 'btn btn-danger position-absolute top-0 end-0 opacity-75';
        remove.innerText = "Effacer";
        // remove.classList = ' absolute top-0 right-[2%] bg-slate-400 rounded-md text-red-600 bg-slate-400 rounded-md p-1 font-semibold cursor-pointer'
        // remove.innerText = "remove";
        remove.addEventListener('click', function() {
            box.remove()
            countImg--;
        });

        box.appendChild(remove);
        box.appendChild(img);
        showImage.appendChild(box)
        countImg++
    }
})

try {
    remove0.addEventListener('click', function() {
        imgUp0.remove()
        countImg--;
        if (countImg<imgMax) {
            inputImage.classList.remove('hidden');
            inputImage.classList.add('block');
        }
    })
    remove1.addEventListener('click', function() {
        imgUp1.remove()
        countImg--;
        if (countImg<imgMax) {
            inputImage.classList.remove('hidden');
            inputImage.classList.add('block');
        }
    })
} catch (error){

}

    