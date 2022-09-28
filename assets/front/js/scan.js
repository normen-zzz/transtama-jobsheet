
var arg = {
    resultFunction: function(result) {
        var redirect = 'cekqr';
        // console.log(result.code);

        var form = '';
        form += '<input type="hidden" name="id_user" value="'+result.code+'">';
       
        $('<form action="LoginQr/cekqr" method="POST">'+form+'</form>').appendTo('body').submit();

        // $.redirectPostResult(redirect, {id_user: result.code});
    }
};
// console.log(result.code);
var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
decoder.buildSelectMenu("select");
decoder.play();
  /*  Without visible select menu
      decoder.buildSelectMenu(document.createElement('select'), 'environment|back').init(arg).play();
  */
$('select').on('change', function(){
    decoder.stop().play();
});

// jquery extend function
// $.extend(
// {
//     redirectPostResult: function(location, args)
//     {
//         var form = '';
//         $.each( args, function( key, value ) {
//             form += '<input type="hidden" name="'+key+'" value="'+value+'">';
//         });
//         $('<form action="'+location+'" method="POST">'+form+'</form>').appendTo('body').submit();
//     }
// });
