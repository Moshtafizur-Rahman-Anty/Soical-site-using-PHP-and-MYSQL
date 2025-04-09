document.addEventListener("DOMContentLoaded", function() {

    //get the form element
    const loginform = document.getElementById('first');
    const registerform = document.getElementById('second');

    let registerButton = document.getElementById('register_button');

    console.log(registerButton);

    //get the links for toggling forms

    const toRegisterLink = document.getElementById('signup');
    const toLoginLink = document.getElementById('signin');


    
    toRegisterLink.addEventListener('click', function (e) {
        e.preventDefault();
        loginform.style.display = 'none';
        registerform.style.display = 'block';
    });


    toLoginLink.addEventListener('click', function (e) {
        e.preventDefault();
        loginform.style.display = 'block';
        registerform.style.display = 'none';
    });


});