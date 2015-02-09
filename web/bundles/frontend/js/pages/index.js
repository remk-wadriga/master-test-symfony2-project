Index = {

    init: function(data){
        if(typeof data != 'undefined'){
            var attributes = [

            ];

            $.each(attributes, function(index, element){
                if(typeof data[element] != 'undefined')
                    Index[element] = data[element];
            });
        }

        Index.setHandlers();
    },

    setHandlers: function(){

    }

    // Handlers

    // AND Handlers


    // Functions

    // END Functions

};