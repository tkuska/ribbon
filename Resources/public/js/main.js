$(document).ready(function() {
    //obsługa kliknięć na buttonach
    $('div[data-action]').click(function(e) {
        if (!$(this).hasClass('disabled')) {
            var akcja = $(e.currentTarget).data('action');
            if (akcja.length > 3) {
                switch (akcja) {
                    case 'submit-form':
                        $('.submit_btn').trigger('click');
                        break;
                    case 'go-back':
                        history.go(-1);
                        break;
                    case 'object-delete':
                        noty({
                            text: 'Na pewno chcesz usunąć ten obiekt?',                            
                            type: 'confirm',
                            layout: 'topCenter',
                            buttons: [
                                {
                                    text: 'Usuń', 
                                    onClick: function($noty) {
                                        if($('.records_list')){
                                            var new_action = $('.delete_btn').parent().parent().parent().attr('action').replace('recordid', $('.row_selected').attr('id'));
                                            $('.delete_btn').parent().parent().parent().attr('action', new_action);
                                            $('.delete_btn').trigger('click');
                                        }
                                        else{
                                            $('.delete_btn').trigger('click');
                                        }
                                    }
                                },
                                {
                                    text: 'Anuluj', 
                                    onClick: function($noty) {
                                        $noty.close();
                                    }
                                }
                            ],   
                            callback: {
                                onShow: function() {
                                    $('button', '.noty_buttons').button();
                                }
                            }
                        });
                        break;
                    default:
                        var parameters = $('.row_selected').data('parameters');
                        if (parameters === undefined) {
                            var parameters = $(e.currentTarget).data('parameters');
                        }
                        window.location = Routing.generate(akcja, parameters);
                }
            }

        }
    });
});