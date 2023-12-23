var menu = document.querySelector('.product-menu');
window.addEventListener('scroll',()=>{
    const x = window.scrollY;
    if(x > 44)
    {
        menu.style.position = 'fixed';
        menu.style.top = 0;
    }
    else{
        menu.style.position = 'relative';
        
    }

})