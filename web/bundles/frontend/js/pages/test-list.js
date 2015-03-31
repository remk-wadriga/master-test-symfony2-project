TestList = {

    init: function(data){
        if(typeof data != 'undefined'){
            var attributes = [
                'testTypeGetFormUrl'
            ];

            $.each(attributes, function(index, element){
                if(typeof data[element] != 'undefined')
                    TestList[element] = data[element];
            });
        }

        TestList.setHandlers();
    },

    setHandlers: function(){

    }

    // Handlers



    // AND Handlers


    // Functions

    // END Functions

};