<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
    function addRow(id,price,name) {
        console.log($('#'+name).prop('disabled', true))
        console.log(name);
            let row = $('<tr></tr')
            let dataname = $('<td></td>').text(name)
            let dataprice = $('<td></td>').text(price)

            row.append(dataname);
            row.append(dataprice);
            
            $('#desirelist').append(row);
            $('#'+id).prop('disabled', true);
              
        }

    $(document).ready(function(e){
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
                success: function(msg) {
                    $('button[name='+id+']').prop('disabled', true);
                    $('#'+id).prop('disabled', false);
                }
            });
        }
        if (($(this).attr('formaction'))==='cancel') {
            $.ajax({
                url: '/api/cancelbuy/'+id,
                type: "DELETE",
                data: {
                        app_id: id,
                        _token: "{{csrf_token()}}"
                    },
                success: function(msg) {
                    $('button[name='+id+']').prop('disabled', false);
                    $('#'+id).prop('disabled', true);
                }
            })

        }

        if (($(this).attr('formaction'))==='detail') {
            $.ajax({
                url: 'appDetail/'+id,
                type: "GET",
                success: function(msg) { 
                    $('#myModal').modal('show');
                }
            })

        }
 
  })
});
</script>