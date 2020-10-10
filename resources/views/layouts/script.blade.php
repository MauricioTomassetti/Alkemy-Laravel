<script type="text/javascript">
$(document).ready(function(e) {
    /*
    * Logica para la compra y cancelacion de applicaciones
    */
        $('.submitForm').click(function(e) {
            e.preventDefault();

            let id = $(this).attr('idapp');

            if (($(this).attr('formaction')) === 'buy') {

                let action = 'Compra'
                let buttonModal = '#sucessBuy';
                let buttonMessage = '#successMessageBuy'
                let Cardid = '#card-' + id
                let ButtonId = 'button[name=' + id + ']'

                $.ajax(
                    {
                    url: '/api/buy',
                    type: "POST",
                    data: {
                        app_id: id,
                        _token: "{{csrf_token()}}"
                    },
                    success: function(data) {
                        let image = "src={{ asset('images/check.gif') }}";
                        messageOperation(image, action, Cardid, ButtonId, buttonModal, buttonMessage, data);

                    },
                    error: function(msg) {
                        let image = "src={{ asset('images/error.gif') }}"
                        messageOperation(image, action, Cardid, ButtonId, buttonModal, buttonMessage, data);
                    }
                });
            }

            if (($(this).attr('formaction')) === 'cancel') {

                let action = 'Cancelacion'
                let buttonModal = '#cancelBuy';
                let buttonMessage = '#cancelMessageBuy'
                let Cardid = '#card-' + id
                let ButtonId = 'button[name=' + id + ']'

                $.ajax(
                    {
                    url: '/api/cancelbuy/' + id,
                    type: "DELETE",
                    data: {
                        app_id: id,
                        _token: "{{csrf_token()}}"
                    },
                    success: function(data) {
                        let image = "src={{ asset('images/cancel.gif') }}"
                        messageOperation(image, action, Cardid, ButtonId, buttonModal, buttonMessage, data);
                    },
                    error: function(data) {
                        let image = "src={{ asset('images/error.gif') }}"
                        messageOperation(image, action, Cardid, ButtonId, buttonModal, buttonMessage, data);
                    }
                })
            }
        })

        function messageOperation(image, action, Cardid, ButtonId, buttonModal, buttonMessage, data) {
            console.log(image);
            let htmlMessage = $('<img class="loadergif" ' + image + ' width="100%" ><div class="alert alert-success"><h4 class="alert-heading">Su '+ 
            action + ' ha sido completada con exito.</h4></div><strong class="text-center">Regresando al app market..</strong>');
            $(ButtonId).prop('disabled', true);
            $(buttonModal).modal('show')
            $(buttonMessage).empty();
            setTimeout(function() {
                $(Cardid).remove();
                $(buttonMessage).append(htmlMessage).delay(4000).fadeIn('slow');
                setTimeout(function() {
                    $(buttonModal).modal("hide").delay(4000);
                    window.location = data.url
                    removeItemFollow(id);
                }, 5000);
            }, 2500);
        }
     /* 
     *Logica del Boton Agregar a deseados 
    */
        $('.desired').click(function(e) {
            e.preventDefault();

            let id = $(this).attr('idapp');
            $.ajax({
                url: '../app/' + id,
                type: "POST",
                data: {_token: "{{csrf_token()}}"},
                success: function(data) {
                    notifyMessage(data);
                },
                error: function(data) {
                    notifyMessage(data);
                }
            })
        })
       
        function notifyMessage(data){
            let notify = $.notify('<div><strong>Agregado a deseados! </strong></div> ' + data.message, { type: 'success' });
                $('.desired').attr('disabled', true); 
            }

 /*
    * Logica para la tabla de aplicaciones deseadas.
    */
        $('#desiredListUser').click(function(e) {
            e.preventDefault();
            let name = $(this).attr('userapp');

            if (name == '') {
                $('#desirelist').empty();
                return loadFollowsItems();
            }
            $.ajax({
                url: '../me/app/list/'+name,
                type: "GET",
                success: function(data) {
                    $('#desirelist').empty();

                    data.appsDesired.forEach(element => {
                        let newItem = {};
                        newItem[element.id] = {
                            'app': element.id,
                            'name': element.name,
                            'price': element.price
                        };
                        followTable(newItem);
                    });
                },
                error: function(data) {
                    var notify = $.notify('<div><strong>Error al mostrar las apps </strong></div>', {
                        type: 'danger',
                    });
                }
            })

        })

        /* Limite de texto que se muestra en las descripciones de las cards. */
        let maxlength = 70;
        $('.description').text(function(_, text) {
            return $.trim(text).substring(0, maxlength);
        });

      /*
    * Leo el localStorage para que usuario no autenticados pudan agregar applicaciones
    */
        loadFollowsItems();
    });

     /*
    * Funciones para el apartado de mis apps que estoy siguiendo. (LocalStorage y Guardados en la BD)
    */

    function loadFollowsItems() {
        let oldItems = JSON.parse(localStorage.getItem('follow')) || [];
      
        oldItems.forEach(element => {
            followTable(element);
        });
    }

    function addRow(id, price, name) {
        let oldItems = JSON.parse(localStorage.getItem('follow')) || [];
        let newItem = {};
        newItem[id] = {
            'app': id,
            'name': name,
            'price': price
        };

        followTable(newItem);
        oldItems.push(newItem);
        let notify = $.notify('<div><strong>Agregado a deseados! </strong></div> Esta applicacion ya se encuentra en la lista de deseados', { type: 'success' });
        localStorage.setItem('follow', JSON.stringify(oldItems));
    }

    /*
    * Agrego una fila al DOM cada vez que encuentro alguna en el localStorage-->Usario no autenticado.
    *  Agrego una fila al DOM por cada registro de la BD-->Usuarios Autenticados Cliente
    */
    function followTable(item) {
    
        let key = Object.keys(item);

        let row = $('<tr id="followRow-' + item[key].app + '"></tr');

        let dataname = $('<td></td>').text(item[key].name);
        let dataprice = $('<td></td>').text(item[key].price);
        let notFollow = $('<td class="text-center" onclick="removeItemFollow(' + item[key].app + ')"></td>').text('x')


        row.append(dataname);
        row.append(dataprice);
        row.append(notFollow);

        $('#desirelist').append(row);
        $('#' + item[key].app).prop('disabled', true);

    }

       /*
    *  Remuevo una fila del DOM y del LocalStorage.
    *  Remuevo una fila de la DB.
    */
    function removeItemFollow(id) {

        let appsFollow= JSON.parse(localStorage.getItem('follow'));

        if(appsFollow && Object.keys(appsFollow).length > 0){

        //Exist data in local storage
        appsFollow = appsFollow.filter(element => {
            let key = Object.keys(element);
            return element[key].app !== id.toString();
        });
        
        messageRemoveItemFollow(id);
        localStorage.setItem('follow', JSON.stringify(appsFollow));

        }else{
            $.ajax({
                url: '../me/app/remove/'+id,
                type: "GET",
                success: function(data) {
                    messageRemoveItemFollow(id);
                },
                error: function(data) {
                    messageRemoveItemFollow(id);
                }
            })
        }
    }

    function messageRemoveItemFollow(id) 
    {
        document.getElementById('followRow-' + id).remove();
        $('#' + id).prop('disabled', false);
        var notify = $.notify('<div><strong>Has dejado de seguir esta applicacion. </strong></div>', { type: 'warning'});
    }
</script>