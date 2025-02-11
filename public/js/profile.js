const __getId = (id) => document.getElementById(id);

const showProfile = __getId('showProfile');
const imageProfile = __getId('imageProfile');
const addImage = __getId('addImage');
const validImage = __getId('validImage');
const formImage = __getId('formImage');

localStorage.setItem('lastRoute', location.pathname);

imageProfile.addEventListener('change', (e)=>{
    showProfile.src = URL.createObjectURL(imageProfile.files[0]);
    addImage.hidden = true;
    validImage.hidden = false;
    formImage.hidden = true;
})