Frontend = {

    init: function(data){
        if(typeof data != 'undefined'){
            var attributes = [

            ];

            $.each(attributes, function(index, element){
                if(typeof data[element] != 'undefined')
                    Frontend[element] = data[element];
            });
        }

        Frontend.setHandlers();
    },

    setHandlers: function(){

    }

    // Handlers

    // AND Handlers


    // Functions

    // END Functions

};