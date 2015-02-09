Account = {

    init: function(data){
        if(typeof data != 'undefined'){
            var attributes = [

            ];

            $.each(attributes, function(index, element){
                if(typeof data[element] != 'undefined')
                    Account[element] = data[element];
            });
        }

        Account.setHandlers();
    },

    setHandlers: function(){

    }

    // Handlers

    // AND Handlers


    // Functions

    // END Functions

};