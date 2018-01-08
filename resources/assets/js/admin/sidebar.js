
const accordions = $('.has-submenu');

for (var i = 0; i < accordions.length ;i++){
    accordions[i].onclick = function() {
        const submenu = this.nextElementSibling;
        if (submenu.classList.contains('is-open')){
            submenu.classList.remove('is-open');
            submenu.classList.add('is-close');
        }else{
            submenu.classList.remove('is-close');
            submenu.classList.add('is-open');
        }
    }
}