$(document).ready(function(){
    //obsługa kliknięć na buttonach
    $('div[data-action]').click(function(e) {
        if(!$(this).hasClass('disabled')){
            var akcja = $(e.currentTarget).data('action');
            if (akcja.length > 3) {
                switch(akcja){
                    case 'submit-form':
                        $('.submit_btn').trigger('click');
                        break;
                    case 'go-back':
                        history.go(-1);
                        break;
                    case 'object-delete':
                        $('.delete_btn').trigger('click')
                        break;                    
                    default:
                        var parameters = $('.row_selected').data('parameters')
                        if(parameters === undefined){
                            var parameters = $(e.currentTarget).data('parameters');
                        }  
                        window.location = Routing.generate(akcja, parameters);                                       
                }
            }
                    
        }
    });
});