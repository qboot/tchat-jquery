// AU CHARGEMENT DE LA PAGE
$.ajax({
    url: "lib/is-login.php"
})
.done(function(msg){
    if(msg == "Success") {
        loadTchat();
    } else {
        loadLogin();
    }
});

// FONCTIONS POUR LES DIFFERENTS LOAD
function loadLogin() {
    $('#register').html('');
    $('#tchat').html('');
    $('#login').load('lib/login-form.php');
}

function loadRegister() {
    $('#tchat').html('');
    $('#login').html('');
    $('#register').load('lib/register-form.php');
}

function loadTchat() {
    $('#register').html('');
    $('#login').html('');
    $('#tchat').load('lib/tchat-view.php');
    funRefreshTchat();
    funRefreshCo();
}

// FONCTIONS POUR LES MESSAGES FLASH
function flashHide() {
    $('.flash').css('display','block');

    setTimeout(function() {
        $('.flash').css('display','none');
    },5000);
}

// LIEN VERS LA PAGE LOGIN
$(document).on("click","#login-link",function (e) {
    e.preventDefault();

    loadLogin();
});

// LIEN VERS LA PAGE REGISTER
$(document).on("click","#register-link",function (e) {
    e.preventDefault();

    loadRegister();
});

// LIEN VERS LA PAGE LOGOUT
$(document).on("click",".logout-link",function (e) {
    e.preventDefault();

    $.ajax({
            url: "lib/logout-trait.php"
        })
        .done(function(){
            loadLogin();
            return false;
        });

});

// ENVOI FORMULAIRE REGISTER
$(document).on("click","#register-button",function (e) {

    e.preventDefault();

    if($('#register-pseudo').val() == '') {
        $('#registerWrap').children('.flash').html('Pseudo ne peut pas être vide');
        return false;
    }


    $.ajax({
            method: "POST",
            url: "lib/register-trait.php",
            data: { pseudo: $('#register-pseudo').val(), pass1: $('#register-pass1').val(), pass2: $('#register-pass2').val() }
        })
        .done(function(msg){
            if(msg == "Success") {
                loadTchat();
                return false;
            }

            $('#registerWrap').children('.flash').html(msg);

            flashHide();
        })
});


// ENVOI FORMULAIRE LOGIN
$(document).on("click","#login-button",function (e) {

    e.preventDefault();

    if($('#login-pseudo').val() == '') {
        $('#loginWrap').children('.flash').html("Le pseudo ne peut pas être vide");

        flashHide();
        return false;
    }

    $.ajax({
            method: "POST",
            url: "lib/login-trait.php",
            data: { pseudo: $('#login-pseudo').val(), pass: $('#login-pass').val() }
        })
        .done(function(msg){
            if(msg == "Success") {
                loadTchat();
                return false;
            }

            $('#loginWrap').children('.flash').html(msg);

            flashHide();
        })
});


// FILE UPLOAD

$(document).on('click','#upload-button',function(e){
    e.preventDefault();

    var formData = new FormData();
    formData.append('file', $('#upload-picture')[0].files[0]);

    $.ajax({
        url : 'lib/upload-trait.php',
        type : 'POST',
        data : formData,
        processData: false,  // tell jQuery not to process the data
        contentType: false,  // tell jQuery not to set contentType
        success : function(data) {
            console.log(data);
            loadTchat();
        }
    });
});

// ENVOI D'UN MESSAGE
$(document).on('click','#comment-button',function(e){

    e.preventDefault();

    if($('#comment-message').val() == '') {
        $('#tchatBody').children('.flash').html('Merci d\'écrire un message ');

        flashHide();
        return false;
    }

    $.ajax({
        method: "POST",
        url: "lib/comment-trait.php",
        data: { message: $('#comment-message').val() }
    })
        .done(function(msg){
            $('#comment-message').val('');
            $('#tchatBody').children('.flash').html(msg);

            flashHide();
            // on revient en bas
            $('#tchat-comments').scrollTop($('#tchat-comments').prop("scrollHeight"));
            scroll = $('#tchat-comments').prop("scrollHeight");
        });
});


// DESCENDRE LA SCROLLBAR


// position du scroll (au premier load on met la barre de scroll en bas)
var scroll = $('#tchat-comments').prop("scrollHeight");

// si scrolling = true, l'use scroll sinon scrolling = false
var scrolling = false;

// nombre de message max a afficher
var nb = 10;

// hauteur total avant refresh
var previousFullHeight = $('#tchat-comments').prop("scrollHeight");

// hauteur total après refresh
var nextFullHeight = $('#tchat-comments').prop("scrollHeight");

// fonction pour déterminer ou mettre la scrollbar juste après le load des comments
function setScroll() {

    // on set la nouvelle taille de la div dans une variable
    nextFullHeight = $('#tchat-comments').prop("scrollHeight");

    // on bind l'event scroll de la div tchat-comments
    // quand l'utilisateur a scrollé dans les dernières 250ms ou s'il est en train de scroller
    // on reset le timeout et on met scrolling sur true
    // si l'user n'a pas scrollé depuis + de 250ms, scrolling est sur false
    $('#tchat-comments').on('scroll', function () {
        scrolling = true;

        // si isScrolling est défini
        if(typeof isScrolling !== 'undefined')
            clearTimeout(isScrolling);

        isScrolling = setTimeout(function(){
            scrolling = false;
        },250);
    });

    // ICI : on va positionner la scrollbar à l'endroit voulu
    var div = $('#tchat-comments');

    //console.log(div.prop('scrollHeight')-div.height());
    console.log(scroll);
    //console.log('prev:'+previousFullHeight);
    //console.log('next:'+nextFullHeight);

    // si la position du scroll est à moins de 150px du bas de la div des commentaires
    // ou si c'est le premier load (undefined)
    // alors on fixe la position du scroll à tout en bas
    if(scroll > div.prop('scrollHeight')-div.height()-125 || typeof scroll == 'undefined') {

        div.scrollTop(div.prop("scrollHeight"));

        // sinon on fixe la position du scroll au niveau de l'ancien scroll
    } else {

        // si la taille de la div a changé donc si la différence entre prevfullheight et nextfullheight est > 0
        // alors on ajoute la différence de pixel au scroll
        // pour que la scroll bar soit bien positionnée (pas en haut des nouveaux messages)
        if(previousFullHeight !== nextFullHeight) {
            var diff = Math.abs(nextFullHeight-previousFullHeight);
            div.scrollTop(scroll+diff);
        } else {
            div.scrollTop(scroll);
        }
    }
}

// on refresh le tchat toutes les x ms
refreshTchat = setInterval(function(){
    funRefreshTchat();
},250); // 250


// on refresh la liste des connectés
refrechConnectes = setInterval(function() {
    funRefreshCo();
},250); // 250




function funRefreshTchat() {
    // si l'utilisateur est en train de scroller, on ne fait pas de refresh
    if(scrolling) {
        return false;
    }

    // on récupère la position du scroll avant de refresh
    scroll = $('#tchat-comments').scrollTop();

    // si la position du scroll est inférieur à 50px en partant du haut on load 10messages de plus
    if(typeof scroll !== 'undefined') {
        if(scroll < 50) {
            nb = nb+10;
        }
    }

    previousFullHeight = $('#tchat-comments').prop("scrollHeight");

    // on load les comments et on fait un callback pour positionner le scroll en utilisant la variable scroll
    $('#tchat-content').load('lib/tchat-content.php', {limit:nb}, setScroll);
}

function funRefreshCo() {
    $('#listConnectes').load('lib/listConnectes-view.php');
}






// CHANGER LE THEME PAR DEFAUT
$(document).on("click",".choice-color",function (e) {

    e.preventDefault();

    $.ajax({
            method: "POST",
            url: "lib/theme-trait.php",
            data: { color: $(this).attr('data') }
        })
        .done(function(){
            loadTchat();
            return false;
        });
});