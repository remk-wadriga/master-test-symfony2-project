Registration = {

    init: function(data){
        if(typeof data != 'undefined'){
            var attributes = [

            ];

            $.each(attributes, function(index, element){
                if(typeof data[element] != 'undefined')
                    Registration[element] = data[element];
            });
        }

        Registration.setHandlers();
    },

    setHandlers: function(){

    }

    // Handlers

    // AND Handlers


    // Functions

    // END Functions

};