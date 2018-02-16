var $collectionHolder1;
var $collectionHolder2;
var $collectionHolder3;//belong account

var $addEmailLink = $('<a href="#"><span class="glyphicon glyphicon-plus"></span></a>');// setup an "add a email" link
var $addTelephoneLink = $('<a href="#"><span class="glyphicon glyphicon-plus"></span></a>');// setup an "add a telephone" link
var $addAccountLink = $('<a href="#"><span class="glyphicon glyphicon-plus"></span></a>');// setup an "add a telephone" link

var $newLinkEmailLi = $('<li></li>').append($addEmailLink);
var $newLinkTelephoneLi = $('<li></li>').append($addTelephoneLink);
var $newLinkAccountLi = $('<li></li>').append($addAccountLink);

jQuery(document).ready(function() {

    $('.link-tooltip').tooltip();
    PNotify.prototype.options.styling = "bootstrap3";

    $collectionHolder1 = $('ul.emails');// Get the ul that holds the collection of notifications
    $collectionHolder2 = $('ul.phones');// Get the ul that holds the collection of telephones

    $collectionHolder1.append($newLinkEmailLi);// add the "add a email" anchor and li to the notifications ul
    $collectionHolder2.append($newLinkTelephoneLi);// add the "add a telephone" anchor and li to the telephones ul

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder1.data('index', $collectionHolder1.find(':input').length);
    $collectionHolder2.data('index', $collectionHolder2.find(':input').length);
    $addEmailLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see next code block)
        addEmailForm($collectionHolder1, $newLinkEmailLi);
    });

    $addTelephoneLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see next code block)
        addTelephoneForm($collectionHolder2, $newLinkTelephoneLi);
    });

    // //configuracion del campo date de los contratos
    $('#appbundle_contract_startDate').datetimepicker({
        defaultDate: Date('now'),
        format: 'YYYY-MM-DD',
        locale: 'es',
        maxDate : new Date(),
        showClear: true,
    });
    //
    // //configuracion del campo date de los contratos
    $('#appbundle_contract_expirationDate').datetimepicker({
        // userCurrent : false,
        // defaultDate: Date('now'),
        format: 'YYYY-MM-DD',
        locale: 'es',
        minDate : new Date(),
        showClear: true,
    });

    $('#appbundle_contract_agreementDateUASI').datetimepicker({
        // userCurrent : false,
        // defaultDate: Date('now'),
        format: 'YYYY-MM-DD',
        locale: 'es',
        maxDate : new Date(),
        showClear: true,
    });

    $('#appbundle_contract_agreementDateCC').datetimepicker({
        // userCurrent : false,
        // defaultDate: Date('now'),
        format: 'YYYY-MM-DD',
        locale: 'es',
        maxDate : new Date(),
        showClear: true,
    });

    // $('#datetimepicker6').data("DateTimePicker").minDate(e.date);
    //
    //dependencias de los selects de fecha de la reclamacion y la fecha del cierre de la reclamacion
    $("#appbundle_contract_startDate").on("dp.change", function (e) {
        $('#appbundle_contract_expirationDate').data("DateTimePicker").minDate(e.date);
    });

    $("#appbundle_contract_expirationDate").on("dp.change", function (e) {
        $('#appbundle_contract_startDate').data("DateTimePicker").maxDate(e.date);
    });

    initiCheck();
    //tranfiere la url almacenada en data-url attr para el boton de confirmaciond si del modal
    $(".link-eliminar").click(function (event) {
        event.preventDefault();
        // alert($(this).attr("description"));
        $("#link-popup-eliminar").attr("href", $(this).attr("data-url"));
        $("p#text-descripcion-popup-eliminar").html($(this).attr("description"));
    });

    //tranfiere la url almacenada en data-url attr para el action del formulario de cambiar la contrasena
    $(".change_password").click(function (event) {
        $("form.form_change_password").attr("action", $(this).attr("data-url"));
    });

    //esto verifica q las contrasenas sean iguales
    $('a.btn-submit').click(function (event) {
        if ($('input[name=first_password]').val()!=$('input[name=second_password]').val()){
            new PNotify({
                title: '!Error',
                type : 'error',
                text: 'Sus contraseñas no coinciden'
            })
        }else {
            $(this).next().click();
        }
    });
});

//inicia todos los radios y checkbox
function initiCheck() {
    $('.icheck').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
}

function addEmailForm($collectionHolder1, $newLinkEmailLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder1.data('prototype');

    // get the new index
    var index = $collectionHolder1.data('index');

    var newForm = prototype;
    // You need this only if you didn't set 'label' => false in your tags field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder1.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkEmailLi.before($newFormLi);

    addEmailFormDeleteLink($newFormLi);
}

function addTelephoneForm($collectionHolder2, $newLinkTelephoneLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder2.data('prototype');

    // get the new index
    var index = $collectionHolder2.data('index');

    var newForm = prototype;
    // You need this only if you didn't set 'label' => false in your tags field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder2.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkTelephoneLi.before($newFormLi);

    addTelephoneFormDeleteLink($newFormLi);
}

function addAccountForm($collectionHolder3, $newLinkAccountLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder3.data('prototype');

    // get the new index
    var index = $collectionHolder3.data('index');

    var newForm = prototype;
    // You need this only if you didn't set 'label' => false in your tags field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder3.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkAccountLi.before($newFormLi);

    // addTelephoneFormDeleteLink($newFormLi);
}

function addEmailFormDeleteLink($emailFormLi) {
    var $removeFormA = $('<a href="#"><span class="glyphicon glyphicon-trash"></span></a>');
    $emailFormLi.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $emailFormLi.remove();
    });
}

function addTelephoneFormDeleteLink($telephoneFormLi) {
    var $removeFormA = $('<a href="#"><span class="glyphicon glyphicon-trash"></span> </a>');
    $telephoneFormLi.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $telephoneFormLi.remove();
    });
}

//ws
// var WS = new GosSocket("ws://127.0.0.1:8080");
// var webSocket = WS.connect("ws://127.0.0.1:8080");
//
// webSocket.on("socket/connect", function(session){
//     //session is an Autobahn JS WAMP session.
//
//     console.log("Successfully Connected!");
// })
//
// webSocket.on("socket/disconnect", function(error){
//     //error provides us with some insight into the disconnection: error.reason and error.code
//
//     console.log("Disconnected for " + error.reason + " with code " + error.code);
// });