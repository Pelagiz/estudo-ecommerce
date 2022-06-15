var login = document.querySelector('header .container .login');

var loginContainer = document.querySelector('header .container .login .container');
 

if(login){
    const switchLoginContainer = (e) => {
        const click = login.contains(e.target);
    
        if(click & loginContainer.classList.contains('hide')){
            loginContainer.classList.remove('hide');
        }else{
            loginContainer.classList.add('hide');
        }
    }
    
    document.addEventListener('click',switchLoginContainer);
    
    loginContainer.addEventListener('click', (e) => {
        e.stopPropagation();
    });
}
    

var logout = document.querySelector('header .container .logout');

var logoutContainer = document.querySelector('header .container .logout .container');

if(logout){
const switchLogoutContainer = (e) => {
        const click = logout.contains(e.target);
        
        if(click & logoutContainer.classList.contains('hide')){
            logoutContainer.classList.remove('hide');
        }else{
            logoutContainer.classList.add('hide');
        }
    }
    
    document.addEventListener('click',switchLogoutContainer);
    
    logoutContainer.addEventListener('click', (e) => {
        e.stopPropagation();
    });
}
    

var purchase = document.querySelector('header .container .purchase');

var purchaseCart = document.querySelector('header .container .purchase .cart');

if(purchase){
const switchPurchaseCart = (e) => {
        const click = purchase.contains(e.target);
    
        if(click & purchaseCart.classList.contains('hide')){
            purchaseCart.classList.remove('hide');
        }else{
            purchaseCart.classList.add('hide');
        }
    }
    
    document.addEventListener('click',switchPurchaseCart);
    
    purchaseCart.addEventListener('click', (e) => {
        e.stopPropagation();
    });
}