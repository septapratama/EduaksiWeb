const navItems = document.querySelectorAll('header li a');
navItems.forEach(navItem => {
    navItem.addEventListener('click',function(){
        navItems.forEach(item => {
            item.classList.remove('active');
        });
        this.classList.add('active');
    })
});