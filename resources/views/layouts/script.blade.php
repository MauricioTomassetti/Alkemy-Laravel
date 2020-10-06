<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
{{-- <script src="https://cdn.rawgit.com/nnattawat/flip/master/dist/jquery.flip.min.js"> --}}

<script type="text/javascript">

function addRow(id,price,name) {
    let oldItems = JSON.parse(localStorage.getItem('follow')) || [];
    let newItem = {};
    newItem[id] = {'app':id,'name':name,'price':price};

    followTable(newItem);

    oldItems.push(newItem);

    localStorage.setItem('follow', JSON.stringify(oldItems));

}

function followTable(item){

    let key = Object.keys(item);

    let row = $('<tr id="followRow-'+item[key].app +'"></tr');

    let dataname = $('<td></td>').text(item[key].name);
    let dataprice = $('<td></td>').text(item[key].price);
    let notFollow = $('<td class="text-center" onclick="removeItemFollow('+item[key].app+')"></td>').text('x')

    row.append(dataname);
    row.append(dataprice);
    row.append(notFollow);

    $('#desirelist').append(row);
    $('#'+item[key].app).prop('disabled', true);

}

function removeItemFollow(id){

    let appsFollow = JSON.parse(localStorage.getItem('follow')) || [];

    appsFollow = appsFollow.filter(element => {
            let key = Object.keys(element);
            return  element[key].app !== id.toString();
        });

    document.getElementById('followRow-'+id).remove();
    $('#'+id).prop('disabled', false);

    localStorage.setItem('follow', JSON.stringify(appsFollow));
}


    $(document).ready(function(e){
            let oldItems = JSON.parse(localStorage.getItem('follow'))|| [];
         //Recorro las app que deje siguiendo, guardando en un localStorage
        oldItems.forEach(element => {
            followTable(element);
        });

    $('.submitForm').click(function(e){
            e.preventDefault();
        let id = $(this).attr('idapp');
        console.log(id)
        let dblbutton = $(this).attr('app');
        let cancel = $(this).attr('cancelbutton');

        if (($(this).attr('formaction'))==='buy') {
            $.ajax({
                url: '/api/buy',
                type: "POST",
                data: {
                    app_id: id,
                    _token: "{{csrf_token()}}"
                },
                success: function (msg) {
                    let buySuccess = $('<img class="loadergif" src="{{ asset("images/check.gif") }}" width="100%" ><div class="alert alert-success"><h4 class="alert-heading">Su compra ha sido completada con exito.</h4></div><strong class="text-center">Regresando al app market..</strong>');
                    $('button[name=' + id + ']').prop('disabled', true);
                    $('#sucessBuy').modal('show')
                    $('#successMessageBuy').empty();
                    setTimeout(function(){
                            $('#card-' + id).remove();
                            $('#successMessageBuy').append(buySuccess).delay(4000).fadeIn('slow');
                            setTimeout(function(){
                                $('#sucessBuy').modal("hide").delay(4000);
                            }, 5000);
                        }, 2500);
                    },
                    error: function(msg){
                    let buySuccess = $('<img class="loadergif" src="{{ asset("images/error.gif") }}" width="100%" ><div class="alert alert-danger"><h4 class="alert-heading">Su compra no a podido ser realizada.</h4></div><strong class="text-center">Regresando al app market..</strong>');
                    $('button[name=' + id + ']').prop('disabled', true);
                    $('#sucessBuy').modal('show')
                    $('#successMessageBuy').empty();
                    setTimeout(function(){
                           
                            $('#successMessageBuy').append(buySuccess).delay(4000).fadeIn('slow');
                            setTimeout(function(){
                                $('#sucessBuy').modal("hide").delay(4000);
                            }, 5000);
                        }, 2500);
                }
            });
        }
        if (($(this).attr('formaction'))==='cancel') {
            $.ajax({
                url: '/api/cancelbuy/' + id,
                type: "DELETE",
                data: {
                    app_id: id,
                    _token: "{{csrf_token()}}"
                },
                success: function (msg) {
                    $('button[name=' + id + ']').prop('disabled', false);
                    $('#' + id).prop('disabled', true);
                    let buyCancel = $('<img class="loadergif" src="{{ asset("images/cancel.gif") }}" width="100%" ><div class="alert alert-success"><h4 class="alert-heading">Su compra ha sido cancelada con exito.</h4></div>');
                    $('button[name=' + id + ']').prop('disabled', true);
                    $('#cancelBuy').modal('show')
                    $('#cancelMessageBuy').empty();
                    setTimeout(function(){
                            $('#card-' + id).remove();
                            $('#cancelMessageBuy').append(buyCancel).delay(4000).fadeIn('slow');
                            setTimeout(function(){
                                $('#cancelBuy').modal("hide");
                            }, 5000);
                        }, 2500);
                },
                error: function(msg){
                    let buyCancel = $('<img class="loadergif" src="{{ asset("images/error.gif") }}" width="100%" ><div class="alert alert-danger"><h4 class="alert-heading">Su compra no a podido ser cancelada.</h4></div><strong class="text-center">Regresando al app market..</strong>');
                    $('button[name=' + id + ']').prop('disabled', true);
                    $('#cancelBuy').modal('show')
                    $('#cancelMessageBuy').empty();
                    setTimeout(function(){
                            $('#cancelMessageBuy').append(buyCancel).delay(4000).fadeIn('slow');
                            setTimeout(function(){
                                $('#cancelBuy').modal("hide").delay(4000);
                            }, 5000);
                        }, 2500);
                }
            })

        }

  })
});
</script>
