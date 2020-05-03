// declaracion de variables y demas
var valores_setinterval = new Array();
var URL_PROYECTO = "";
var idsetimeout = 1;
var idsetimeout2 = 1;
var booleanscroll = true;
// identidicaicon unica del elmentod de la concersacion
var chat = document.getElementById("conversacion");
// trae la url unicamente
ejecucionAjax("message/getURL_PROYECTO", procesoAjaxGETURL_PROYECTO);

// muestra el nombre de la imagen cuando se completa el perfil
if (document.querySelector("#profileFile")) {
    document
        .querySelector("#profileFile")
        .addEventListener("change", function(e) {
            var cantidadLetras = e.target.files[0].name.length;
            var string = e.target.files[0].name;

            if (cantidadLetras > 30) {
                if (window.screen.width > 768) {
                    string = string.substr(0, 50) + "...";
                } else {
                    string = string.substr(0, 25) + "...";
                }
            }
            document.querySelector("#file").innerHTML = string;
        });
}
// Autoincrementa la altura del textarea cuando se va a realizar una nueva publicacion
if (document.querySelector("#post")) {
    document.querySelector("#post").addEventListener("keyup", function(e) {
        this.style.height = "auto";
        this.style.height = this.scrollHeight + "px";
    });
}

// habilita el boton de actualizar la imagen de perfil
if (document.querySelector("#cambiarImagenPerfil")) {
    document
        .querySelector("#cambiarImagenPerfil")
        .addEventListener("change", function(e) {
            document.querySelector("#btncambiarImagen").removeAttribute("disabled");
        });
}
// rellenar boton para avisar que hay una imagen para publicar
if (document.querySelector("#imagenPublicacion")) {
    document
        .querySelector("#imagenPublicacion")
        .addEventListener("change", function(e) {
            document
                .querySelector("#subirfoto")
                .classList.remove("btn-outline-secondary");
            document.querySelector("#subirfoto").classList.add("btn-success");

            if (
                e.target.files[0].type != "image/jpeg" &&
                e.target.files[0].type != "image/png" &&
                e.target.files[0].type != "image/gif" &&
                e.target.files[0].type != "image/svg+xml" &&
                e.target.files[0].type != "image/pjpeg"
            ) {
                alert("Debes subir exclusivamente una imagen");
                window.location.href = window.location.href;
            }
        });
}
// ajuste de la altura de texto de la publicacion
if (document.getElementsByClassName("ver-publicacion")) {
    var e = document.getElementsByClassName("ver-publicacion");

    for (let i = 0; i < e.length; i++) {
        if (e[i].getAttribute("data-resizable") == "true")
            var a = document.getElementById("texto-publicacion" + (i + 1));
        a.style.height = "auto";
        a.style.height = a.scrollHeight + "px";
    }
}

// ajuste de la altura de imagen de la publicacion
if (document.getElementsByClassName("containera")) {
    var e = document.getElementsByClassName("img-post-c");
    var responsive = window.innerWidth;

    for (let i = 0; i < e.length; i++) {
        // if (e[i].getAttribute("data-resizable") == "true")
        // var a = document.getElementsByClassName("crop")[i];
        var a = document.getElementsByClassName("img-post")[i];
        if (responsive <= 360) {
            if (a.width < 400) {
                e[i].style.minHeight = a.height + "px";
                e[i].style.width = a.width + "px";
                // a.style.height = a.scrollHeight + "px";
            } else if (a.width < 600) {
                e[i].style.minHeight = a.height / 1.7 + "px";
                e[i].style.width = a.width / 1.7 + "px";
            } else if (a.width < 1000) {
                e[i].style.minHeight = a.height / 2.5 + "px";
                e[i].style.width = a.width / 2.5 + "px";
            } else {
                e[i].style.minHeight = a.height / 3 + "px";
                e[i].style.width = a.width / 3 + "px";
            }
        } else {
            if (a.width < 400) {
                e[i].style.minHeight = a.height + "px";
                e[i].style.width = a.width + "px";
                // a.style.height = a.scrollHeight + "px";
            } else if (a.width < 800) {
                e[i].style.minHeight = a.height / 1.5 + "px";
                e[i].style.width = a.width / 1.5 + "px";
            } else if (a.width < 1000) {
                e[i].style.minHeight = a.height / 2.5 + "px";
                e[i].style.width = a.width / 2.5 + "px";
            } else {
                e[i].style.minHeight = a.height / 3 + "px";
                e[i].style.width = a.width / 3 + "px";
            }
        }
    }
}

// habilitar comentarios

if (document.getElementsByClassName("cm")) {
    var numero = document.getElementsByClassName("cm").length;

    for (let i = 1; i <= numero; i++) {
        document
            .getElementById("comentar" + i)
            .addEventListener("click", function(e) {
                var cajacom = document.getElementById("caja-comentario" + i);
                if (cajacom.style.display == "none") {
                    cajacom.style.display = "block";
                } else {
                    cajacom.style.display = "none";
                }
                e.preventDefault();
            });
    }
}
if (document.getElementsByClassName("confirmDelete")) {
    var numero = document.getElementsByClassName("confirmDelete");

    for (let i = 0; i < numero.length; i++) {
        numero[i].addEventListener("click", function(e) {
            if (!confirm("¿Seguro quieres eliminar todas las notificaciones?")) {
                e.preventDefault();
            }
        });
    }
}

if (document.getElementsByClassName("confirm-delete-seguidor")) {
    var numero = document.getElementsByClassName("confirm-delete-seguidor");

    for (let i = 0; i < numero.length; i++) {
        numero[i].addEventListener("click", function(e) {
            if (!confirm("¿Seguro quieres bloquear a este seguidor tuyo?")) {
                e.preventDefault();
            }
        });
    }
}

if (document.getElementsByClassName("alert-dejar-seguir")) {
    var numero = document.getElementsByClassName("alert-dejar-seguir");

    for (let i = 0; i < numero.length; i++) {
        numero[i].addEventListener("click", function(e) {
            if (!confirm("¿Seguro quieres dejar de seguil@?")) {
                e.preventDefault();
            }
        });
    }
}

if (document.getElementsByClassName("share-publication")) {
    var numero = document.getElementsByClassName("share-publication");

    for (let i = 0; i < numero.length; i++) {
        numero[i].addEventListener("click", function(e) {
            if (!confirm("¿Seguro quieres compartir esta publicacion?")) {
                e.preventDefault();
            }
        });
    }
}

if (document.getElementsByClassName("update-post")) {
    var numero = document.getElementsByClassName("update-post");

    for (let i = 0; i < numero.length; i++) {
        numero[i].addEventListener("click", function(e) {
            e.preventDefault();

            var texto = document.getElementById("texto" + this.getAttribute("id"))
                .value;
            document.getElementById("publicacion-update").value = texto;
            document.getElementById("id-update").value = this.getAttribute("id");

            $("#update-perfil").modal("show");
        });
    }
}
if (document.getElementById("img-portada")) {
    var numero = document.getElementById("img-portada");

    numero.addEventListener("change", function(e) {
        console.log("BIEN");
        var label = document.getElementById("img-portada-label");
        label.style.display = "none";
        var label2 = document.getElementById("img-portada-label2");
        label2.style.display = "inline";
    });
}
// PETICIONES AJAX
// llamado del objeto ajax
function getAjax() {
    var req;
    try {
        req = new XMLHttpRequest();
    } catch (err1) {
        try {
            req = ActiveXObject("Msxml2.XMLHTTP");
        } catch (err2) {
            try {
                req = ActiveXObject("Microsoft.XMLHTTP");
            } catch (err3) {
                return false;
            }
        }
    }

    return req;
}

if (document.getElementsByClassName("numNotificacion")) {
    var numero = document.getElementsByClassName("numNotificacion_a");

    for (let i = 0; i < numero.length; i++) {
        numero[i].addEventListener("click", function(e) {
            ejecucionAjax("notificacion/resetSatusNotificaciones");
        });
    }
}

// if (document.getElementById("deleteMessage")) {
//     var numero = document.getElementById("deleteMessage");

//     for (let i = 0; i < numero.length; i++) {
//         numero[i].addEventListener("click", function(e) {
//             ejecucionAjax("notificacion/resetSatusNotificaciones");
//         });
//     }
// }
// trae el numero de mensajes
function procesoAjaxgetChatsNavbar() {
    if (this.readyState == 4 && this.status == 200) {
        var numeroElements = document.getElementsByClassName("numChats");
        for (let i = 0; i < numeroElements.length; i++) {
            if (!isNaN(parseInt(this.responseText))) {
                numeroElements[i].innerHTML = this.responseText;
                numeroElements[i].style.display = "";
            } else {
                numeroElements[i].style.display = "none";
            }
        }
    }
}

function eliminarMessage() {
    document;
}

// trae el numero de notificaciones
function procesoAjaxNotificacion() {
    if (this.readyState == 4 && this.status == 200) {
        var numeroElements = document.getElementsByClassName("numNotificacion");
        for (let i = 0; i < numeroElements.length; i++) {
            if (!isNaN(parseInt(this.responseText))) {
                numeroElements[i].innerHTML = this.responseText;
                numeroElements[i].style.display = "";
            } else {
                numeroElements[i].style.display = "none";
            }
        }
    }
}
// trae el numero de solicitudes
function procesoAjaxSolicitudes() {
    if (this.readyState == 4 && this.status == 200) {
        var numeroElements = document.getElementsByClassName("numSolicitud");
        for (let i = 0; i < numeroElements.length; i++) {
            if (!isNaN(parseInt(this.responseText))) {
                numeroElements[i].innerHTML = this.responseText;
                numeroElements[i].style.display = "";
            } else {
                numeroElements[i].style.display = "none";
            }
        }
    }
}

function procesoAjaxgetUsuario() {
    if (this.readyState == 4 && this.status == 200) {
        var data;
        if (typeof this.responseText !== "undefined") {
            data = JSON.parse(this.responseText);
        } else {
            data = this.responseText;
        }
        document.getElementById("namechat").innerHTML = data.nombre;
        document
            .getElementById("imgchat")
            .setAttribute("src", data.url_proyecto_static + "" + data.foto);
        // document
        //     .getElementById("eliminar-chat")
        //     .setAttribute(
        //         "href",
        //         data.url_proyecto + "/message/deleteMessages/" + data.idusuario
        //     );
    }
}

function procesoAjaxGETURL_PROYECTO() {
    if (this.readyState == 4 && this.status == 200) {
        var data;
        if (typeof this.responseText !== "undefined") {
            data = JSON.parse(this.responseText);
        } else {
            data = this.responseText;
        }
        URL_PROYECTO = data.url;
    }
}

function procesoAjaxdeleteMessage() {
    if (this.readyState == 4 && this.status == 200) {
        var data;
        if (typeof this.responseText !== "undefined") {
            data = JSON.parse(this.responseText);
        } else {
            data = this.responseText;
        }
        if (data) {
            clearTimeout(idsetimeout);
        }
    }
}

function procesoAjaxgetMessages() {
    if (this.readyState == 4 && this.status == 200) {
        var data;
        if (typeof this.responseText !== "undefined") {
            data = JSON.parse(this.responseText);
        } else {
            data = this.responseText;
        }

        var textChat = document.getElementById("text-chat");
        var contentChat = "";
        var idusuario = chat.getAttribute("value");

        for (let i = 0; i < data.length; i++) {
            if (data[i].usuarioMando != idusuario) {
                // console.log(data[i]);
                contentChat += '<div class="text-right mensaje-right linear show "> ';
                contentChat +=
                    '<a  class="stop-setinterval mb-1 ml-1 float-left " id="actions_publication" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                contentChat += '<i class="fas fa-angle-down small"></i>';
                contentChat += "</a>";
                contentChat +=
                    '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="#actions_publication">';
                contentChat += '<h6 class="dropdown-header">Opcion</h6>';
                contentChat +=
                    '<a class="eliminar-mensaje dropdown-item small " value="' +
                    data[i].idmensaje +
                    '"  href=""><i class="fas fa-trash"></i> Eliminar</a>';
                contentChat += "</div>";
                contentChat +=
                    '<span class="p mr-2 ml-2">' + data[i].contenido + "</span>";
                contentChat +=
                    '<div class="small mr-2 ml-2 text-muted">' +
                    getDatetime(data[i].fechaMensaje) +
                    "</div>";

                contentChat += "</div>";
            } else {
                contentChat += '<div class="text-left mensaje-left">';
                contentChat +=
                    '<span class="p mr-2 ml-2">' + data[i].contenido + "</span>";
                contentChat +=
                    '<div class="small mr-2 ml-2 text-muted">' +
                    getDatetime(data[i].fechaMensaje) +
                    "</div>";
                contentChat += "</div>";
            }
        }
        if (textChat.innerHTML != contentChat) {
            textChat.innerHTML = contentChat;
            if (booleanscroll) {
                chat.scrollTo(0, chat.scrollHeight);
                clearTimeout(idsetimeout2);
            }
            var i = 0;

            chat.addEventListener("scroll", function(e) {
                // VERIFICA PARA NO PARA EL CHAT AL ENVIAR UN SIMPLE MENSAJE

                if (this.scrollTop < this.scrollHeight * 0.95) {
                    booleanscroll = false;
                    if (i < 10) {
                        i++;
                        idsetimeout2 = setTimeout((e) => {
                            booleanscroll = true;
                        }, 10000);
                    }
                }
            });

            var stopinterval = document.getElementsByClassName("stop-setinterval");
            for (let i = 0; i < stopinterval.length; i++) {
                stopinterval[i].addEventListener("click", function() {
                    limpiarSetInterval("all");
                    idsetimeout = setTimeout(() => {
                        activeClickElementClass();
                        newSetInterval(1);
                    }, 5000);
                });
            }

            var eliminarMensaje = document.getElementsByClassName("eliminar-mensaje");
            for (let i = 0; i < eliminarMensaje.length; i++) {
                eliminarMensaje[i].addEventListener("click", function(e) {
                    ejecucionAjax(
                        "/message/deleteMessage/" + this.getAttribute("value"),
                        procesoAjaxdeleteMessage
                    );
                    // console.log(idsetimeout);
                    activeClickElementClass();
                    newSetInterval(1);

                    e.preventDefault();
                });
            }
        }
    }
}

function procesoAjaxsendMessage() {
    if (this.readyState == 4 && this.status == 200) {
        var data;
        if (typeof this.responseText !== "undefined") {
            data = JSON.parse(this.responseText);
        } else {
            data = this.responseText;
        }

        if (data === true) {
            var formulario = document.getElementById("content-message");
            formulario.value = "";
            chat.scrollTo(0, chat.scrollHeight);
            formulario.focus();
        } else {
            alert("Lo sentimos el chat no funciona");
        }
    }
}

function procesoAjaxBusquedaChats() {
    if (this.readyState == 4 && this.status == 200) {
        var data;
        if (typeof this.responseText !== "undefined") {
            data = JSON.parse(this.responseText);
        } else {
            data = this.responseText;
        }
        var showChats = "";
        for (let i = 0; i < data.length; i++) {
            showChats +=
                '<div class="simulacion-option py-2 mt-2" value="' +
                data[i].idusuario +
                '">';

            showChats += '<a class="text-decoration-none" href="#">';
            showChats +=
                '<img style="width:34px;height:34px" src="' +
                data[i].fotoPerfil +
                '" alt="imagen" class="img-form rounded-circle">';
            showChats +=
                '     <span class="h6 ml-2">' + data[i].nombreCompleto + "</span>";
            showChats += "  </a>";
            showChats += "</div>";
        }
        if ((document.getElementById("show-chats").innerHTML = showChats)) {
            activeClickElementClass();
        }
    }
}

function ejecucionAjax(url, funcionAjax = function() {}, parametros = null) {
    var ajax = getAjax();
    ajax.open("POST", "/public/?url=/" + url);
    ajax.onreadystatechange = funcionAjax;
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send(parametros);
}

if (document.getElementById("show-chats")) {
    document
        .getElementById("buscar_chat")
        .addEventListener("keyup", function(e) {
            ejecucionAjax(
                "message/getUsuarios/" + this.value,
                procesoAjaxBusquedaChats
            );
        });
}

if (document.getElementById("send-message")) {
    function sendMessage() {
        var form = document.getElementById("content-message");
        var idusuario = document
            .getElementById("conversacion")
            .getAttribute("value");
        var params = "idusuario=" + idusuario + "&message=" + form.value;
        if (form.value != "") {
            ejecucionAjax("message/addmessage", procesoAjaxsendMessage, params);
        }
    }
    document
        .getElementById("send-message")
        .addEventListener("click", sendMessage, false);
    document.getElementById("content-message").addEventListener(
        "keydown",
        function(e) {
            if (e.key == "Enter") {
                sendMessage();
            }
        },
        false
    );
}

function switchElementClass(elemento, switchs) {
    var elemento = document.getElementsByClassName(elemento);
    for (let i = 0; i < elemento.length; i++) {
        elemento[i].style.display = switchs;
    }
}
// varible global

function activeClickElementClass() {
    var elemento = document.getElementsByClassName("simulacion-option");
    var cont = 0;

    for (let i = 0; i < elemento.length; i++) {
        elemento[i].addEventListener("click", function() {
            cont++;
            document
                .getElementById("conversacion")
                .setAttribute("value", this.getAttribute("value"));
            ejecucionAjax(
                "message/getusuario/" + this.getAttribute("value"),
                procesoAjaxgetUsuario
            );
            if (window.screen.width < 768) {
                switchElementClass("hidden-chat", "none");
                switchElementClass("hidden-chat-celular", "none");
            } else {
                switchElementClass("simulacion-option", "none");
                switchElementClass("simulacion-option-chat", "block");
                switchElementClass("hidden-chat", "none");
            }
            switchElementClass("show-chat", "block");
            var idusuario = document
                .getElementById("conversacion")
                .getAttribute("value");
            ejecucionAjax("message/getmessages/" + idusuario, procesoAjaxgetMessages);

            newSetInterval(cont);
            limpiarSetInterval();
        });
    }
}

function newSetInterval(cont) {
    valores_setinterval.push({
        contador: cont,
        intervalID: getsetIntervalID(),
    });
}

function getsetIntervalID() {
    var idusuario = document.getElementById("conversacion").getAttribute("value");
    var intervalID = setInterval(function() {
        ejecucionAjax("message/getmessages/" + idusuario, procesoAjaxgetMessages);
        console.log("interval" + intervalID);
    }, 1000);
    return intervalID;
}

function limpiarSetInterval(tipo = "normal") {
    if (tipo == "normal") {
        if (valores_setinterval.length > 1) {
            var valor = valores_setinterval.length - 1;
            for (let i = 0; i < valores_setinterval.length; i++) {
                if (
                    valores_setinterval[valor].intervalID !=
                    valores_setinterval[i].intervalID
                ) {
                    clearInterval(valores_setinterval[i].intervalID);
                }
            }
        }
    } else {
        for (let i = 0; i < valores_setinterval.length; i++) {
            clearInterval(valores_setinterval[i].intervalID);
        }
    }
}

function switchElementId(elemento, switchs) {
    var elemento = document.getElementById(elemento);
    elemento.style.display = switchs;
}

function llamadoFuncionesSetInterval() {
    ejecucionAjax("message/getChats/", procesoAjaxgetChatsNavbar);
    ejecucionAjax("notificacion/getnumNotificaciones", procesoAjaxNotificacion);
    ejecucionAjax("perfil/getNumSolicitudes", procesoAjaxSolicitudes);
}

switchElementClass("show-chat", "none");
window.addEventListener("load", function(e) {
    activeClickElementClass();
    llamadoFuncionesSetInterval();

    this.setInterval(function() {
        llamadoFuncionesSetInterval();
    }, 2000);
});

function getDatetime(fecha) {
    var datetime = new Date(fecha),
        mes = new Array(),
        ano = datetime.getFullYear(),
        dia = datetime.getDate(),
        fecha = "",
        hour = "",
        minutos = datetime.getMinutes(),
        segundos = datetime.getSeconds(),
        hora = new Array();
    mes[0] = "Enero";
    mes[1] = "Febrero";
    mes[2] = "Marzo";
    mes[3] = "Abril";
    mes[4] = "Mayo";
    mes[5] = "Junio";
    mes[6] = "Julio";
    mes[7] = "Agosto";
    mes[8] = "Septiembre";
    mes[9] = "Octubre";
    mes[10] = "Noviembre";
    mes[11] = "Diciembre";

    hora[0] = 12;
    hora[1] = 1;
    hora[2] = 2;
    hora[3] = 3;
    hora[4] = 4;
    hora[5] = 5;
    hora[6] = 6;
    hora[7] = 7;
    hora[8] = 8;
    hora[9] = 9;
    hora[10] = 10;
    hora[11] = 11;
    hora[12] = 12;
    hora[13] = 1;
    hora[14] = 2;
    hora[15] = 3;
    hora[16] = 4;
    hora[17] = 5;
    hora[18] = 6;
    hora[19] = 7;
    hora[20] = 8;
    hora[21] = 9;
    hora[22] = 10;
    hora[23] = 11;

    var meridiano = datetime.getHours() >= 12 ? " pm" : " am";
    fecha = mes[datetime.getMonth()] + " " + dia + " " + ano;
    minutos = minutos < 10 ? "0" + minutos : minutos;
    hour = hora[datetime.getHours()] + ":" + minutos + ":" + segundos + meridiano;
    return fecha + " - " + hour;
}